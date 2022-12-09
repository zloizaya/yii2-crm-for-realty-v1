<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\ClientsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <?= $form->field($model, 'id') ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'surname') ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'name') ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'middle_name') ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'phone') ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'email') ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'p_serial') ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'p_number') ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'p_date_take')->widget(DatePicker::classname(), [
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'p_code') ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= $form->field($model, 'p_who_take') ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <?= Html::submitButton('Искать', ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::resetButton('Сбросить', ['class' => 'btn btn-outline-secondary btn-sm']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
