<?php
use Yii;
use yii\i18n\Formatter;
use yii\helpers\Url;
?>  
<div class="callout callout-info">
    <div class="row">
        <div class="col-md-6">
            <a href="<?= Url::to(['main/view', 'id' => $model->id]); ?>"><?= $model->name ?> <?= $model->middle_name ?> <?= $model->surname ?></a>
        </div>
        <div class="col-md-6">
            <p><?= Yii::$app->formatter->asPhone($model->phone, 'RU', false); ?>
            <br /><?= Yii::$app->formatter->asEmail($model->email) ?>
        </div>
    </div>
</div>