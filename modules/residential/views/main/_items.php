<?php
use Yii;
use yii\i18n\Formatter;
use yii\helpers\Url;
use app\modules\residential\models\Residential;

?>  
<div class="callout callout-info">
    <div class="row">
        <div class="col-md-2">
            <img src="<?= $model->image->getPreviewWebPath(150, true) ?>">
        </div>
        <div class="col-md-6">
            <a href="<?= Url::to(['main/view', 'id' => $model->id]); ?>"><?= $model->title ?></a>
            <p><small>Площади: <?= $model->squares ?><br /><?= $model->land ?>, <?= $model->city ?>, <?= $model->street ?></small></p>
        </div>
        <div class="col-md-4">
            <a href="<?= Url::to(['/developers/main/view', 'id' => $model->developers->id]) ?>"><?= $model->developers->name ?></a>
            <p><small>Закон: <?= $model->fzName ?><br />Срок сдачи: <?= Yii::$app->formatter->asDate($model->deadline) ?></small></p>
        </div>
    </div>
</div>