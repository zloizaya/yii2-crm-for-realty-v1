<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\base\models\Base $model */

$this->title = 'Update Base: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
