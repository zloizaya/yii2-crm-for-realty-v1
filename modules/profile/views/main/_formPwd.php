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
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'currentPassword')->passwordInput(['placeholder' => 'Текущий пароль', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'newPassword')->passwordInput(['placeholder' => 'Новый пароль', 'maxlength' => true])->label(false) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['placeholder' => 'Повторите пароль', 'maxlength' => true])->label(false) ?>
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