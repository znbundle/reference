<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnCore\Base\Enums\StatusEnum;
use ZnCore\Base\Libs\SoftDelete\Subscribes\SoftDeleteBehavior;
use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use ZnCore\Domain\Base\BaseCrudService;
use ZnCore\Base\Libs\Query\Entities\Where;
use ZnCore\Base\Libs\EntityManager\Interfaces\EntityManagerInterface;
use ZnCore\Base\Libs\Query\Entities\Query;
use ZnCore\Base\Libs\SoftDelete\Traits\Service\SoftDeleteTrait;
use ZnCore\Base\Libs\SoftDelete\Traits\Service\SoftRestoreTrait;

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
            SoftDeleteBehavior::class,
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
