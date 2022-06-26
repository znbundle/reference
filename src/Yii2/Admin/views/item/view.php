<?php

/**
 * @var View $this
 * @var Request $request
 * @var ItemEntity $entity
 */

use yii\helpers\Url;
use yii\web\Request;
use yii\web\View;
use ZnBundle\Reference\Domain\Entities\ItemEntity;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnLib\Components\I18Next\Facades\I18Next;
use ZnLib\Web\Components\Widget\Widgets\Detail\DetailWidget;
use ZnLib\Web\Components\Widget\Widgets\Format\Formatters\EnumFormatter;
use ZnLib\Web\Components\Widget\Widgets\Format\Formatters\LinkFormatter;

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
        'label' => I18Next::t('reference', 'item.attribute.entity'),
        'attributeName' => 'entity',
    ],
    [
        'label' => I18Next::t('reference', 'book.item'),
        'attributeName' => 'book.title',
        'formatter' => [
            'class' => LinkFormatter::class,
            'linkAttribute' => 'bookId',
            'uri' => '/reference/book/view',
        ],
        //'value' => Html::a($entity->getBook()->getTitle(), ['/reference/book/view', 'id' => $entity->getBookId()]),
    ],
    [
        'label' => I18Next::t('reference', 'item.attribute.parent'),
        'attributeName' => 'parent.title',
        'formatter' => [
            'class' => LinkFormatter::class,
            'linkAttribute' => 'parentId',
            'uri' => '/reference/item/view',
        ],
    ],
    [
        'label' => I18Next::t('reference', 'item.attribute.sort'),
        'attributeName' => 'sort',
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
            <a href="<?= Url::to(['/reference/item/update', 'book_id' => $request->getQueryParam('book_id'), 'id' => $entity->getId()]) ?>"
               class="btn btn-primary">
                <i class="fa fa fa-edit"></i>
                <?= I18Next::t('core', 'action.update') ?>
            </a>
            <a href="<?= Url::to(['/reference/item/delete', 'book_id' => $request->getQueryParam('book_id'), 'id' => $entity->getId()]) ?>"
               class="btn btn-danger" data-method="post"
               data-confirm="<?= I18Next::t('web', 'message.delete_confirm') ?>">
                <i class="fa fa-trash"></i>
                <?= I18Next::t('core', 'action.delete') ?>
            </a>
        </div>

    </div>

</div>
