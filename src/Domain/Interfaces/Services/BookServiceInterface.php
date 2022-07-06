<?php

namespace ZnBundle\Reference\Domain\Interfaces\Services;

use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnCore\Service\Interfaces\CrudServiceInterface;
use ZnCore\Query\Entities\Query;

interface BookServiceInterface extends CrudServiceInterface
{

    public function findOneByName(string $name, Query $query = null): BookEntity;
}
