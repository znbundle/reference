<?php

namespace ZnBundle\Reference\Domain\Subscribers;

use App\Organization\Domain\Entities\EmployeeEntity;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ZnBundle\Reference\Domain\Entities\ItemEntity;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnCore\Query\Entities\Where;
use ZnDomain\Domain\Enums\EventEnum;
use ZnDomain\Domain\Events\EntityEvent;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnCore\Query\Entities\Query;
use ZnDomain\EntityManager\Traits\EntityManagerAwareTrait;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Services\MyPersonServiceInterface;

class BookIdSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    public $bookName;
    private $bookService;

    public function __construct(
        EntityManagerInterface $em,
        BookServiceInterface $bookService
    )
    {
        $this->bookService = $bookService;
        $this->setEntityManager($em);
    }

    public static function getSubscribedEvents()
    {
        return [
            EventEnum::BEFORE_CREATE_ENTITY => 'onBeforeCreate',
            EventEnum::BEFORE_UPDATE_ENTITY => 'onBeforeCreate',
        ];
    }

    public function onBeforeCreate(EntityEvent $event)
    {
        /** @var ItemEntity $entity */
        $entity = $event->getEntity();
        $bookEntity = $this->bookService->findOneByName($this->bookName);
        $entity->setBookId($bookEntity->getId());
    }
}
