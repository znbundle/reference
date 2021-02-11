<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnCore\Domain\Base\BaseCrudService;
use ZnCore\Domain\Traits\Service\SoftDeleteTrait;
use ZnCore\Domain\Traits\Service\SoftRestoreTrait;

class BookService extends BaseCrudService implements BookServiceInterface
{

    use SoftDeleteTrait;
    use SoftRestoreTrait;

    public function __construct(BookRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }
}
