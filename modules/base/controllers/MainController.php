<?php

namespace app\modules\base\controllers;

use Yii;
use app\modules\base\models\Base;
use app\modules\base\models\BaseSearch;
use app\modules\base\models\CommunicationAsset;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use floor12\files\models\File;

/**
 * BaseController implements the CRUD actions for Base model.
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
     * Lists all Base models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BaseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Base model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Base model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Base();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->title = $model->getKvArray()[$model->typeKv] . ', ' . $model->totalSquare . 'кв.м, ' . $model->city . ', ' . $model->street . ', ' . $model->house;
                    $model->status = Base::TYPE_INSALE;
                    $model->save();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Base model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->agent === Yii::$app->user->identity->id || Yii::$app->user->identity->role->name === 'manager' || Yii::$app->user->identity->role->name === 'admin'){
            if ($this->request->isPost && $model->load($this->request->post())) {
                $model->communication = json_encode($model->communication);
                if($model->save()){
                    Yii::$app->session->setFlash('success', "Объект обновлен");
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        if($model->agent === Yii::$app->user->identity->id || Yii::$app->user->identity->role->name === 'manager' || Yii::$app->user->identity->role->name === 'admin'){
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
        throw new NotFoundHttpException(Yii::t('app.base', 'This action is prohibited'));
    }

    public function actionDrop($id)
    {
        $model = Base::findOne($id);
        if($model->agent === Yii::$app->user->identity->id || Yii::$app->user->identity->role->name === 'manager' || Yii::$app->user->identity->role->name === 'admin'){
            if($model->status != Base::TYPE_DROP) {
                $model->status = Base::TYPE_DROP;
                $model->update(false);
                Yii::$app->session->setFlash('success', 'Объект снят с продажи');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        Yii::$app->session->setFlash('error', 'Ошибка обновления');
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionSale($id)
    {
        $model = Base::findOne($id);
        if($model->agent === Yii::$app->user->identity->id || Yii::$app->user->identity->role->name === 'manager' || Yii::$app->user->identity->role->name === 'admin'){
            if($model->status != Base::TYPE_INSALE) {
                $model->status = Base::TYPE_INSALE;
                $model->update(false);
                Yii::$app->session->setFlash('success', 'Объект выставлен на продажу');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        Yii::$app->session->setFlash('error', 'Ошибка обновления');
        return $this->redirect(['view', 'id' => $model->id]);
    }

    protected function findModel($id)
    {
        if (($model = Base::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
