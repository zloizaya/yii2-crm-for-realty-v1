<?php
use Yii;
use yii\i18n\Formatter;
use yii\helpers\Url;
use app\modules\users\models\User;
use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\Clients $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app.resident', 'Residential'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-solid">
	<div class="card-header">
		<?php if(Yii::$app->user->can('updateResidential')): ?>
		<?= Html::a(Yii::t('app.resident', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?> 
		<?php endif; ?>
		<?php if(Yii::$app->user->can('deleteResidential')): ?>
            <?= Html::a(Yii::t('app.resident', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-sm',
                'data' => [
                    'confirm' => Yii::t('app.resident', 'Are you sure you want to delete the object?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-sm-5">
				<h3 class="d-inline-block d-sm-none"><?= $model->title ?></h3>
				<div class="col-12">
            		<img src="<?= $model->image->getPreviewWebPath(500, true) ?>">
				</div>
				<div class="col-12 product-image-thumbs">
					
						<?php echo \floor12\files\components\FileListWidget::widget([
                           'files' => $model->images, 
                           'downloadAll' => false, 
                        ]) ?>
					
				</div>
			</div>
			<div class="col-12 col-sm-7">
				<h3 class="my-3"><?= $model->title ?></h3>
				<p><?= $model->land ?>, <?= $model->city ?>, <?= $model->street ?>, <?= $model->home ?></p>
				<ul class="list-unstyled">
					<li><a href="<?= Url::to(['/developers/main/view', 'id' => $model->developers->id]) ?>"><?= $model->developers->name ?></a></li>
					<li><?= Yii::t('app.resident', 'Law') ?>: <?= $model->fzName?></li>
					<li><?= Yii::t('app.resident', 'Floors') ?>: <?= $model->floors ?></li>
					<li><?= Yii::t('app.resident', 'Squares') ?>: <?= $model->squares ?></li>
					<li><?= Yii::t('app.resident', 'Type wall') ?>: <?= $model->type_buildings ?></li>
					<li><?= Yii::t('app.resident', 'Stage') ?>: <?= $model->stage ?></li>
					<li><?= Yii::t('app.resident', 'Deadline') ?>: <?= $model->deadline ?></li>
				</ul>
				<hr>
				<?= $model->description ?>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-sm-12">
				<div class="card card-primary card-outline card-tabs">
					<div class="card-header p-0 pt-1 border-bottom-0">
						<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false"><?= Yii::t('app.resident', 'Objects') ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false"><?= Yii::t('app.resident', 'Map') ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false"><?= Yii::t('app.resident', 'Comments') ?></a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content" id="custom-tabs-three-tabContent">
							<div class="tab-pane fade active show" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
								<?= ListView::widget([
			                        'dataProvider' => $dataProvider,
			                        'itemOptions' => ['class' => 'item'],
			                        'itemView' => '_resItems',
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
							<div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
								Maps
							</div>
							<div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
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
	</div>
</div>