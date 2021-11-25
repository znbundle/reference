<?php

namespace ZnBundle\Reference\Domain\Repositories\Eloquent;

use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use ZnLib\Db\Base\BaseEloquentCrudRepository;
use ZnLib\Db\Mappers\JsonMapper;

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
}
