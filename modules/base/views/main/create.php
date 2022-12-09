<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\modules\developers\models\Developers $model */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$get = Yii::$app->request->get('form');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php 
            if($get == 'kv'){
                echo $this->render('tmpl/_formKv', [
                    'model' => $model,
                ]);
            };
            if($get == 'land'){
                echo $this->render('tmpl/_formLand', [
                    'model' => $model,
                ]);
            };
            if($get== ''){
                Yii::$app->response->redirect(Url::to(['/site/error'], true));
            }
            ?>
        </div>
    </div>
</div>
