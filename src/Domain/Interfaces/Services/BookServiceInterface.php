<?php

namespace ZnBundle\Reference\Domain\Interfaces\Services;

use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnCore\Base\Libs\Service\Interfaces\CrudServiceInterface;
use ZnCore\Base\Libs\Query\Entities\Query;

interface BookServiceInterface extends CrudServiceInterface
{

    public function oneByName(string $name, Query $query = null): BookEntity;
}
