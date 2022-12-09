<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var app\modules\users\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="card card-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'username')->textInput(['placeholder' => 'Логин', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'full_name')->textInput(['placeholder' => 'ФИО', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'position')->textInput(['placeholder' => 'Должность', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, ['mask' => '(999)999-99-99',])->label(false) ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
