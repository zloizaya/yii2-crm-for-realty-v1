<?php

namespace app\modules\deals\controllers;

use Yii;
use app\modules\deals\models\Deals;
use app\modules\deals\models\DealsSearch;
use app\modules\deals\models\TransactionParticipant;
use app\modules\deals\models\Documents;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\data\ArrayDataProvider;

/**
 * DealsController implements the CRUD actions for Deals model.
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
     * Lists all Deals models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Deals();
        $searchModel = new DealsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Deals model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if (isset($_POST['hasEditable'])) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $oldStatus = $model->status;
            $oldType = $model->type_deal;
            $oldPrice = $model->price;
            $oldPriceOwner = $model->price_owner;
            $oldCommission = $model->commission;
            $oldLegSup = $model->leg_sup;

            if (!empty($_POST['status'])){
                $status = (int) trim($_POST['status']);
                $model->status = $status;
                $value = $model->status;
                $oldValue = $oldStatus;
            } elseif(!empty($_POST['type_deal'])){
                $type = (int) trim($_POST['type_deal']);
                $model->type_deal = $type;
                $value = $model->type_deal;
                $oldValue = $oldType;
            } elseif(!empty($_POST['price'])){
                $price = (int) trim($_POST['price']);
                $model->price = $price;
                $value = $model->price;
                $oldValue = $oldPrice;
            } elseif(!empty($_POST['price_owner'])){
                $price_owner = (int) trim($_POST['price_owner']);
                $model->price_owner = $price_owner;
                $value = $model->price_owner;
                $oldValue = $oldPriceOwner;
            } elseif(!empty($_POST['commission'])){
                $commission = (int) trim($_POST['commission']);
                $model->commission = $commission;
                $value = $model->commission;
                $oldValue = $oldCommission;
            } elseif(!empty($_POST['leg_sup'])){
                $legSup = (int) trim($_POST['leg_sup']);
                $model->leg_sup = $legSup;
                $value = $model->leg_sup;
                $oldValue = $oldLegSup;
            }

            if ($model->save()) {
                return ['output' => $value, 'message' => ''];
            } else {
                return ['output' => $oldValue, 'message' => 'Incorrect Value! Please reenter.'];
            }
        }
        $items = Documents::find()->where(['did' => $id])->all();
        $itemlist = new ArrayDataProvider([
            'allModels' => $items,
        ]);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $itemlist,
        ]);
    }

    /**
     * Creates a new Deals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Deals();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->status = $model::STATUS_NEW;
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

    public function actionAddmember($id)
    {
        $model = new TransactionParticipant();
        $dealId = (int)$id;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->did = $dealId;
            $model->save();
            return $this->redirect(['view', 'id' => $dealId]);
        }

        return $this->redirect(['view', 'id' => $dealId]);

    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionNewdoc($id)
    {
        Yii::setAlias('@documents', '@web/documents');
        $deals = new Deals();
        $dealId = (int)$id;
        if (!file_exists(Yii::getAlias('@webroot/documents/' . $dealId))){
            FileHelper::createDirectory(Yii::getAlias( '@webroot' ) . '/documents/' . $dealId, 0775, true);
        }
        $basePath = Yii::getAlias( '@webroot' ) . '/documents/' . $dealId;
        $docs = array();

        if ($this->request->isPost) {
            if ($deals->load($this->request->post())) {
                $docs = UploadedFile::getInstances($deals, 'docs');
                if (!is_null($docs)) {
                    foreach ($docs as $file) {
                        $model = new Documents();
                        $model->did = $dealId;
                        $model->name = $file->name;
                        $model->alias = Yii::$app->security->generateRandomString(12);
                        $model->link = Yii::getAlias( '@documents' ) . '/' . $dealId . '/' . $file->name;
                        $model->owner = Yii::$app->user->identity->id;
                        $file->saveAs($basePath . '/' . $file->name);
                        $model->save(false);
                    }
                }
                return $this->redirect(['view', 'id' => $dealId]);
            }
        }
        return $this->redirect(['view', 'id' => $dealId]);
    }

    public function actionDownload($document)
    {
        $alias = trim($document);
        $model = Documents::find()->where(['alias' => $alias])->one();
        $downloadLink = Yii::getAlias('@webroot') . $model->link;

        return Yii::$app->response->sendFile($downloadLink, $model->name);
    }

    public function actionDeletedoc($document)
    {
        $alias = trim($document);
        $model = Documents::find()->where(['alias' => $alias])->one();
        $id = $model->id;
        $did = $model->did;
        unlink(Yii::getAlias('@webroot') . $model->link);
        $model->delete($id);
        return $this->redirect(['view', 'id' => $did]);
    }

    /**
     * Finds the Deals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Deals the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Deals::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
