<?php

namespace ZnBundle\Reference\Domain\Repositories\Eloquent;

use Illuminate\Support\Collection;
use ZnBundle\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnBundle\Reference\Domain\Entities\ItemEntity;
use ZnBundle\Reference\Domain\Filters\ItemFilter;
use ZnBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface;
use ZnCore\Base\Exceptions\NotFoundException;
use ZnCore\Domain\Enums\RelationEnum;
use ZnCore\Base\Libs\Entity\Interfaces\EntityIdInterface;
use ZnCore\Base\Libs\Validation\Exceptions\UnprocessibleEntityException;
use ZnCore\Base\Libs\Query\Entities\Query;
use ZnCore\Base\Libs\Relation\Libs\Types\OneToManyRelation;
use ZnCore\Base\Libs\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnDatabase\Eloquent\Domain\Capsule\Manager;
use ZnCore\Base\Libs\Repository\Mappers\JsonMapper;
use function Deployer\add;

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

    public function forgeQueryByFilter(object $filterModel, Query $query)
    {
        if($filterModel instanceof ItemFilter) {
            if($filterModel->getBookName()) {
                try {
                    /** @var BookEntity $bookEntity */
                    $bookEntity = $this
                        ->getEntityManager()
                        ->getRepository(BookEntity::class)
                        ->oneByName($filterModel->getBookName());
                    $query->where('book_id', $bookEntity->getId());
                } catch (NotFoundException $e) {
                    throw(new UnprocessibleEntityException())
                        ->add('bookName', $e->getMessage());
                }
            }
        }
        parent::forgeQueryByFilter($filterModel, $query);
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
