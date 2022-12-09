<?php
use Yii;
use yii\i18n\Formatter;
use yii\helpers\Url;
?>  
<div class="callout callout-info">
    <div class="row">
        <div class="col-md-5">
            <a href="<?= Url::to(['main/view', 'id' => $model->id]); ?>"><?= $model->name ?></a>
            <p><small><?= $model->address ?></small></p>
        </div>
        <div class="col-md-4">
            <p><?= Yii::$app->formatter->asPhone($model->phone, 'RU', false); ?>
            <br /><?= Yii::$app->formatter->asEmail($model->email) ?>
            <br /><a href="<?= $model->site ?>" target="_blank">Cайт застройщика</a></p>
        </div>
        <div class="col-md-3">
            <p><?= $model->director ?><br />
            ИНН: <?= $model->inn ?></p>
        </div>
    </div>
</div>