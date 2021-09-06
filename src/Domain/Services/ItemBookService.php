<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemBookServiceInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use ZnCore\Domain\Entities\Query\Where;
use ZnCore\Domain\Interfaces\Libs\EntityManagerInterface;
use ZnCore\Domain\Libs\Query;

class ItemBookService extends ItemService implements ItemBookServiceInterface
{

    private $bookId;
    private $bookName;
    private $bookService;

    public function __construct(EntityManagerInterface $em, ItemRepositoryInterface $repository, BookServiceInterface $bookService)
    {
        parent::__construct($em, $repository);
        $this->bookService = $bookService;
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }

    public function setBookId(int $bookId): void
    {
        $this->bookId = $bookId;
    }

    public function getBookName(): string
    {
        return $this->bookName;
    }

    public function setBookName(string $bookName): void
    {
        $this->bookName = $bookName;
    }

    protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        if($this->bookId) {
            $query->whereNew(new Where('book_id', $this->getBookId()));
        } elseif($this->bookName) {
            $bookEntity = $this->bookService->oneByName($this->bookName);
            $query->whereNew(new Where('book_id', $bookEntity->getId()));
        }
        return $query;
    }
}
