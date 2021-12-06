<?php

namespace ZnBundle\Reference\Domain\Repositories\Eloquent;

use Illuminate\Support\Collection;
use ZnBundle\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use ZnBundle\Reference\Domain\Entities\ItemEntity;
use ZnBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface;
use ZnCore\Domain\Enums\RelationEnum;
use ZnCore\Domain\Interfaces\Entity\EntityIdInterface;
use ZnCore\Domain\Libs\Query;
use ZnCore\Domain\Libs\Relation\OneToMany;
use ZnCore\Domain\Relations\relations\OneToManyRelation;
use ZnCore\Domain\Relations\relations\OneToOneRelation;
use ZnLib\Db\Base\BaseEloquentCrudRepository;
use ZnLib\Db\Capsule\Manager;
use ZnLib\Db\Mappers\JsonMapper;

class ItemRepository extends BaseEloquentCrudRepository implements ItemRepositoryInterface
{

    protected $tableName = 'reference_item';
    protected $translationRepository;

    public function getEntityClass(): string
    {
        return ItemEntity::class;
    }

    public function mappers(): array
    {
        return [
            new JsonMapper(['title_i18n', 'props']),
        ];
    }

    /*protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        $query->with(['translations']);
        return $query;
    }*/

    public function relations2()
    {
        return [
            /*[
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'translations',
                'foreignRepositoryClass' => ItemTranslationRepositoryInterface::class,
                'foreignAttribute' => 'item_id',
            ],*/
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'book_id',
                'relationEntityAttribute' => 'book',
                'foreignRepositoryClass' => BookRepositoryInterface::class,
            ],
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'parent_id',
                'relationEntityAttribute' => 'parent',
                'foreignRepositoryClass' => ItemRepositoryInterface::class,
            ],
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'children',
                'foreignRepositoryClass' => ItemRepositoryInterface::class,
                'foreignAttribute' => 'parent_id',
            ],
        ];
    }
}
