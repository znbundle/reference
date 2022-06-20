<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnCore\Base\Libs\SoftDelete\Subscribes\SoftDeleteBehavior;
use ZnBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnCore\Base\Libs\Service\Base\BaseCrudService;
use ZnCore\Base\Libs\Query\Entities\Where;
use ZnCore\Base\Libs\EntityManager\Interfaces\EntityManagerInterface;
use ZnCore\Base\Libs\Query\Entities\Query;
use ZnCore\Base\Libs\SoftDelete\Traits\Service\SoftDeleteTrait;
use ZnCore\Base\Libs\SoftDelete\Traits\Service\SoftRestoreTrait;

class BookService extends BaseCrudService implements BookServiceInterface
{

//    use SoftDeleteTrait;
    use SoftRestoreTrait;

    public function __construct(EntityManagerInterface $em, BookRepositoryInterface $repository)
    {
        $this->setEntityManager($em);
        $this->setRepository($repository);
    }

    public function subscribes(): array
    {
        return [
            SoftDeleteBehavior::class,
        ];
    }

    public function oneByName(string $name, Query $query = null): BookEntity
    {
        return $this->getRepository()->oneByName($name, $query);
    }
}
