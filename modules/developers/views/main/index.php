<?php

use app\modules\developers\models\Developers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\modules\base\models\DevelopersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Застройщики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?= Html::a('Добавить объект', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
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
