<?php

/**
 * @var View $this
 * @var Request $request
 * @var DataProvider $dataProvider
 * @var ValidationByMetadataInterface $filterModel
 */

use ZnBundle\Reference\Yii2\Admin\Formatters\Actions\ItemListAction;
use ZnSandbox\Sandbox\Status\Domain\Enums\StatusEnum;
use ZnSandbox\Sandbox\Status\Web\Widgets\FilterWidget;
use yii\helpers\Url;
use yii\web\Request;
use yii\web\View;
use ZnLib\Components\I18Next\Facades\I18Next;
use ZnCore\Base\Validation\Interfaces\ValidationByMetadataInterface;
use ZnCore\Domain\DataProvider\Libs\DataProvider;
use ZnLib\Web\Components\Widget\Widgets\Collection\CollectionWidget;
use ZnLib\Web\Components\Widget\Widgets\Format\Formatters\ActionFormatter;
use ZnLib\Web\Components\Widget\Widgets\Format\Formatters\EnumFormatter;
use ZnLib\Web\Components\Widget\Widgets\Format\Formatters\LinkFormatter;

$this->title = I18Next::t('reference', 'book.list');

$statusWidget = new FilterWidget(StatusEnum::class, $filterModel);

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
            'uri' => '/reference/book/view',
        ],
    ],
    [
        'label' => I18Next::t('reference', 'book.attribute.levels'),
        'attributeName' => 'levels',
        'sort' => true,
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
        'label' => I18Next::t('core', 'main.attribute.created_at'),
        'attributeName' => 'created_at',
        'sort' => true,
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
                        'filter[book_id]' => 'id',
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
            <a class="btn btn-primary" href="<?= Url::to(['/reference/book/create']) ?>" role="button">
                <i class="fa fa-plus"></i>
                <?= I18Next::t('core', 'action.create') ?>
            </a>
        </div>

    </div>
</div>