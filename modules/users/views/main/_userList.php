<?php
use Yii;
use yii\i18n\Formatter;
use yii\helpers\Url;
use app\modules\users\models\User;
?>  
<div class="callout callout-info">
    <div class="row text-center">
        <div class="col-md-2">
            <a href="<?= Url::to(['main/view', 'id' => $model->id]); ?>"><?= $model->username ?></a>
        </div>
        <div class="col-md-4">
            <?= $model->full_name ?><br /><?= $model->position ?>
        </div>
        <div class="col-md-3">
            <p><?= Yii::$app->formatter->asPhone($model->phone, 'RU', false); ?>
            <br /><?= Yii::$app->formatter->asEmail($model->email) ?>
        </div>
        <div class="col-md-2">
            <?= Yii::$app->formatter->asDate($model->created_at) ?><br /><?= $model->statusName ?>
        </div>
    </div>
</div>