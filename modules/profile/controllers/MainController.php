<?php

namespace app\modules\profile\controllers;

use Yii;
use app\modules\users\models\User;
use app\modules\users\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\base\ErrorException;
use app\modules\users\models\PasswordChangeForm;

/**
 * Main controller for the `profile` module
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
        $id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);

        $baseoption = $model->base;
        $baselist = new ArrayDataProvider([
            'allModels' => $baseoption,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $baselist,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionChangepwd($id)
    {
        $user = $this->findModel($id);
        $model = new PasswordChangeForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            Yii::$app->user->logout();
            return $this->goHome();
        } else {
            return $this->render('changepwd', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
