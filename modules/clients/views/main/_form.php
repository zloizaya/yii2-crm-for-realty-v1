<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;


/** @var yii\web\View $this */
/** @var app\modules\clients\models\Clients $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card card-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'surname')->textInput(['placeholder' => 'Фамилия', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'name')->textInput(['placeholder' => 'Имя', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'middle_name')->textInput(['placeholder' => 'Отчество', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, ['mask' => '(999)999-99-99',])->label(false) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'p_serial')->textInput(['placeholder' => 'Паспорт серия', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'p_number')->textInput(['placeholder' => 'Паспорт номер', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'p_date_take')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Дата выдачи'],
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'p_code')->textInput(['placeholder' => 'Код подразделения','maxlength' => true])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= $form->field($model, 'p_who_take')->textInput(['placeholder' => 'Кем выдан','maxlength' => true])->label(false) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
