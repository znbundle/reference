<?php

namespace ZnBundle\Reference\Domain\Repositories\Eloquent;

use Illuminate\Support\Collection;
use ZnBundle\Reference\Domain\Entities\ItemEntity;
use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnCore\Domain\Enums\RelationEnum;
use ZnCore\Domain\Interfaces\Entity\EntityIdInterface;
use ZnCore\Domain\Libs\Query;
use ZnCore\Domain\Libs\Relation\OneToMany;
use ZnCore\Db\Db\Base\BaseEloquentCrudRepository;
use ZnCore\Db\Db\Capsule\Manager;

class ItemRepository extends BaseEloquentCrudRepository implements ItemRepositoryInterface
{

    protected $tableName = 'reference_item';
    protected $translationRepository;

    public function getEntityClass(): string
    {
        return ItemEntity::class;
    }

    public function __construct(Manager $capsule, ItemTranslationRepository $translationRepository)
    {
        parent::__construct($capsule);
        $this->translationRepository = $translationRepository;
    }

    protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        $query->with(['translations']);
        return $query;
    }

    public function relations()
    {
        return [
            'translations' => [
                'type' => RelationEnum::CALLBACK,
                'callback' => function (Collection $collection) {
                    $m2m = new OneToMany;
                    $m2m->selfModel = $this;
                    $m2m->foreignModel = $this->translationRepository;
                    $m2m->selfField = 'itemId';
                    $m2m->foreignContainerField = 'translations';
                    $m2m->run($collection);
                },
            ],


            /*'translation' => [
                'type' => RelationEnum::CALLBACK,
                'callback' => function (Collection $collection) {
                    $m2m = new OneToOne;
                    //$m2m->selfModel = $this;

                    $m2m->foreignModel = $this->translationRepository;
                    $m2m->foreignField = 'itemId';
                    $m2m->foreignContainerField = 'translation';

                    $m2m->run($collection);
                },
            ],*/
        ];
    }
}
