<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Countries */
/* @var $form yii\widgets\ActiveForm */
?>

<?php

$this->registerJs(
   '$("document").ready(function(){ 
		$("#new_communication").on("pjax:end", function() {
			$.pjax.reload(container:"#communication", {timeout : false});  //Reload GridView
		});
    });'
);
?>
<?php yii\widgets\Pjax::begin(['id' => 'new_communication']) ?>
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false, 
        'options' => [
            'autocomplete' => 'off', 'data-pjax' => true 
            ]
        ]); ?>
        <div class="row">
            <div class="col-md-10">
            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Введите значение', 'class' => 'form-control form-control-sm'])->label(false) ?>
            </div>
            <div class="col-md-2">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary btn-sm']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end() ?>