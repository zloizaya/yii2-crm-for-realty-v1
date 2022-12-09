<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\base\models\DevelopersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Параметры системы';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
     $(document).on('ready pjax:success', function() {
         $('.pjax-delete-link').on('click', function(e) {
             e.preventDefault();
             var deleteUrl = $(this).attr('delete-url');
             var pjaxContainer = $(this).attr('pjax-container');
             var result = confirm('Delete this item, are you sure?');                                
             if(result) {
                 $.ajax({
                     url: deleteUrl,
                     type: 'post',
                     error: function(xhr, status, error) {
                         alert('There was an error with your request.' + xhr.responseText);
                     }
                 }).done(function(data) {
                     $.pjax.reload('#' + $.trim(pjaxContainer), {timeout: false});
                 });
             }
         });

     });
 ");
?>
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Справочники
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#main" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Главная</a>
                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#comm" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Коммуникации</a>
                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#wall" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Материал стен</a>
                        <a class="nav-link" id="vert-tabs-elevator-tab" data-toggle="pill" href="#addrepair" role="tab" aria-controls="vert-tabs-addrepair" aria-selected="false">Тип ремонта</a>
                        <a class="nav-link" id="vert-tabs-plot-tab" data-toggle="pill" href="#addplot" role="tab" aria-controls="vert-tabs-plot" aria-selected="false">Типы участка</a>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade show active" id="main" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
                        </div>
                        <div class="tab-pane fade" id="comm" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-9">
                                        <?= $this->render('templ/_addComm', [
                                            'model' => $model1,
                                        ]) ?>
                                        <?php Pjax::begin(['id' => 'communication']) ?>
                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider1,
                                            'showHeader' => false,
                                            'summary' => false,
                                            'tableOptions' => [
                                                'class' => 'table'
                                            ],
                                            'columns' => [
                                                'name',
                                                [
                                                    'class' => ActionColumn::className(),
                                                    'template' => '{delete}',
                                                    'contentOptions'=>['style'=>'width: 50px'],
                                                    'urlCreator' => function ($action, $model, $key, $index, $column) {
                                                        return Url::toRoute(['/settings/main/deletecomm', 'id' => $model->id]);
                                                     }
                                                ],
                                            ],
                                        ]) ?>
                                        <?php Pjax::end() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="wall" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-9">
                                        <?= $this->render('templ/_addTypeWall', [
                                            'model' => $model2,
                                        ]) ?>
                                        <?php Pjax::begin(['id' => 'typewall']) ?>
                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider2,
                                            'showHeader' => false,
                                            'summary' => false,
                                            'tableOptions' => [
                                                'class' => 'table'
                                            ],
                                            'columns' => [
                                                'name',
                                                [
                                                    'class' => ActionColumn::className(),
                                                    'template' => '{delete}',
                                                    'contentOptions'=>['style'=>'width: 50px'],
                                                    'urlCreator' => function ($action, $model, $key, $index, $column) {
                                                        return Url::toRoute(['/settings/main/deletewall', 'id' => $model->id]);
                                                     }
                                                ],
                                            ],
                                        ]) ?>
                                        <?php Pjax::end() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="addrepair" role="tabpanel" aria-labelledby="vert-tabs-addrepair-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-9">
                                        <?= $this->render('templ/_addRepair', [
                                            'model' => $model3,
                                        ]) ?>
                                        <?php Pjax::begin(['id' => 'repair']) ?>
                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider3,
                                            'showHeader' => false,
                                            'summary' => false,
                                            'tableOptions' => [
                                                'class' => 'table'
                                            ],
                                            'columns' => [
                                                'name',
                                                [
                                                    'class' => ActionColumn::className(),
                                                    'template' => '{delete}',
                                                    'contentOptions'=>['style'=>'width: 50px'],
                                                    'urlCreator' => function ($action, $model, $key, $index, $column) {
                                                        return Url::toRoute(['/settings/main/deleterepair', 'id' => $model->id]);
                                                     }
                                                ],
                                            ],
                                        ]) ?>
                                        <?php Pjax::end() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="addplot" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-9">
                                        <?= $this->render('templ/_addPlot', [
                                            'model' => $model4,
                                        ]) ?>
                                        <?php Pjax::begin(['id' => 'plot']) ?>
                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider4,
                                            'showHeader' => false,
                                            'summary' => false,
                                            'tableOptions' => [
                                                'class' => 'table'
                                            ],
                                            'columns' => [
                                                'name',
                                                [
                                                    'class' => ActionColumn::className(),
                                                    'template' => '{delete}',
                                                    'contentOptions'=>['style'=>'width: 50px'],
                                                    'urlCreator' => function ($action, $model, $key, $index, $column) {
                                                        return Url::toRoute(['/settings/main/deleteplot', 'id' => $model->id]);
                                                     }
                                                ],
                                            ],
                                        ]) ?>
                                        <?php Pjax::end() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
