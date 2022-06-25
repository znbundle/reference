<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnLib\Components\Status\Enums\StatusEnum;
use ZnLib\Components\SoftDelete\Subscribers\SoftDeleteSubscriber;
use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use ZnCore\Domain\Service\Base\BaseCrudService;
use ZnCore\Domain\Query\Entities\Where;
use ZnCore\Domain\EntityManager\Interfaces\EntityManagerInterface;
use ZnCore\Domain\Query\Entities\Query;
use ZnLib\Components\SoftDelete\Traits\Service\SoftDeleteTrait;
use ZnLib\Components\SoftDelete\Traits\Service\SoftRestoreTrait;

class ItemService extends BaseCrudService implements ItemServiceInterface
{

    use SoftDeleteTrait;
    use SoftRestoreTrait;

    public function __construct(EntityManagerInterface $em, ItemRepositoryInterface $repository)
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

    protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
//        $query->where('status_id', StatusEnum::ENABLED);
        $query->orderBy(['sort' => SORT_ASC]);
        return $query;
    }
}
