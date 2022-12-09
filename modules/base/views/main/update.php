<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\modules\developers\models\Developers $model */

$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->render('tmpl/_updateKv', [
                    'model' => $model,
                ]);?>
        </div>
    </div>
</div>
