<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use ZnCore\Domain\Base\BaseCrudService;

class ItemService extends BaseCrudService implements ItemServiceInterface
{

    public function __construct(ItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
