<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use ZnCore\Base\Domain\Base\BaseCrudService;

class ItemService extends BaseCrudService implements ItemServiceInterface
{

    public function __construct(\ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

