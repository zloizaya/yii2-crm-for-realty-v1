<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="error-page">
    <div class="error-content" style="margin-left: auto;">
        <h3><i class="fas fa-exclamation-triangle text-danger"></i> <?= Html::encode($name) ?></h3>

        <p>
            <?= nl2br(Html::encode($message)) ?>
        </p>

        <p>
            У вас нет разрешения для выполнения данного действия.
            Обратитесь к руководителю или системному администратору.
            Вы можете <?= Html::a('вернуться на главную', Yii::$app->homeUrl); ?>.
        </p>
    </div>
</div>

