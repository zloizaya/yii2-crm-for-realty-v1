<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\widgets\MaskedInput;
?>

<div class="card card-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'name')->textInput(['placeholder' => 'Название', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'site')->textInput(['placeholder' => 'Сайт', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, ['mask' => '(999)999-99-99',])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'director')->textInput(['placeholder' => 'Директор', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <?= $form->field($model, 'address')->textInput(['placeholder' => 'Адрес', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'inn')->textInput(['placeholder' => 'ИНН', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'kpp')->textInput(['placeholder' => 'КПП', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'ogrn')->textInput(['placeholder' => 'ОГРН(ИП)', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
                        'options' => ['rows' => 6],
                        'preset' => 'advanced'
                    ])->label(false) ?>
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
