<?php

namespace ZnBundle\Reference\Yii2\Admin\Controllers;

use ZnBundle\Reference\Yii2\Admin\Filters\ItemFilter;
use ZnBundle\Reference\Yii2\Admin\Forms\ItemForm;
use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\helpers\Url;
use ZnBundle\Reference\Domain\Entities\ItemEntity;
use ZnBundle\Reference\Domain\Enums\Rbac\ReferenceItemPermissionEnum;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use ZnCore\Base\Arr\Helpers\ArrayHelper;
use ZnLib\Components\I18Next\Facades\I18Next;
use ZnCore\Domain\Entity\Interfaces\EntityIdInterface;
use ZnLib\Web\Components\Widget\Widgets\BreadcrumbWidget;
use ZnYii\Web\Actions\CreateAction;
use ZnYii\Web\Actions\DeleteAction;
use ZnYii\Web\Actions\IndexAction;
use ZnYii\Web\Actions\RestoreAction;
use ZnYii\Web\Actions\UpdateAction;
use ZnYii\Web\Actions\ViewAction;
use ZnYii\Web\Controllers\BaseController;

class ItemController extends BaseController
{

    protected $baseUri = '/reference/item';
    protected $formClass = ItemForm::class;
    protected $entityClass = ItemEntity::class;
    protected $filterModel = ItemFilter::class;
    private $bookService;

    public function __construct(
        string $id,
        Module $module, array $config = [],
        BreadcrumbWidget $breadcrumbWidget,
        ItemServiceInterface $service,
        BookServiceInterface $bookService
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->bookService = $bookService;
        $this->breadcrumbWidget = $breadcrumbWidget;
        /*$bookId = \Yii::$app->request->getQueryParam('filter')['book_id'];
        if(empty($bookId)) {
            //throw new \InvalidArgumentException('Bad query param "book_id"!');
        }*/
    }

    public function behaviors()
    {
        return [
            //'authenticator' => Behavior::auth(),
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [ReferenceItemPermissionEnum::ALL],
                        'actions' => ['index'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [ReferenceItemPermissionEnum::ONE],
                        'actions' => ['view'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [ReferenceItemPermissionEnum::CREATE],
                        'actions' => ['create'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [ReferenceItemPermissionEnum::UPDATE],
                        'actions' => ['update'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [ReferenceItemPermissionEnum::DELETE],
                        'actions' => ['delete'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [ReferenceItemPermissionEnum::RESTORE],
                        'actions' => ['restore'],
                    ],
                ],
            ],
        ];
    }

    protected function addListBreadcrumb(int $bookId = null)
    {
        $bookId = $bookId ?: $this->getBookId();
        $bookEntity = $this->bookService->oneById($bookId);
        $this->breadcrumbWidget->add(I18Next::t('reference', 'item.list') . " ({$bookEntity->getTitle()})", Url::to([$this->baseUri, 'filter[book_id]' => $bookId]));
    }

    protected function getBookId()
    {
        $filter = Yii::$app->request->getQueryParam('filter');
        return ArrayHelper::getValue($filter, 'book_id');
    }

    public function actions()
    {
        return [
            'restore' => [
                'class' => RestoreAction::class,
                'service' => $this->service,
                'successMessage' => ['web', 'message.restore_success'],
                'successRedirectUrl' => [$this->baseUri, 'filter[book_id]' => $this->getBookId()],
            ],
            'index' => [
                'class' => IndexAction::class,
                'service' => $this->service,
                'filterModel' => $this->filterModel,
                'with' => $this->with(),
                /*'sort' => [
                    'id' => SORT_DESC,
                ],*/
                'callback' => function () {
                    $this->addListBreadcrumb();
                }
            ],
            'create' => [
                'class' => CreateAction::class,
                'service' => $this->service,
                'successMessage' => ['web', 'message.create_success'],
//                'i18NextConfig' => $this->i18NextConfig(),
                'successRedirectUrl' => [$this->baseUri, 'filter[book_id]' => $this->getBookId()],
                'formClass' => $this->formClass,
                'entityClass' => $this->entityClass,
                'callback' => function () {
                    $this->addListBreadcrumb();
                    $bookId = $this->getBookId();
                    $this->breadcrumbWidget->add(I18Next::t('core', 'action.create'), Url::to([$this->baseUri . '/create', 'filter[book_id]' => $bookId]));
                }
            ],
            'view' => [
                'class' => ViewAction::class,
                'service' => $this->service,
                'with' => $this->with(),
                'callback' => function (EntityIdInterface $entity) {
                    $this->addListBreadcrumb($entity->getBookId());
                    $this->breadcrumbWidget->add(I18Next::t('core', 'action.view'), Url::to([$this->baseUri . '/view', 'id' => $entity->getId()]));
                }
            ],
            'update' => [
                'class' => UpdateAction::class,
                'service' => $this->service,
                'with' => $this->with(),
                'successMessage' => ['web', 'message.update_success'],
//                'i18NextConfig' => $this->i18NextConfig(),
                'successRedirectUrl' => [$this->baseUri, 'filter[book_id]' => $this->getBookId()],
                'formClass' => $this->formClass,
                'entityClass' => $this->entityClass,
                'callback' => function (EntityIdInterface $entity) {
                    $this->addListBreadcrumb($entity->getBookId());
                    $this->breadcrumbWidget->add(I18Next::t('core', 'action.update'), Url::to([$this->baseUri . '/update', 'id' => $entity->getId()]));
                }
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'service' => $this->service,
                'successMessage' => ['web', 'message.delete_success'],
                'successRedirectUrl' => [$this->baseUri, 'filter[book_id]' => $this->getBookId()],
//                'i18NextConfig' => $this->i18NextConfig(),
            ],
        ];
    }

    public function with()
    {
        return [
            'book',
            'parent',
        ];
    }
}
