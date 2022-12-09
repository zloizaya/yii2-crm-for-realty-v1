<?php
use Yii;
use yii\i18n\Formatter;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-5">
        <a href="<?= Url::to(['/residential/main/view', 'id' => $model->id]); ?>"><?= $model->title ?></a>
    </div>
    <div class="col-md-4">
        <p>Что-то</p>
    </div>
    <div class="col-md-3">
        <p>Что-то</p>
    </div>
</div>