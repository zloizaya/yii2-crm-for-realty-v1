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
            <a href="<?= Url::to(['/base/main/view', 'id' => $model->id]); ?>"><?= $model->title ?></a>
            <p><small>Площади: <?= $model->totalSquare ?>/<?= $model->liveSquare ?>/<?= $model->kitchenSquare ?><br />ID: <?= $model->id ?></small></p>
        </div>
        <div class="col-md-4">
            <?= Yii::$app->formatter->asCurrency($model->price_sale) ?>
        </div>
    </div>
</div>