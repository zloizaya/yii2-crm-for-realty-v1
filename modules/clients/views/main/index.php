<?php

use app\modules\clients\models\Clients;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\ClientsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Фильтр</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: none;">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
                <div class="card-body">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'item'],
                        'itemView' => '_items',
                        'summary' => false,
                        'pager' => [
                            'firstPageLabel' => 'Первая',
                            'lastPageLabel' => 'Последняя',
                            'nextPageLabel' => 'Следующая',
                            'prevPageLabel' => 'Предыдущая',        
                            'maxButtonCount' => 5,
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
