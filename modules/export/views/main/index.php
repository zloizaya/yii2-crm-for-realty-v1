<?php

use app\modules\export\models\Export;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use \app\components\grid\SetColumn;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\ClientsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Экспорт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'id',
                            'name',
                            'link',
                            'created_at',
                            'updated_at',
                            [
                                'class' => SetColumn::className(),
                                'filter' => Export::getExportArray(),
                                'attribute' => 'exp_ya',
                                'name' => 'exportName',
                                'cssCLasses' => [
                                    Export::YANDEX_TRUE => 'success',
                                    Export::YANDEX_FALSE => 'warning',
                                ],
                            ],
                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, Export $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                 }
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
