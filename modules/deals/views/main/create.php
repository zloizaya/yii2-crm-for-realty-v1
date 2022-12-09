<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\base\models\Base $model */

$this->title = Yii::t('app.deals', 'Create new deal');
$this->params['breadcrumbs'][] = ['label' => 'Сделки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
