<?php

/**
 * @var View $this
 * @var Request $request
 * @var ItemForm $model
 */

use yii\helpers\Html;
use yii\web\Request;
use yii\web\View;
use yii\widgets\ActiveForm;
use ZnBundle\Reference\Yii2\Admin\Forms\ItemForm;
use ZnCore\Base\I18Next\Facades\I18Next;
use ZnYii\Web\Widgets\CancelButton\CancelButtonWidget;

$bookId = $request->getQueryParam('filter')['book_id'];

?>

<div class="row">

    <div class="col-lg-12">

        <?php $form = ActiveForm::begin(['id' => 'itemform']) ?>

        <?= Html::activeHiddenInput($model, 'book_id', ['value' => $bookId]); ?>

        <div class="form-row">
            <div class="form-group col-md-12">
                <?= Html::activeLabel($model, 'title'); ?>
                <?= Html::activeTextInput($model, 'title', ['class' => 'form-control']); ?>
                <?= Html::error($model, 'title', ['class' => 'text-danger']); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <?= Html::activeLabel($model, 'entity'); ?>
                <?= Html::activeTextInput($model, 'entity', ['class' => 'form-control']); ?>
                <?= Html::error($model, 'entity', ['class' => 'text-danger']); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <?= Html::activeLabel($model, 'sort'); ?>
                <?= Html::activeTextInput($model, 'sort', ['type' => 'number', 'class' => 'form-control']); ?>
                <?= Html::error($model, 'sort', ['class' => 'text-danger']); ?>
            </div>
        </div>

        <?= Html::submitButton(I18Next::t('core', 'action.save'), ['class' => 'btn btn-success']) ?>

        <?= CancelButtonWidget::widget() ?>

        <?php ActiveForm::end() ?>

    </div>

</div>
