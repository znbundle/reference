<?php

namespace PhpBundle\Reference\Domain\Services;

use PhpBundle\Reference\Domain\Interfaces\Services\ItemTranslationServiceInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;

class ItemTranslationService extends BaseCrudService implements ItemTranslationServiceInterface
{

    public function __construct(\PhpBundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

