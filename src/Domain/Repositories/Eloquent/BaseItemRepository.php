<?php

namespace ZnBundle\Reference\Domain\Repositories\Eloquent;

use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnCore\Domain\Entities\Query\Where;
use ZnCore\Domain\Libs\Query;

abstract class BaseItemRepository extends ItemRepository implements ItemRepositoryInterface
{

    abstract public function getBookId(): int;

    protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        $query->whereNew(new Where('book_id', $this->getBookId()));
        return $query;
    }
}