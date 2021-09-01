<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Interfaces\Services\ItemBookServiceInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use ZnCore\Domain\Entities\Query\Where;
use ZnCore\Domain\Libs\Query;

class ItemBookService extends ItemService implements ItemBookServiceInterface
{

    private $bookId;

    public function getBookId(): int
    {
        return $this->bookId;
    }

    public function setBookId(int $bookId): void
    {
        $this->bookId = $bookId;
    }

    protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        $query->whereNew(new Where('book_id', $this->getBookId()));
        return $query;
    }
}
