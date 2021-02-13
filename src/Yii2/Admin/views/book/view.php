<?php

/**
 * @var View $this
 * @var Request $request
 * @var BookEntity $entity
 */

use yii\helpers\Url;
use yii\web\Request;
use yii\web\View;
use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnCore\Base\Enums\StatusEnum;
use ZnCore\Base\Libs\I18Next\Facades\I18Next;
use ZnLib\Web\Widgets\Detail\DetailWidget;
use ZnLib\Web\Widgets\Format\Formatters\EnumFormatter;
use ZnYii\Base\Helpers\ActionHelper;

$this->title = $entity->getTitle();

$attributes = [
    [
        'label' => 'ID',
        'attributeName' => 'id',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.title'),
        'attributeName' => 'title',
    ],
    [
        'label' => I18Next::t('reference', 'book.attribute.entity'),
        'attributeName' => 'entity',
    ],
    [
        'label' => I18Next::t('reference', 'book.attribute.levels'),
        'attributeName' => 'levels',
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
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.updated_at'),
        'attributeName' => 'updated_at',
    ],
];

?>

<div class="row">

    <div class="col-lg-12">

        <?= DetailWidget::widget([
            'entity' => $entity,
            'attributes' => $attributes,
        ]) ?>

        <div class="float-left">
            <a href="<?= Url::to(['/reference/item/index', 'filter[book_id]' => $entity->getId()]) ?>"
               class="btn btn-secondary">
                <i class="fa fa-list"></i>
                <?= I18Next::t('reference', 'item.list') ?>
            </a>
            <?= ActionHelper::generateUpdateAction($entity, '/reference/book', ActionHelper::TYPE_BUTTON) ?>
            <?= ActionHelper::generateRestoreOrDeleteAction($entity, '/reference/book', ActionHelper::TYPE_BUTTON) ?>
        </div>

    </div>

</div>
