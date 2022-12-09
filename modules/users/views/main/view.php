<?php
use Yii;
use yii\i18n\Formatter;
use yii\helpers\Url;
use app\modules\users\models\User;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\Clients $model */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(
'$("document").ready(function(){
    $(".myButtom").click(function() {
        $.pjax.reload({container:"#userstatus"}); //Reload GridView
        });
    });'
);
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center"><?= $model->full_name ?></h3>
                <p class="text-muted text-center"><?= $model->position ?></p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Телефон</b> <span class="float-right"><?= Yii::$app->formatter->asPhone($model->phone) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <span class="float-right"><?= Yii::$app->formatter->asEmail($model->email) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Логин</b> <span class="float-right"><?= $model->username ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Статус</b> <span class="float-right"><?= $model->statusName ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Работает с</b> <span class="float-right"><?= Yii::$app->formatter->asDate($model->created_at) ?></span>
                    </li>
                    <?php Pjax::begin(['id' => 'userstatus']); ?>
                    <?php if($model->status === User::STATUS_BLOCKED): ?>
                    <?= Html::a('Разблокировать', ['unblock', 'id' => $model->id], [
                        'class' => 'btn btn-primary btn-sm btn-block',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите разблокировать пользователя?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?php else: ?>
                    <?= Html::a('Блокировать', ['block', 'id' => $model->id], [
                        'class' => 'btn btn-primary btn-sm btn-block',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите заблокировать пользователя?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?php endif; ?>
                    <?php Pjax::end(); ?>
                    <p>&nbsp;</p>
                    <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm btn-block']) ?>
                    <?php if(Yii::$app->user->can('deleteClients')): ?>
                    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-sm btn-block',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите удалить пользователя?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?php endif; ?>
                    <?= Html::a('Изменить пароль', ['changepwd', 'id' => $model->id], ['class' => 'btn btn-secondary btn-sm btn-block']) ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#objects" data-toggle="tab">Объекты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#deals" data-toggle="tab">Сделки</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tasks" data-toggle="tab">Задачи</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="objects">
                        <div class="post">
                            <div class="row">
                                <div class="col-sm-12">
                                <?= ListView::widget([
                                    'dataProvider' => $baselist,
                                    'itemOptions' => ['class' => 'item'],
                                    'itemView' => '_userBaseList',
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
                    <div class="tab-pane" id="deals">
                        <div class="post">
                            <div class="callout callout-info">
                                <div class="row">
                                    <?= ListView::widget([
                                        'dataProvider' => $dealslist,
                                        'itemOptions' => ['class' => 'item'],
                                        'itemView' => '_userDealList',
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
                    <div class="tab-pane" id="tasks">
                        <div class="post">
                            <div class="callout callout-info">
                                <div class="row">
                                    <?= ListView::widget([
                                        'dataProvider' => $tasklist,
                                        'itemOptions' => ['class' => 'item'],
                                        'itemView' => '_userTaskList',
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
            </div>
        </div>
    </div>
</div>
