<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\Clients $model */

$this->title = $model->name . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center"><?= $model->name ?> <?= $model->middle_name ?></h3>
                <p class="text-muted text-center"><?= $model->surname ?></p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Телефон</b> <span class="float-right"><?= Yii::$app->formatter->asPhone($model->phone) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <span class="float-right"><?= Yii::$app->formatter->asEmail($model->email) ?></span>
                    </li>
                    <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm btn-block']) ?>
                    <?php if(Yii::$app->user->can('deleteClients')): ?>
                    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-sm btn-block',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите удалить клиента?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#activity" data-toggle="tab">Объекты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#timeline" data-toggle="tab">Сделки</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="post">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= ListView::widget([
                                        'dataProvider' => $dataProvider,
                                        'itemOptions' => ['class' => 'item'],
                                        'itemView' => '_baseList',
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
                            <div class="user-block">
                                <span class="username">
                                    <a href="#">Jonathan Burke Jr.</a>
                                </span>
                                <span class="description">Shared publicly - 7:30 PM today</span>
                            </div>
                            <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore the hate as they create awesome
                                tools to help create filler text for everyone from bacon lovers
                                to Charlie Sheen fans.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
