<?php

namespace PhpBundle\Reference\Domain\Repositories\Eloquent;

use PhpBundle\Reference\Domain\Entities\BookEntity;
use PhpBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;

class BookRepository extends BaseEloquentCrudRepository implements BookRepositoryInterface
{

    protected $tableName = 'reference_book';

    public function getEntityClass(): string
    {
        return BookEntity::class;
    }
}
