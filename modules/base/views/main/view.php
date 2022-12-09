<?php
use Yii;
use yii\i18n\Formatter;
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\users\models\User;
use app\modules\base\models\Base;
use app\modules\export\models\Export;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use dosamigos\ckeditor\CKEditor;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\Clients $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app.base', 'Objects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$metr = (int)$model->price_sale / (int)$model->totalSquare;
$commision = $model->price_sale - $model->price_owner;
$model->communication = json_decode($model->communication);
?>
<div class="row">
    <div class="col-sm-12">
    <?php if( Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <?php if( Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                 <h3 class="profile-username text-center"><?= Yii::$app->formatter->asCurrency($model->price_sale) ?></h3>
                 <p class="text-muted text-center"><?= Yii::$app->formatter->asCurrency($metr) ?> кв.м.</p>
                 <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b><?= Yii::t('app.base', 'Status') ?></b> <span class="float-right"><?= $model->statusName ?></span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.base', 'Created') ?></b> <span class="float-right"><?= Yii::$app->formatter->asDate($model->created_at) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.base', 'Updated') ?></b> <span class="float-right"><?= Yii::$app->formatter->asDate($model->updated_at) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.base', 'Builded') ?></b> <span class="float-right"><?= $model->builded ?></span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.base', 'Squares') ?></b> <span class="float-right"><?= $model->totalSquare ?>/<?= $model->liveSquare ?>/<?= $model->kitchenSquare ?></span> 
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.base', 'Floor') ?></b> <span class="float-right"><?= $model->floor ?>/<?= $model->floors ?></span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.base', 'Repair') ?></b> <span class="float-right"><?= $model->repairType->name ?></span>
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.base', 'Wall') ?></b> <span class="float-right"><?= $model->wallType->name ?></span> 
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.base', 'Balcon') ?></b> <span class="float-right"><?= $model->balconName ?></span> 
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.base', 'Bathroom') ?></b> <span class="float-right"><?= $model->bathroomName ?></span> 
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.base', 'Elevator') ?></b> <span class="float-right"><?= $model->elevatorName ?></span> 
                    </li>
                    <li class="list-group-item">
                        <b><?= Yii::t('app.base', 'Communication') ?></b> <span class="float-right"><?= implode(', ', (array)$model->communication) ?></span>
                    </li>
                </ul>
                <?= Html::a(Yii::t('app.base', 'Presentation'), ['#', 'id' => $model->id], ['class' => 'btn btn-default btn-sm btn-block']) ?>
                <?php if($model->status === Base::TYPE_INSALE && $model->agent === Yii::$app->user->identity->id || Yii::$app->user->identity->role->name === 'manager' || Yii::$app->user->identity->role->name === 'admin'): ?>
                <?= Html::a(Yii::t('app.base', 'Withdraw from sale'), ['/base/main/drop', 'id' => $model->id], [
                    'class' => 'btn btn-primary btn-sm btn-block', 
                    'data' => [
                        'confirm' => Yii::t('app.base', 'Are you sure you want to withdraw the object from sale?'),
                        'method' => 'post',
                    ],
                ]) ?>
                <?php endif; ?>
                <?php if($model->status != Base::TYPE_INSALE): ?>
                <?= Html::a(Yii::t('app.base', 'Put up for sale'), ['/base/main/sale', 'id' => $model->id], [
                    'class' => 'btn btn-primary btn-sm btn-block', 
                    'data' => [
                        'confirm' => Yii::t('app.base', 'Are you sure you want to put the property back on sale?'),
                        'method' => 'post',
                    ],
                ]) ?>
                <?php endif; ?>
                <?php if($model->agent === Yii::$app->user->identity->id || Yii::$app->user->identity->role->name === 'manager' || Yii::$app->user->identity->role->name === 'admin'): ?>
                <?= Html::a(Yii::t('app.base', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm btn-block']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm btn-block', 
                    'data' => [
                        'confirm' => Yii::t('app.base', 'Are you sure you want to delete the object?'),
                        'method' => 'post',
                    ],
                ]) ?>
                <?php endif; ?>
             </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <?php echo \floor12\files\components\FileListWidget::widget([
                           'files' => $model->images, 
                           'downloadAll' => false, 
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#info" data-toggle="tab"><?= Yii::t('app.base', 'Information') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#activity" data-toggle="tab"><?= Yii::t('app.base', 'Deals') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#timeline" data-toggle="tab"><?= Yii::t('app.base', 'Tasks') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#secret" data-toggle="tab"><?= Yii::t('app.base', 'Detail') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#export" data-toggle="tab"><?= Yii::t('app.base', 'Export') ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="info">
                                <div class="post">    
                                    <?= $model->description ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="activity">
                                <div class="post">
                                    <div class="callout callout-info">
                                        <div class="row">
                                            arrayData
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="timeline">
                                <div class="post">
                                    <div class="callout callout-info">
                                        <div class="row">
                                            arrayData
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($model->agent === Yii::$app->user->identity->id): ?>
                            <div class="tab-pane" id="secret">
                                <div class="post">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b><?= Yii::t('app.base', 'Address') ?>:</b> <span class="float-right"><?= $model->fullAddress ?></span>
                                                </li>
                                                <li class="list-group-item">
                                                    <b><?= Yii::t('app.base', 'Owner') ?>:</b> <span class="float-right"><a href="<?= Url::to(['/clients/main/view', 'id' => $model->client]); ?>"><?= $model->owner->fullName ?></a></span>
                                                </li>
                                                <li class="list-group-item">
                                                    <b><?= Yii::t('app.base', 'Phone') ?>:</b> <span class="float-right"><?= Yii::$app->formatter->asPhone($model->owner->phone) ?></span>
                                                </li>
                                                <li class="list-group-item">
                                                    <b><?= Yii::t('app.base', 'Seller price') ?>:</b> <span class="float-right"><?= Yii::$app->formatter->asCurrency($model->price_owner) ?></span>
                                                </li>
                                                <li class="list-group-item">
                                                    <b><?= Yii::t('app.base', 'Commision') ?>:</b> <span class="float-right"><?= Yii::$app->formatter->asCurrency($commision) ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="tab-pane" id="secret">
                                <div class="post">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b><?= Yii::t('app.base', 'Agent') ?>:</b> <span class="float-right"><a href="<?= Url::to(['/users/main/view', 'id' => $model->agent]); ?>"><?= $model->seller->full_name ?></a></span>
                                                </li>
                                                <li class="list-group-item">
                                                    <b><?= Yii::t('app.base', 'Phone') ?>:</b> <span class="float-right"><?= Yii::$app->formatter->asPhone($model->seller->phone) ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="tab-pane" id="export">
                                <div class="post">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <?php if($model->exp_ya === Export::YANDEX_TRUE){
                                                echo '<i class="fas fa-check-circle"></i> ' . Yii::t('app.export', 'Yandex Export True');
                                            } else {
                                                echo '<i class="fas fa-times-circle"></i> ' . Yii::t('app.export', 'Yandex Export False');
                                            }
                                            ?>
                                        </li>
                                        <li class="list-group-item">
                                            <?php if($model->exp_avito === Export::AVITO_TRUE){
                                                echo '<i class="fas fa-check-circle"></i> ' . Yii::t('app.export', 'Avito Export True');
                                            } else {
                                                echo '<i class="fas fa-times-circle"></i> ' . Yii::t('app.export', 'Avito Export False');
                                            }?>
                                        </li>
                                        <li class="list-group-item">
                                            <?php if($model->exp_domclick === Export::DOMCLICK_TRUE){
                                                echo '<i class="fas fa-check-circle"></i> ' . Yii::t('app.export', 'Domclick Export True');
                                            } else {
                                                echo '<i class="fas fa-times-circle"></i> ' . Yii::t('app.export', 'Domclick Export False');
                                            }?>
                                        </li>
                                        <li class="list-group-item">
                                            <?php if($model->exp_cian === Export::CIAN_TRUE){
                                                echo '<i class="fas fa-check-circle"></i> ' . Yii::t('app.export', 'Cian Export True');
                                            } else {
                                                echo '<i class="fas fa-times-circle"></i> ' . Yii::t('app.export', 'Cian Export False');
                                            }?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>      
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <?= Yii::t('app.base', 'Comments') ?>
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
        </div>
    </div>
</div>
