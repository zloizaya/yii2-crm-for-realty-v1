<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\base\models\BaseSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="base-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'agent') ?>

    <?php // echo $form->field($model, 'client') ?>

    <?php // echo $form->field($model, 'price_sale') ?>

    <?php // echo $form->field($model, 'price_owner') ?>

    <?php // echo $form->field($model, 'price_metr') ?>

    <?php // echo $form->field($model, 'type_ads') ?>

    <?php // echo $form->field($model, 'type_obj') ?>

    <?php // echo $form->field($model, 'kad_number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
