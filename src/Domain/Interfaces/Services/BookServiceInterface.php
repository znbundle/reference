<?php

namespace ZnBundle\Reference\Domain\Interfaces\Services;

use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnCore\Domain\Service\Interfaces\CrudServiceInterface;
use ZnCore\Domain\Query\Entities\Query;

interface BookServiceInterface extends CrudServiceInterface
{

    public function findOneByName(string $name, Query $query = null): BookEntity;
}
