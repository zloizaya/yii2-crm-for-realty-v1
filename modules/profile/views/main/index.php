<?php
use Yii;
use yii\i18n\Formatter;
use yii\helpers\Url;
use app\modules\users\models\User;
use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\Clients $model */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                    <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm btn-block']) ?>
                    <?= Html::a('Изменить пароль', ['changepwd', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm btn-block']) ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#activity" data-toggle="tab">Сделки</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#timeline" data-toggle="tab">Задачи</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="post">
                            <div class="callout callout-info">
                                <div class="row">
                                    <?= ListView::widget([
                                        'dataProvider' => $dataProvider,
                                        'itemOptions' => ['class' => 'item'],
                                        'itemView' => '_myBaseList',
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
                    <div class="tab-pane" id="timeline">
                        <div class="post">
                            <div class="callout callout-info">
                                <div class="row">
                                    <?= ListView::widget([
                                        'dataProvider' => $dataProvider,
                                        'itemOptions' => ['class' => 'item'],
                                        'itemView' => '_myDealsList',
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
