<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\residential\models\ResidentialSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="residential-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'developer') ?>

    <?= $form->field($model, 'land') ?>

    <?= $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'distric') ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'law') ?>

    <?php // echo $form->field($model, 'floors') ?>

    <?php // echo $form->field($model, 'squares') ?>

    <?php // echo $form->field($model, 'type_buildings') ?>

    <?php // echo $form->field($model, 'stage') ?>

    <?php // echo $form->field($model, 'deadline') ?>

    <?php // echo $form->field($model, 'comfort') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
