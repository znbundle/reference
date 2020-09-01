<?php

namespace PhpBundle\Reference\Yii\Api\controllers;

use Packages\RestClient\Domain\Enums\RestClientPermissionEnum;
use Packages\RestClient\Domain\Interfaces\Services\BookmarkServiceInterface;
use Packages\RestClient\Domain\Interfaces\Services\ProjectServiceInterface;
use PhpBundle\Reference\Domain\Enums\ReferenceBookPermissionEnum;
use PhpBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use PhpBundle\Reference\Domain\Services\BookService;
use PhpBundle\Reference\Domain\Services\ItemService;
use yii\base\Module;
use RocketLab\Bundle\Rest\Base\BaseCrudController;

class ItemController extends BaseCrudController
{

    public function __construct(
        string $id,
        Module $module,
        array $config = [],
        ItemService $projectService
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
