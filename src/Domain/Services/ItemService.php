<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use ZnCore\Domain\Base\BaseCrudService;
use ZnCore\Domain\Traits\Service\SoftDeleteTrait;
use ZnCore\Domain\Traits\Service\SoftRestoreTrait;

class ItemService extends BaseCrudService implements ItemServiceInterface
{

    use SoftDeleteTrait;
    use SoftRestoreTrait;

    public function __construct(ItemRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }
}
