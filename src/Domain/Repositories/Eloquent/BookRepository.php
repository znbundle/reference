<?php

namespace ZnBundle\Reference\Domain\Repositories\Eloquent;

use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use ZnCore\Domain\Query\Entities\Where;
use ZnCore\Domain\Query\Entities\Query;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnCore\Domain\Repository\Mappers\JsonMapper;

class BookRepository extends BaseEloquentCrudRepository implements BookRepositoryInterface
{

    protected $tableName = 'reference_book';

    public function getEntityClass(): string
    {
        return BookEntity::class;
    }

    public function mappers(): array
    {
        return [
            new JsonMapper(['title_i18n']),
        ];
    }

    public function findOneByName(string $name, Query $query = null): BookEntity
    {
        $query = $this->forgeQuery($query);
        $query->whereNew(new Where('entity', $name));
        return $this->one($query);
    }
}
