<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\Clients $model */

$this->title = 'Изменить пароль';
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->full_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить пароль';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_formPwd', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
