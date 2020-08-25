<?php

namespace PhpBundle\Reference\Domain\Services;

use PhpBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;

class BookService extends BaseCrudService implements BookServiceInterface
{

    public function __construct(\PhpBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

