<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnCore\Domain\Base\BaseCrudService;

class BookService extends BaseCrudService implements BookServiceInterface
{

    public function __construct(BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

