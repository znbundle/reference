<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Interfaces\Services\ItemTranslationServiceInterface;
use ZnCore\Base\Domain\Base\BaseCrudService;

class ItemTranslationService extends BaseCrudService implements ItemTranslationServiceInterface
{

    public function __construct(\ZnBundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

