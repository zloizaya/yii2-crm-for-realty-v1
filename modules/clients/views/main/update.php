<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\Clients $model */

$this->title = 'Редактировать: ' . $model->name . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name . ' ' . $model->surname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
