<?php

/**
 * @var View $this
 * @var Request $request
 * @var DataProvider $dataProvider
 * @var ValidationByMetadataInterface $filterModel
 */

use yii\helpers\Url;
use yii\web\Request;
use yii\web\View;
use ZnBundle\Reference\Yii2\Admin\Formatters\Actions\ItemListAction;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnLib\I18Next\Facades\I18Next;
use ZnCore\Validation\Interfaces\ValidationByMetadataInterface;
use ZnCore\DataProvider\Libs\DataProvider;
use ZnLib\Web\TwBootstrap\Widgets\Collection\CollectionWidget;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\ActionFormatter;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\Actions\DeleteAction;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\Actions\UpdateAction;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\EnumFormatter;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\LinkFormatter;
use ZnSandbox\Sandbox\Status\Domain\Enums\StatusEnum;
use ZnSandbox\Sandbox\Status\Web\Widgets\FilterWidget;

$this->title = I18Next::t('reference', 'item.list');

$statusWidget = new FilterWidget(StatusEnum::class, $filterModel);
$filter = $request->getQueryParam('filter');
$bookId = ArrayHelper::getValue($filter, 'book_id');

$attributes = [
    [
        'label' => 'ID',
        'attributeName' => 'id',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.title'),
        'attributeName' => 'title',
        'sort' => true,
        'formatter' => [
            'class' => LinkFormatter::class,
            'uri' => [
                '/reference/item/view',
                'filter[book_id]' => $bookId
            ],
        ],
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.status'),
        'attributeName' => 'status_id',
        'formatter' => [
            'class' => EnumFormatter::class,
            'enumClass' => StatusEnum::class,
        ],
    ],
    [
        'formatter' => [
            'class' => ActionFormatter::class,
            'restorable' => true,
            'actions' => [
                'itemList',
                'update',
                'delete',
            ],
            'actionDefinitions' => [
                'itemList' => [
                    'class' => ItemListAction::class,
                    'linkParams' => [
                        'filter[book_id]' => 'book_id',
                        'parent_id' => 'id',
                    ],
                    'baseUrl' => '/reference/item',
                ],
                'update' => [
                    'class' => UpdateAction::class,
                    'linkParams' => [
                        'filter[book_id]' => 'book_id',
                        'id' => 'id',
                    ],
                    'baseUrl' => '/reference/item',
                ],
                'delete' => [
                    'class' => DeleteAction::class,
                    'linkParams' => [
                        'filter[book_id]' => 'book_id',
                        'id' => 'id',
                    ],
                    'baseUrl' => '/reference/item',
                ],
                'restore' => [
                    'class' => \ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\Actions\RestoreAction::class,
                    'linkParams' => [
                        'filter[book_id]' => 'book_id',
                        'id' => 'id',
                    ],
                    'baseUrl' => '/reference/item',
                ],
            ],
            'baseUrl' => '/reference/book',
        ],
    ],
];

?>

<div class="row">

    <div class="col-lg-12">

        <div class="mb-3">
            <?= $statusWidget->run() ?>
        </div>

        <?= CollectionWidget::widget([
            'dataProvider' => $dataProvider,
            'attributes' => $attributes,
        ]) ?>

        <div class="float-left">
            <a class="btn btn-primary"
               href="<?= Url::to(['/reference/item/create', 'filter[book_id]' => $bookId]) ?>"
               role="button">
                <i class="fa fa-plus"></i>
                <?= I18Next::t('core', 'action.create') ?>
            </a>
        </div>

    </div>

</div>
