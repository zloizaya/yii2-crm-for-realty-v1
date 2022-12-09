<?php

namespace app\modules\export\controllers;

use Yii;
use app\modules\export\models\Export;
use app\modules\export\models\ExportSearch;
use app\modules\base\models\Base;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

/**
 * MainController implements the CRUD actions for Export model.
 */
class MainController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Export models.
     *
     * @return string
     */

    public function actionYafeed()
    {
        $model = new Base();
        $query = $model->find()->where('exp_ya = :exp_ya', [':exp_ya' => Export::YANDEX_TRUE])->all();
        $itemlist = new ArrayDataProvider([
            'allModels' => $query,
        ]);
        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'text/xml');
        return $this->renderPartial('feed/yandex', [
            'dataProvider' => $itemlist,
            'model' => $model,
        ]);
    }
}
