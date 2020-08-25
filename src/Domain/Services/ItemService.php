<?php

namespace PhpBundle\Reference\Domain\Services;

use PhpBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;

class ItemService extends BaseCrudService implements ItemServiceInterface
{

    public function __construct(\PhpBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

