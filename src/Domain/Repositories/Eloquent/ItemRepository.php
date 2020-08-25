<?php

namespace PhpBundle\Reference\Domain\Repositories\Eloquent;

use Illuminate\Support\Collection;
use PhpBundle\Reference\Domain\Entities\ItemEntity;
use PhpBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use PhpLab\Core\Domain\Enums\RelationEnum;
use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Core\Domain\Libs\Relation\OneToMany;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Eloquent\Db\Helpers\Manager;

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
