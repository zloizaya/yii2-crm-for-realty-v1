<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\developers\models\Developers $model */

$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Застройщики', 'url' => ['index']];
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
