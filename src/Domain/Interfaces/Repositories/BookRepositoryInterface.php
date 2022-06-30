<?php

namespace ZnBundle\Reference\Domain\Interfaces\Repositories;

use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnCore\Domain\Repository\Interfaces\CrudRepositoryInterface;
use ZnCore\Domain\Query\Entities\Query;

interface BookRepositoryInterface extends CrudRepositoryInterface
{

    public function findOneByName(string $name, Query $query = null): BookEntity;
    
}
