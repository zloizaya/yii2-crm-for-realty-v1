<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use app\modules\base\models\Base;
use app\modules\export\models\Export;
use yii\i18n\Formatter;

$script = <<<JS
$.fn.textToggle = function(d, b, e) {
    return this.each(function(f, a) {
        a = $(a);
        var c = $(d).eq(f),
            g = [b, c.text()],
            h = [a.text(), e];
        c.text(b).show();
        $(a).click(function(b) {
            b.preventDefault();
            c.text(g.reverse()[0]);
            a.text(h.reverse()[0])
        })
    })
};
$(function(){
$('.click-tel').textToggle(".hide-tail","+7XXXXXXX","скрыть телефон")
});
JS;
$position = $this::POS_END;
$this->registerJs($script, $position);
?>    
<div class="callout callout-info">
    <div class="row">
        <div class="col-md-2">
            <img src="<?= $model->image->getPreviewWebPath(150, true) ?>">
        </div>
        <div class="col-md-5">
            <h6><a href="<?= Url::to(['/base/main/view', 'id'=>$model->id]) ?>">ID: <?= $model->id ?> <?= $model->title ?></a></h6>
            <div class="row">
                <div class="col-sm-5">
                    <small>
                        <ul>
                            <li>Общая площадь: <?= $model->totalSquare ?> м<sup><small>2</small></sup></li>
                            <li>жилая площадь: <?= $model->liveSquare ?> м<sup><small>2</small></sup></li>
                            <li>кухня: <?= $model->kitchenSquare ?> м<sup><small>2</small></sup></li> 
                        </ul>
                    </small>
                </div>
                <div class="col-sm-5">
                    <small>
                        <ul>
                            <li>Этаж: <?= $model->floor ?> из <?= $model->floors ?></li>
                            <li>Стены: <?= $model->wallType->name ?></li>
                        </ul>
                    </small>
                </div>
            </div>
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
        <div class="col-md-2 text-center">
            <h5><?= Yii::$app->formatter->asCurrency($model->price_sale) ?></h5>
            <h6><span class="badge bg-success"><?= $model->getStatusesArray()[$model->status] ?></span></h6>
            <h6>Акт: <?= Yii::$app->formatter->asDate($model->updated_at) ?></h6>
        </div>
        <div class="col-md-3 text-center">
            <?php if($model->agent != Yii::$app->user->identity->id){ ?>
                <a href="<?= Url::to(['/clients/main/view', 'id' => $model->client]) ?>"><?= $model->seller->full_name ?></a>
                <p><?= Yii::$app->formatter->asPhone($model->seller->phone, 'RU', false) ?></p>
            <?php } else { ?>
            <a href="<?= Url::to(['/clients/main/view', 'id' => $model->client]) ?>"><?= $model->owner->getFullName() ?></a>
            <p><span class="hide-tail"><?= Yii::$app->formatter->asPhone($model->owner->phone, 'RU', false) ?></span><br /><small><a href="#" class="click-tel">показать телефон</a></small></p>
            <?php }; ?>
        </div>
    </div>
</div>