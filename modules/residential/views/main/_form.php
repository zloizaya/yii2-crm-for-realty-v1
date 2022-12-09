<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use app\modules\residential\models\Residential;
$model->files = $model->images;
?>

<div class="card card-primary">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'title')->textInput(['placeholder' => 'Название', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'developer')->widget(Select2::classname(), [ 
                    'data' => \yii\helpers\ArrayHelper::map(\app\modules\developers\models\Developers::find()->all(), 'id',
                    'name'),
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Застройщик'],
                    'pluginOptions' => [
                        'allowClear' => false,
                    ],
                    ])->label(false)
                ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'deadline')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Срок сдачи'],
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'land')->textInput(['placeholder'=>'Регион'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'city')->textInput(['placeholder'=>'Город'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'distric')->textInput(['placeholder'=>'Район'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'street')->textInput(['placeholder'=>'Улица'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'law')->widget(Select2::classname(), [ 
                        'data' => Residential::getFzArray(),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Закон'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'floors')->textInput(['placeholder' => 'Этажность', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'squares')->textInput(['placeholder' => 'Площади', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'stage')->textInput(['placeholder' => 'Этап', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'comfort')->textInput(['placeholder' => 'Класс', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'type_buildings')->textInput(['placeholder' => 'Тип здания', 'maxlength' => true])->label(false) ?>
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
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= $form->field($model, 'files')->widget(floor12\files\components\FileInputWidget::class) ?>
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
