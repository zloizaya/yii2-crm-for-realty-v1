<?php
use Yii;
use yii\i18n\Formatter;
use yii\helpers\Url;
use app\modules\users\models\User;
use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\Clients $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Застройщики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center"><?= $model->name ?></h3>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Телефон</b> <span class="float-right"><?= Yii::$app->formatter->asPhone($model->phone) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <span class="float-right"><?= Yii::$app->formatter->asEmail($model->email) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Сайт</b> <span class="float-right"><a href="<?= $model->site ?>" target="_blank"><?= $model->site ?></a></span>
                    </li>
                    <li class="list-group-item">
                        <b>Директор</b> <span class="float-right"><?= $model->director ?></span>
                    </li>
                    <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm btn-block']) ?>
                    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-sm btn-block',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите удалить застройщика?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#activity" data-toggle="tab">Комплексы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#timeline" data-toggle="tab">Реквизиты</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="post">
                            <div class="callout callout-info">
                                <div class="col-md-12">
                                    <?= ListView::widget([
                                        'dataProvider' => $dataProvider,
                                        'itemOptions' => ['class' => 'item'],
                                        'itemView' => '_devList',
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
                            <div class="row">
                                <table class="table table-striped">
                                    <tr>
                                        <td>ИНН</td>
                                        <td><?= $model->inn ?></td>
                                    </tr>
                                    <tr>
                                        <td>КПП</td>
                                        <td><?= $model->kpp ?></td>
                                    </tr>
                                    <tr>
                                        <td>ОГРН</td>
                                        <td><?= $model->ogrn ?></td>
                                    </tr>
                                    <tr>
                                        <td>Адрес</td>
                                        <td><?= $model->address ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
