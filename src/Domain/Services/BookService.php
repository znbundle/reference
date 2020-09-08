<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnCore\Base\Domain\Base\BaseCrudService;

class BookService extends BaseCrudService implements BookServiceInterface
{

    public function __construct(\ZnBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

