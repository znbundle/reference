<?php

namespace ZnBundle\Reference\Yii2\Admin\Controllers;

use ZnBundle\Reference\Yii2\Admin\Filters\BookFilter;
use ZnBundle\Reference\Yii2\Admin\Forms\BookForm;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\helpers\Url;
use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnBundle\Reference\Domain\Enums\Rbac\ReferenceBookPermissionEnum;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnLib\Components\I18Next\Facades\I18Next;
use ZnLib\Web\Components\TwBootstrap\Widgets\Breadcrumb\BreadcrumbWidget;
use ZnYii\Web\Controllers\BaseController;

class BookController extends BaseController
{

    protected $baseUri = '/reference/book';
    protected $formClass = BookForm::class;
    protected $entityClass = BookEntity::class;
    protected $filterModel = BookFilter::class;

    public function __construct(
        string $id,
        Module $module, array $config = [],
        BreadcrumbWidget $breadcrumbWidget,
        BookServiceInterface $service
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->breadcrumbWidget = $breadcrumbWidget;
        $this->breadcrumbWidget->add(I18Next::t('reference', 'book.list'), Url::to([$this->baseUri]));
    }

    public function actions()
    {
        $actions = parent::actions();
        $actions['restore'] = $this->getRestoreActionConfig();
        return $actions;
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
                        'roles' => [ReferenceBookPermissionEnum::ALL],
                        'actions' => ['index'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [ReferenceBookPermissionEnum::ONE],
                        'actions' => ['view'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [ReferenceBookPermissionEnum::CREATE],
                        'actions' => ['create'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [ReferenceBookPermissionEnum::UPDATE],
                        'actions' => ['update'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [ReferenceBookPermissionEnum::DELETE],
                        'actions' => ['delete'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [ReferenceBookPermissionEnum::RESTORE],
                        'actions' => ['restore'],
                    ],
                ],
            ],
        ];
    }
}
