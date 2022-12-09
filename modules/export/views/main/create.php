<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\export\models\Export $model */

$this->title = Yii::t('app.export', 'Create Export');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app.export', 'Exports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="export-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
