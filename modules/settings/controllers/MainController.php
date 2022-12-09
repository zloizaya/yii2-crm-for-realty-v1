<?php

namespace app\modules\settings\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\base\models\Communication;
use app\modules\base\models\TypeWall;
use app\modules\base\models\TypeRepair;
use app\modules\base\models\TypePlot;
use yii\data\ArrayDataProvider;

/**
 * Main controller for the `settings` module
 */
class MainController extends Controller
{
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
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model1 = new Communication();
        $model2 = new TypeWall();
        $model3 = new TypeRepair();
        $model4 = new TypePlot();

        if(Yii::$app->request->post()){
            if ($model1->load(Yii::$app->request->post()) && $model1->save())
            {
                $model1 = new Communication(); //reset model
            }
        }

        if(Yii::$app->request->post()){
            if ($model2->load(Yii::$app->request->post()) && $model2->save())
            {
                $model2 = new TypeWall(); //reset model
            }
        }

        if(Yii::$app->request->post()){
            if ($model3->load(Yii::$app->request->post()) && $model3->save())
            {
                $model3 = new TypeRepair(); //reset model
            }
        }

        if(Yii::$app->request->post()){
            if ($model4->load(Yii::$app->request->post()) && $model4->save())
            {
                $model4 = new TypePlot(); //reset model
            }
        }

        $items1 = $model1->find()->all();
        $itemlist1 = new ArrayDataProvider([
            'allModels' => $items1,
        ]);

        $items2 = $model2->find()->all();
        $itemlist2 = new ArrayDataProvider([
            'allModels' => $items2,
        ]);

        $items3 = $model3->find()->all();
        $itemlist3 = new ArrayDataProvider([
            'allModels' => $items3,
        ]);

        $items4 = $model4->find()->all();
        $itemlist4 = new ArrayDataProvider([
            'allModels' => $items4,
        ]);

        return $this->render('index', [
            'model1' => $model1,
            'model2' => $model2, 
            'model3' => $model3,
            'model4' => $model4,
            'dataProvider1' => $itemlist1,
            'dataProvider2' => $itemlist2,
            'dataProvider3' => $itemlist3,
            'dataProvider4' => $itemlist4,
        ]);
    }

    public function actionDeletecomm($id)
    {
        $model = new Communication();
        $model->findOne($id)->delete();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true];
        }

        return $this->redirect(['/settings']);
    }

    public function actionDeletewall($id)
    {
        $model = new TypeWall();
        $model->findOne($id)->delete();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true];
        }

        return $this->redirect(['/settings']);
    }

    public function actionDeleterepair($id)
    {
        $model = new TypeRepair();
        $model->findOne($id)->delete();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true];
        }

        return $this->redirect(['/settings']);
    }

    public function actionDeleteplot($id)
    {
        $model = new TypePlot();
        $model->findOne($id)->delete();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true];
        }

        return $this->redirect(['/settings']);
    }
}
