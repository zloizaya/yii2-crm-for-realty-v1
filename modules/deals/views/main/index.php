<?php

use app\modules\base\models\Base;
use app\modules\clients\models\Clients;
use app\modules\deals\models\Deals;
use app\modules\users\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\base\models\BaseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app.deals', 'Deals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?= Html::a(Yii::t('app.deals', 'New Deal'), ['#'], ['class' => 'btn btn-primary btn-sm', 'data-toggle' => 'modal', 'data-target' => '#modal-newdeal']) ?>
                </div>
                <div class="card-body">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'summary' => false,
                            'columns' => [
                                [
                                    'attribute' => 'id',
                                    'vAlign' => 'middle',
                                    'hAlign' => 'center',
                                    'width' => '3%',
                                ],
                                [
                                    'filterType' => GridView::FILTER_SELECT2,
                                    'filter' => Deals::getTypeArray(),
                                    'filterWidgetOptions' => [
                                        'pluginOptions' => ['allowClear' => true],
                                    ],
                                    'filterInputOptions' => ['placeholder' => 'Тип сделки', 'multiple' => false],
                                    'attribute' => 'type_deal',
                                    'format' => 'raw',
                                    'vAlign' => 'middle',
                                    'hAlign' => 'center',
                                    'width' => '9%',
                                    'value' => function ($model, $key, $index, $column) {
                                        $value = $model->{$column->attribute};
                                        switch ($value) {
                                            case Deals::TYPE_SALE:
                                                $class = 'primary';
                                                break;
                                            case Deals::TYPE_ESCORT:
                                            default:
                                                $class = 'warning';
                                        };
                                        $html = Html::tag('span', Html::encode($model->getTypeName()), ['class' => 'badge bg-' . $class]);
                                        return $value === null ? $column->grid->emptyCell : $html;
                                    }
                                ],
                                [
                                    'attribute' => 'title',
                                    'vAlign' => 'middle',
                                    'hAlign' => 'center',
                                    'width' => '26%',
                                    'value' => function ($model, $key, $index, $widget) { 
                                        return Html::a($model->title,  
                                            '/deals/main/view?id=' . $model->id, 
                                        );
                                    },
                                    'format' => 'raw'
                                ],
                                [
                                    'attribute' => 'responsible', 
                                    'vAlign' => 'middle',
                                    'hAlign' => 'center',
                                    'width' => '19%',
                                    'value' => function ($model, $key, $index, $widget) { 
                                        return Html::a($model->resp->full_name,  
                                            '/users/main/view?id=' . $model->responsible, 
                                        );
                                    },
                                    'filterType' => GridView::FILTER_SELECT2,
                                    'filter' => ArrayHelper::map(User::find()->orderBy('id')->asArray()->all(), 'id', 'full_name'), 
                                    'filterWidgetOptions' => [
                                        'pluginOptions' => ['allowClear' => true],
                                    ],
                                    'filterInputOptions' => ['placeholder' => 'Ответственный', 'multiple' => false],
                                    'format' => 'raw'
                                ],
                                /*
                                [
                                    'attribute' => 'seller', 
                                    'vAlign' => 'middle',
                                    'hAlign' => 'center',
                                    'width' => '18%',
                                    'value' => function ($model, $key, $index, $widget) { 
                                        return Html::a($model->sell->fullName,  
                                            '/clients/main/view?id=' . $model->seller, 
                                        );
                                    },
                                    'filterType' => GridView::FILTER_SELECT2,
                                    'filter' => ArrayHelper::map(Clients::find()->orderBy('id')->all(), 'id', 'fullName'), 
                                    'filterWidgetOptions' => [
                                        'pluginOptions' => ['allowClear' => true],
                                    ],
                                    'filterInputOptions' => ['placeholder' => 'Продавец', 'multiple' => false],
                                    'format' => 'raw'
                                ],
                                */
                                [
                                    'attribute' => 'created_at',    
                                    'hAlign' => 'center',
                                    'vAlign' => 'middle',
                                    'width' => '7%',
                                    'format' => 'date',
                                    'xlFormat' => "mmm\\-dd\\, \\-yyyy",
                                    'headerOptions' => ['class' => 'kv-sticky-column'],
                                    'contentOptions' => ['class' => 'kv-sticky-column'],
                                ],
                                [
                                    'attribute' => 'price', 
                                    'vAlign' => 'middle',
                                    'hAlign' => 'center', 
                                    'width' => '8%',
                                    'format' => ['decimal', 2],
                                    'pageSummary' => true
                                ],
                                [
                                    'filterType' => GridView::FILTER_SELECT2,
                                    'filter' => Deals::getStatusesArray(),
                                    'filterWidgetOptions' => [
                                        'pluginOptions' => ['allowClear' => true],
                                    ],
                                    'filterInputOptions' => ['placeholder' => 'Статус', 'multiple' => false],
                                    'attribute' => 'status',
                                    'format' => 'raw',
                                    'vAlign' => 'middle',
                                    'hAlign' => 'center',
                                    'width' => '10%',
                                    'value' => function ($model, $key, $index, $column) {
                                        $value = $model->{$column->attribute};
                                        switch ($value) {
                                            case Deals::STATUS_NEW:
                                                $class = 'primary';
                                                break;
                                            case Deals::STATUS_DOC:
                                                $class = 'info';
                                                break;
                                            case Deals::STATUS_REG:
                                                $class = 'warning';
                                                break;
                                            case Deals::STATUS_OK:
                                                $class = 'success';
                                                break;
                                            case Deals::STATUS_NO:
                                                $class = 'danger';
                                                break;
                                            case Deals::STATUS_WAIT:
                                            default:
                                                $class = 'dark';
                                        };
                                        $html = Html::tag('span', Html::encode($model->getStatusName()), ['class' => 'badge bg-' . $class]);
                                        return $value === null ? $column->grid->emptyCell : $html;
                                    }
                                ],
                            ],
                            'headerContainer' => ['class' => 'kv-table-header'],
                            'containerOptions' => ['class' => 'kv-grid-wrapper'],
                            'floatHeader' => true,
                            'floatPageSummary' => true,
                            'floatFooter' => false,
                            'pjax' => false,
                            'responsive' => true,
                            'bordered' => true,
                            'striped' => false,
                            'condensed' => true,
                            'hover' => true,
                            'showPageSummary' => false,
                            'export' => [
                                'fontAwesome' => true
                            ],
                            'exportConfig' => [
                                'csv' => [],
                                'xls' => [],
                            ],
                            'toolbar' =>  [
                                [
                                    'content' =>
                                        Html::button('<i class="fas fa-plus"></i>', [
                                            'class' => 'btn btn-success',
                                            'title' => 'Add Book',
                                            'onclick' => 'alert("This should launch the book creation form.\n\nDisabled for this demo!");'
                                        ]) . ' '.
                                        Html::a('<i class="fas fa-redo"></i>', ['grid-demo'], [
                                            'class' => 'btn btn-outline-secondary',
                                            'title'=>'Reset Grid',
                                            'data-pjax' => 0, 
                                        ]), 
                                    'options' => ['class' => 'btn-group mr-2 me-2']
                                ],
                                '{export}',
                                '{toggleData}',
                            ],
                            'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
                            'persistResize' => false,
                            'toggleDataOptions' => ['minCount' => 10],
                            //'itemLabelSingle' => 'book',
                            //'itemLabelPlural' => 'books'
                        ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-newdeal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= Yii::t('app.deals', 'New Deal') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>