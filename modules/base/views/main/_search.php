<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\modules\base\models\Base;

/** @var yii\web\View $this */
/** @var app\modules\base\models\BaseSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>
<div class="card-body">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <?= $form->field($model, 'id')->textInput(['placeholder' => Yii::t('app.base', 'ID Object')])->label(false) ?>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <?= $form->field($model, 'typeAds')->widget(Select2::classname(), [ 
                        'data' => Base::getAdsArray(),
                        'language' => 'ru',
                        'options' => ['placeholder' => Yii::t('app.base', 'Type Ads')],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <?= $form->field($model, 'typeKv')->widget(Select2::classname(), [ 
                        'data' => Base::getKvArray(),
                        'language' => 'ru',
                        'options' => ['placeholder' => Yii::t('app.base', 'Appartment')],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <?= $form->field($model, 'status')->widget(Select2::classname(), [ 
                    'data' => Base::getStatusesArray(),
                    'language' => 'ru',
                    'options' => ['placeholder' => Yii::t('app.base', 'Status')],
                    'pluginOptions' => [
                        'allowClear' => false,
                    ],
                ])->label(false)
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?= $form->field($model, 'agent')->widget(Select2::classname(), [ 
                    'data' => ArrayHelper::map(Base::getAgents(), 'id', 'full_name'),
                    'language' => 'ru',
                    'options' => ['placeholder' => Yii::t('app.base', 'Agent')],
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
                <?= $form->field($model, 'kadastr')->textInput(['placeholder' => Yii::t('app.base', 'Сadastral number')])->label(false) ?>
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app.base', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app.base', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>




    <?php //echo $form->field($model, 'created_at') ?>

    <?php //echo $form->field($model, 'updated_at') ?>

    <?php //echo $form->field($model, 'agent') ?>

    <?php // echo $form->field($model, 'client') ?>

    <?php // echo $form->field($model, 'price_sale') ?>

    <?php // echo $form->field($model, 'price_owner') ?>

    

    <?php // echo $form->field($model, 'export') ?>

    <?php // echo $form->field($model, 'typeObj') ?>

    <?php // echo $form->field($model, 'rid') ?>

    <?php // echo $form->field($model, 'land') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'house') ?>

    <?php // echo $form->field($model, 'kv') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'totalSquare') ?>

    <?php // echo $form->field($model, 'liveSquare') ?>

    <?php // echo $form->field($model, 'kitchenSquare') ?>

    <?php // echo $form->field($model, 'roomCount') ?>

    <?php // echo $form->field($model, 'floor') ?>

    <?php // echo $form->field($model, 'floors') ?>

    <?php // echo $form->field($model, 'builded') ?>

    <?php // echo $form->field($model, 'wall') ?>

    <?php // echo $form->field($model, 'repair') ?>

    <?php // echo $form->field($model, 'balcon') ?>

    <?php // echo $form->field($model, 'bathroom') ?>

    <?php // echo $form->field($model, 'elevator') ?>

    <?php // echo $form->field($model, 'communication') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'acres') ?>

    <?php // echo $form->field($model, 'plot') ?>
