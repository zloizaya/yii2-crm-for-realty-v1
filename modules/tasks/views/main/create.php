<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\base\models\Base $model */

$this->title = 'Create Base';
$this->params['breadcrumbs'][] = ['label' => 'Bases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
