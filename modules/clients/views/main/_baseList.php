<?php
use Yii;
use yii\helpers\Url;
use app\modules\export\models\Export;
?>
<div class="callout callout-info">
    <div class="row">
        <div class="col-md-2">
            <img src="<?= $model->image->getPreviewWebPath(150, true) ?>">    
        </div>
        <div class="col-md-6">
            <a href="<?= Url::to(['/base/main/view', 'id' => $model->id]); ?>"><?= $model->title ?></a>
            <p><small>Площади: <?= $model->totalSquare ?>/<?= $model->liveSquare ?>/<?= $model->kitchenSquare ?><br />ID: <?= $model->id ?></small></p>
            <div class="row">
                <ul class="list-group list-group-horizontal list-unstyled">
                    <li class="list-group-item">
                        <?php if($model->exp_ya === Export::YANDEX_TRUE){
                            echo '<i class="fas fa-check-circle"></i> ' . Yii::t('app.export', 'Yandex');
                            } else {
                            echo '<i class="fas fa-times-circle"></i> ' . Yii::t('app.export', 'Yandex');
                            }
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php if($model->exp_avito === Export::AVITO_TRUE){
                            echo '<i class="fas fa-check-circle"></i> ' . Yii::t('app.export', 'Avito');
                            } else {
                            echo '<i class="fas fa-times-circle"></i> ' . Yii::t('app.export', 'Avito');
                            }
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php if($model->exp_domclick === Export::DOMCLICK_TRUE){
                            echo '<i class="fas fa-check-circle"></i> ' . Yii::t('app.export', 'Domclick');
                            } else {
                            echo '<i class="fas fa-times-circle"></i> ' . Yii::t('app.export', 'Domclick');
                            }
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php if($model->exp_cian === Export::CIAN_TRUE){
                            echo '<i class="fas fa-check-circle"></i> ' . Yii::t('app.export', 'Cian');
                            } else {
                            echo '<i class="fas fa-times-circle"></i> ' . Yii::t('app.export', 'Cian');
                            }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <h4><?= Yii::$app->formatter->asCurrency($model->price_sale) ?></h4>
        </div>
    </div>
</div>