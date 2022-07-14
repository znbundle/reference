<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnLib\Components\Status\Enums\StatusEnum;
use ZnDomain\Сomponents\SoftDelete\Subscribers\SoftDeleteSubscriber;
use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnCore\Query\Entities\Where;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnCore\Query\Entities\Query;
use ZnDomain\Сomponents\SoftDelete\Traits\Service\SoftDeleteTrait;
use ZnDomain\Сomponents\SoftDelete\Traits\Service\SoftRestoreTrait;

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

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
//        $query->where('status_id', StatusEnum::ENABLED);
        $query->orderBy(['sort' => SORT_ASC]);
        return $query;
    }
}
