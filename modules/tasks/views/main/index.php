<?php

use app\modules\tasks\models\Tasks;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\modules\base\models\BaseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Задачи';
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
                    <?= Html::a('Добавить задачу', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
                <div class="card-body">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Мои Задачи</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Все Задачи</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
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
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                All Tasks
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

