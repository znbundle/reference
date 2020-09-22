<?php

namespace ZnBundle\Reference\Yii2\Api\controllers;

use ZnTool\RestClient\Domain\Enums\RestClientPermissionEnum;
use ZnTool\RestClient\Domain\Interfaces\Services\BookmarkServiceInterface;
use ZnTool\RestClient\Domain\Interfaces\Services\ProjectServiceInterface;
use ZnBundle\Reference\Domain\Enums\ReferenceBookPermissionEnum;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnBundle\Reference\Domain\Services\BookService;
use yii\base\Module;
use ZnLib\Rest\Yii2\Base\BaseCrudController;

class BookController extends BaseCrudController
{

    public function __construct(
        string $id,
        Module $module,
        array $config = [],
        BookService $projectService
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $projectService;
    }

    public function authentication(): array
    {
        return [
            'create',
            'update',
            'delete',
            //'index',
            //'view',
        ];
    }

    public function access(): array
    {
        return [
            [
                [ReferenceBookPermissionEnum::WRITE], ['create', 'update', 'delete'],
            ],
            /*[
                [ReferenceBookPermissionEnum::READ], ['index', 'view'],
            ],*/
        ];
    }
}
