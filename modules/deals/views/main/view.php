<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\editable\Editable;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\modules\clients\models\Clients;
use app\modules\base\models\Base;

/** @var yii\web\View $this */
/** @var app\modules\base\models\Base $model */

$this->title = 'ID: ' . $model->id . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app.deals', 'Deals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$script = <<< JS
$('#js-type').on('change',function(){
    var selection = $(this).val();
$('div#values>div').hide();
$("#"+selection).show();
});
JS;
$position = $this::POS_END;
$this->registerJs($script, $position);
?>
<?php Pjax::begin(); ?>
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h4><?= Yii::t('app.deals', 'Information') ?></h4>
                    </div>
                    <div class="col-sm-8">
                        <span class="float-right">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Печать док-тов
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <?= Html::a('Предварительный', ['#', 'form' => 'pred'], ['class' => 'dropdown-item']) ?>
                                    <?= Html::a('Основной', ['#', 'form' => 'dog'], ['class' => 'dropdown-item']) ?>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b><?= Yii::t('app.deals', 'Status') ?>:</b>
                        <span class="float-right">
                            <?= Editable::widget([
                                    'name'=>'status', 
                                    'pjaxContainerId' => 'p0',
                                    'pluginEvents' => [
                                        "editableSuccess"=>"function(event, val, form, data) { $.pjax.reload({container: '#p0', timeout: false}); }",
                                    ],
                                    'value' => $model->statusName,
                                    'asPopover' => false,
                                    'header' => Yii::t('app.deals', 'Status'),
                                    'inputType' => Editable::INPUT_DROPDOWN_LIST,
                                    'data' => $model::getStatusesArray(),
                                    'options' => ['class'=>'form-control'],
                            ]); ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.deals', 'Type Deal') ?>:</b>
                        <span class="float-right">
                            <?= Editable::widget([
                                    'name'=>'type_deal', 
                                    'pjaxContainerId' => 'p0',
                                    'pluginEvents' => [
                                        "editableSuccess"=>"function(event, val, form, data) { $.pjax.reload({container: '#p0', timeout: false}); }",
                                    ],
                                    'value' => $model->typeName,
                                    'asPopover' => false,
                                    'header' => Yii::t('app.deals', 'Type Deal'),
                                    'inputType' => Editable::INPUT_DROPDOWN_LIST,
                                    'data' => $model::getTypeArray(),
                                    'options' => ['class'=>'form-control'],
                            ]); ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.deals', 'Object') ?>:</b><span class="float-right"> <?= Html::a($model->objects->title, ['/base/main/view', 'id' => $model->object]) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.deals', 'Price') ?>:</b>
                        <span class="float-right">
                            <?= Editable::widget([
                                    'name'=>'price', 
                                    'pjaxContainerId' => 'p0',
                                    'pluginEvents' => [
                                        "editableSuccess"=>"function(event, val, form, data) { $.pjax.reload({container: '#p0', timeout: false}); }",
                                    ],
                                    'value' => Yii::$app->formatter->asCurrency($model->price),
                                    'asPopover' => false,
                                    'header' => Yii::t('app.deals', 'Price'),
                                    'options' => ['class'=>'form-control'],
                            ]); ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.deals', 'Price owner') ?>:</b>
                        <span class="float-right">
                            <?= Editable::widget([
                                    'name'=>'price_owner', 
                                    'pjaxContainerId' => 'p0',
                                    'pluginEvents' => [
                                        "editableSuccess"=>"function(event, val, form, data) { $.pjax.reload({container: '#p0', timeout: false}); }",
                                    ],
                                    'value' => Yii::$app->formatter->asCurrency($model->price_owner),
                                    'asPopover' => false,
                                    'header' => Yii::t('app.deals', 'Price owner'),
                                    'options' => ['class'=>'form-control'],
                            ]); ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.deals', 'Commission') ?>:</b>
                        <span class="float-right">
                            <?= Editable::widget([
                                    'name'=>'commission', 
                                    'pjaxContainerId' => 'p0',
                                    'pluginEvents' => [
                                        "editableSuccess"=>"function(event, val, form, data) { $.pjax.reload({container: '#p0', timeout: false}); }",
                                    ],
                                    'value' => Yii::$app->formatter->asCurrency($model->commission),
                                    'asPopover' => false,
                                    'header' => Yii::t('app.deals', 'Commision'),
                                    'options' => ['class'=>'form-control'],
                            ]); ?>
                        </span>
                    </li>
                    <?php if(!empty($model->commission && $model->price)): ?>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.deals', 'Commission') ?>(%):</b>
                        <span class="float-right">
                            <?= Yii::$app->formatter->asPercent($model->commission/$model->price, 2); ?>    
                        </span>
                    </li>
                    <?php endif; ?>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.deals', 'Legal support') ?>:</b>
                        <span class="float-right">
                            <?= Editable::widget([
                                'name'=>'leg_sup', 
                                'pjaxContainerId' => 'p0',
                                'pluginEvents' => [
                                    "editableSuccess"=>"function(event, val, form, data) { $.pjax.reload({container: '#p0', timeout: false}); }",
                                ],
                                'value' => Yii::$app->formatter->asCurrency($model->leg_sup),
                                'asPopover' => false,
                                'header' => Yii::t('app.deals', 'Legal support'),
                                'options' => ['class'=>'form-control'],
                            ]); ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h4><?= Yii::t('app.deals', 'Members') ?></h4>
                    </div>
                    <div class="col-sm-6">
                        <span class="float-right">
                            <?= Html::a(Yii::t('app.deals', 'Add member'), ['#'], ['class' => 'btn btn-success btn-sm', 'data-toggle' => 'modal', 'data-target' => '#modal-newmember']) ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b><?= Yii::t('app.deals', 'Responsible') ?>:</b>
                        <span class="float-right">
                            <?php $editable = Editable::begin([
                                'name'=>'responsible', 
                                'pjaxContainerId' => 'p0',
                                'pluginEvents' => [
                                    "editableSuccess"=>"function(event, val, form, data) { $.pjax.reload({container: '#p0', timeout: false}); }",
                                ],
                                'value' => $model->resp->full_name,
                                'asPopover' => false,
                                'inputType' => Editable::INPUT_HIDDEN,
                                'data' => ArrayHelper::map($model->agents, 'id', 'full_name'),
                                'contentOptions' => ['style'=>'width:350px'],
                                'options' => ['class'=>'form-control'],
                            ]); 
                            $form = $editable->getForm();
                            $editable->beforeInput = $form->field($model, 'responsible')->widget(\kartik\select2\Select2::classname(), [
                                'data'=>ArrayHelper::map($model->agents, 'id', 'full_name'),
                                'options'=>['placeholder'=>'Выберите агента...'],
                                'pluginOptions'=>['allowClear'=>true]
                            ])->label(false) . "\n";
                            Editable::end();
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.deals', 'Seller') ?>:</b>
                        <span class="float-right">
                            <?= Html::a($model->sell->fullName, ['/clients/main/view', 'id'=>$model->seller]) ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.deals', 'Buyer') ?>:</b><span class="float-right"><?= Html::a($model->buy->fullName, ['/clients/main/view', 'id'=>$model->buyer]) ?></span>
                    </li>
                </ul>
                <?php if(!empty($model->members)): ?>
                <h5><?= Yii::t('app.deals', 'Outside members') ?></h5>
                <ul class="list-group list-group-unbordered mb-3">
                    
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h4><?= Yii::t('app.deals', 'Tasks') ?></h4>
                    </div>
                    <div class="col-sm-6">
                        <span class="float-right">
                            <?= Html::a(Yii::t('app.deals', 'Add task'), ['#'], ['class' => 'btn btn-success btn-sm']) ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <?= Yii::t('app.deals', 'Comments') ?>
            </div>
            <div class="card-body">
                <?php echo \yii2mod\comments\widgets\Comment::widget([
                    'model' => $model,
                    'dataProviderConfig' => [
                        'pagination' => [
                        'pageSize' => 10
                        ],
                    ]
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h4><?= Yii::t('app.deals', 'Documents') ?></h4>
                    </div>
                    <div class="col-sm-6">
                        <span class="float-right">
                            <?= Html::a(Yii::t('app.deals', 'Add doc'), ['#'], ['class' => 'btn btn-success btn-sm', 'data-toggle' => 'modal', 'data-target' => '#modal-newdoc']) ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'showHeader' => false,
                    'summary' => false,
                    'tableOptions' => [
                        'class' => 'table'
                    ],
                    'columns' => [
                        [
                            'label' => 'name',
                            'format' => 'raw',
                             'value' => function($data){
                                return Html::a($data->name, ['download', 'document' => $data->alias], ['target' => '_blank']);
                             }
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'template' => '{delete}',
                            'contentOptions'=>['style'=>'width: 50px'],
                            'urlCreator' => function ($action, $model, $key, $index, $column) {
                                return Url::toRoute(['deletedoc', 'document' => $model->alias]);
                            }
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <?= Yii::t('app.deals', 'History') ?>
            </div>
        </div>
    </div>    
</div>
<?php Pjax::end(); ?>
<div class="modal fade" id="modal-newdoc">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= Yii::t('app.deals', 'Add Doc') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin([
                'action' => ['/deals/main/newdoc', 'id' => $model->id],
                'options' => [
                    'name' => 'NewDoc',
                    'enctype' => 'multipart/form-data',
                ]
            ]); ?>
            <div class="modal-body">
                <?= $form->field($model, 'docs[]')->widget(FileInput::classname(), [
                    'language' => 'ru',
                    'options' => [
                        'multiple' => true
                    ],
                    'pluginOptions'=> [
                        'allowedFileExtensions' => ['pdf','docx','png'],
                        'previewFileType' => 'any',
                        'showUpload' => false,
                    ],
                ])->label(false); ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton(Yii::t('app.deals', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-newmember">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= Yii::t('app.deals', 'Add Member') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin([
                'action' => [
                    '/deals/main/addmember',
                    'id' => $model->id,
                ],
                'options' => [
                    'name' => 'NewMember',
                ]]); ?>
            <div class="modal-body">
                <div class="col-sm-12">
                    <?= $form->field($model, 'field')->dropDownList([
                        'agent_id' => Yii::t('app.deals', 'Agent'),
                        'seller_id' => Yii::t('app.deals', 'Seller'),
                        'buyer_id' => Yii::t('app.deals', 'Buyer'),
                        'outside_name' => Yii::t('app.deals', 'Outside agent'),
                        ],
                        ['id' => 'js-type'])->label(false);
                    ?>
                    <div id="agent_id" style="display:none;">
                        <?= $form->field($model, 'aid')->widget(Select2::classname(), [ 
                            'data' => ArrayHelper::map(Base::getAgents(), 'id', 'full_name'),
                            'language' => 'ru',
                            'options' => ['placeholder' => Yii::t('app.deals', 'Agent')],
                            'pluginOptions' => [
                                'allowClear' => false,
                            ],
                            ])->label(false)
                        ?>
                    </div>
                    <div id="buyer_id" style="display:none;">
                        <?= $form->field($model, 'bid')->widget(Select2::classname(), [ 
                            'data' => ArrayHelper::map(Clients::getAll(), 'id', 'fullName'),
                            'language' => 'ru',
                            'options' => ['placeholder' => Yii::t('app.deals', 'Buyer')],
                            'pluginOptions' => [
                                'allowClear' => false,
                            ],
                            ])->label(false)
                        ?>
                    </div>
                    <div id="seller_id" style="display:none;">
                        <?= $form->field($model, 'sid')->widget(Select2::classname(), [ 
                            'data' => ArrayHelper::map(Clients::getAll(), 'id', 'fullName'),
                            'language' => 'ru',
                            'options' => ['placeholder' => Yii::t('app.deals', 'Seller')],
                            'pluginOptions' => [
                                'allowClear' => false,
                            ],
                            ])->label(false)
                        ?>
                    </div>
                    <div id="outside_name" style="display:none;">
                        <?= $form->field($model, 'oaid')->textInput(['placeholder' => Yii::t('app.deals', 'Outside agent')])->label(false) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton(Yii::t('app.deals', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>