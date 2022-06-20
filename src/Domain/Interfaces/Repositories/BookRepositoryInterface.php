<?php

namespace ZnBundle\Reference\Domain\Interfaces\Repositories;

use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnCore\Base\Libs\Repository\Interfaces\CrudRepositoryInterface;
use ZnCore\Base\Libs\Query\Entities\Query;

interface BookRepositoryInterface extends CrudRepositoryInterface
{

    public function oneByName(string $name, Query $query = null): BookEntity;
    
}
