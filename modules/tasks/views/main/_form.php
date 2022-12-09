<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;


/** @var yii\web\View $this */
/** @var app\modules\base\models\Base $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="base-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'agent')->textInput() ?>

    <?= $form->field($model, 'client')->textInput() ?>

    <?= $form->field($model, 'price_sale')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_owner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_metr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_ads')->textInput() ?>

    <?= $form->field($model, 'type_obj')->textInput() ?>

    <?= $form->field($model, 'kad_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
