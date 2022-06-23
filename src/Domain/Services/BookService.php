<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnCore\Base\Libs\SoftDelete\Subscribers\SoftDeleteSubscriber;
use ZnBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnCore\Domain\Service\Base\BaseCrudService;
use ZnCore\Domain\Query\Entities\Where;
use ZnCore\Domain\EntityManager\Interfaces\EntityManagerInterface;
use ZnCore\Domain\Query\Entities\Query;
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
            SoftDeleteSubscriber::class,
        ];
    }

    public function oneByName(string $name, Query $query = null): BookEntity
    {
        return $this->getRepository()->oneByName($name, $query);
    }
}
