<?php

use Yii;
use app\modules\base\models\Base;
use app\modules\clients\models\Clients;
use app\modules\users\models\User;
use app\modules\deals\models\Deals;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\select2\Select2;


/** @var yii\web\View $this */
/** @var app\modules\base\models\Base $model */
/** @var yii\widgets\ActiveForm $form */
?>
    <?php $form = ActiveForm::begin(['action' => '/deals/main/create']); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'title')->textInput(['placeholder' => Yii::t('app.deals', 'Title')])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'object')->textInput(['placeholder' => Yii::t('app.deals', 'ID Object')])->label(false) ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'price')->widget(\yii\widgets\MaskedInput::class, [
                        'options' => ['placeholder' => Yii::t('app.deals', 'Price sale')],
                        'clientOptions' => [
                            'alias' => 'decimal', 
                            'digits' => 2, 
                            'digitsOptional' => false,
                            'radixPoint' => '.',
                            'groupSeparator' => ',', 
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                        ],
                    ])->label(false) ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'type_deal')->widget(Select2::classname(), [
                        'data' => Deals::getTypeArray(),
                        'language' => 'ru',
                        'options' => ['placeholder' => Yii::t('app.deals', 'Type Deal')],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                    ])->label(false)
                ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'buyer')->widget(Select2::classname(), [ 
                        'data' => ArrayHelper::map(Clients::getAll(), 'id', 'fullName'),
                        'language' => 'ru',
                        'options' => ['placeholder' => Yii::t('app.deals', 'Buyer')],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                    ])->label(false)
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app.deals', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
