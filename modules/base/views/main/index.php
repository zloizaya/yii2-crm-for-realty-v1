<?php

use app\modules\base\models\Base;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\modules\base\models\BaseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Объекты';
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
            <div>
                <div class="card-header">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Новый объект
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <?= Html::a('Квартира', ['create', 'form' => 'kv'], ['class' => 'dropdown-item']) ?>
                            <?= Html::a('Земля', ['create', 'form' => 'land'], ['class' => 'dropdown-item']) ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'item'],
                        'itemView' => 'tmpl/_list',
                        'summary' => false,
                        'pager' => [
                            'firstPageLabel' => 'Первая',
                            'lastPageLabel' => 'Последняя',
                            'nextPageLabel' => 'Следующая',
                            'prevPageLabel' => 'Предыдущая',        
                            'maxButtonCount' => 5,
                            'options' => [
                                'tag' => 'ul',
                                'class' => 'pagination pagination-sm',
                            ],
                            'linkOptions' => ['class' => 'page-link'],
                            'firstPageCssClass' => '',
                            'lastPageCssClass' => '',
                            'activePageCssClass' => 'active',
                            'disabledPageCssClass' => 'disabled',
                            'linkContainerOptions' => ['class' => 'page-item'],
                            'prevPageCssClass' => 'page-item',
                            'registerLinkTags' => true,
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

