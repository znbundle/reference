<?php

namespace ZnBundle\Reference\Domain\Repositories\Eloquent;

use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnCore\Base\Libs\Query\Entities\Where;
use ZnCore\Base\Libs\EntityManager\Interfaces\EntityManagerInterface;
use ZnCore\Base\Libs\Query\Entities\Query;
use ZnDatabase\Eloquent\Domain\Capsule\Manager;

abstract class BaseItemRepository extends ItemRepository implements ItemRepositoryInterface
{

    protected $bookId;
    protected $bookName;
    private $bookService;

    public function __construct(EntityManagerInterface $em, Manager $manager, BookServiceInterface $bookService)
    {
        parent::__construct($em, $manager);
        $this->bookService = $bookService;
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }

    public function getBookName(): string
    {
        return $this->bookName;
    }

    /*protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        $query->whereNew(new Where('book_id', $this->getBookId()));
        return $query;
    }*/

    protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        if ($this->bookId) {
            $query->whereNew(new Where('book_id', $this->getBookId()));
        } elseif ($this->bookName) {
            $bookEntity = $this->bookService->oneByName($this->getBookName());
            $query->whereNew(new Where('book_id', $bookEntity->getId()));
        }
        return $query;
    }
}