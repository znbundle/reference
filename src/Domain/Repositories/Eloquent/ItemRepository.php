<?php

namespace ZnBundle\Reference\Domain\Repositories\Eloquent;

use Illuminate\Support\Collection;
use Packages\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use ZnBundle\Reference\Domain\Entities\ItemEntity;
use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnCore\Domain\Enums\RelationEnum;
use ZnCore\Domain\Interfaces\Entity\EntityIdInterface;
use ZnCore\Domain\Libs\Query;
use ZnCore\Domain\Libs\Relation\OneToMany;
use ZnCore\Domain\Relations\relations\OneToManyRelation;
use ZnLib\Db\Base\BaseEloquentCrudRepository;
use ZnLib\Db\Capsule\Manager;

class ItemRepository extends BaseEloquentCrudRepository implements ItemRepositoryInterface
{

    protected $tableName = 'reference_item';
    protected $translationRepository;

    public function getEntityClass(): string
    {
        return ItemEntity::class;
    }

    protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        $query->with(['translations']);
        return $query;
    }

    public function relations2()
    {
        return [
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'translations',
                'foreignRepositoryClass' => ItemTranslationRepository::class,
                'foreignAttribute' => 'item_id',
            ],
        ];
    }
}
