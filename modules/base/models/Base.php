<?php

namespace app\modules\base\models;

use Yii;
use app\modules\users\models\User;
use app\modules\clients\models\Clients;
use app\modules\base\models\Communication;
use app\modules\base\models\TypePlot;
use app\modules\base\models\TypeRepair;
use app\modules\base\models\TypeWall;
use app\modules\deals\models\Deals;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use floor12\files\models\File;


/**
 * This is the model class for table "{{%base}}".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 * @property int|null $agent
 * @property int|null $client
 * @property string|null $price_sale
 * @property string|null $price_owner
 * @property string|null $kadastr
 * @property int $export
 * @property int $typeAds
 * @property int $typeObj
 * @property int|null $rid
 * @property string|null $land
 * @property string|null $city
 * @property string|null $street
 * @property string|null $house
 * @property int|null $kv
 * @property string|null $title
 * @property string|null $totalSquare
 * @property string|null $liveSquare
 * @property string|null $kitchenSquare
 * @property int $rommCount
 * @property int|null $floor
 * @property int|null $floors
 * @property string|null $builded
 * @property int|null $wall
 * @property int|null $repair
 * @property int|null $balcon
 * @property int|null $bathroom
 * @property int|null $elevator
 * @property string|null $communication
 * @property string|null $description
 * @property string|null $acres
 * @property int|null $plot
 *
 * @property Asset[] $assets
 */
class Base extends \yii\db\ActiveRecord
{
    const TYPE_INSALE = 1;
    const TYPE_INDEAL = 2;
    const TYPE_DROP = 3;
    const TYPE_SOLD = 4;

    const ADS_SALE = 1;
    const ADS_RENT = 2;

    const STEP_FIRST = 0;
    const STEP_SECOND = 1;

    const TYPE_APPART = 1;
    const TYPE_HOUSE = 2;
    const TYPE_LAND = 3;
    const TYPE_COMMERS = 4;

    const BALCON_NO = 1;
    const BALCON_ONE = 2;
    const BALCON_TWO_MORE = 3;
    const BALCON_TYPE_LOGGIA = 4;

    const NO_ELEV = 1;
    const ONE_ELEV = 2;
    const TWO_ELEV = 3;

    const BATH_SEPARATE = 1;
    const BATH_COMBINED = 2;
    const BATH_MORE = 3;

    const KV_STUD = 1;
    const KV_1 = 2;
    const KV_2 = 3;
    const KV_3 = 4;
    const KV_MORE = 5;

    const PROPERTY_LIVE = 0;
    const PROPERTY_COMMERCICAL = 1;

    public $files;
    public $comments;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%base}}';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date('Y.m.d'),
            ],
            'files' => [
                'class' => 'floor12\files\components\FileBehaviour',
                'attributes' => [
                'files',
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['agent', 'client'], 'required'],
            [['status', 'agent', 'client', 'typeAds', 'kv', 'typeKv', 'rid', 'roomCount', 'floor', 'floors', 'wall', 'repair', 'balcon', 'elevator', 'bathroom', 'step', 'exp_ya', 'exp_avito', 'exp_domclick', 'exp_cian'], 'integer'],
            [['description'], 'string'],
            [['price_sale', 'price_owner', 'kadastr', 'land', 'city', 'street', 'house', 'totalSquare', 'liveSquare', 'kitchenSquare', 'builded'], 'string', 'max' => 255],
            ['base', 'file', 'extensions' => ['jpg', 'png', 'jpeg', 'gif'], 'maxFiles' => 10],
            [['communication'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.base', 'ID'),
            'created_at' => Yii::t('app.base', 'Created At'),
            'updated_at' => Yii::t('app.base', 'Updated At'),
            'status' => Yii::t('app.base', 'Status'),
            'agent' => Yii::t('app.base', 'Agent'),
            'client' => Yii::t('app.base', 'Client'),
            'price_sale' => Yii::t('app.base', 'Price Sale'),
            'price_owner' => Yii::t('app.base', 'Price Owner'),
            'kadastr' => Yii::t('app.base', 'Kadastr'),
            'typeAds' => Yii::t('app.base', 'Type Ads'),
            'typeObj' => Yii::t('app.base', 'Type Obj'),
            'rid' => Yii::t('app.base', 'Rid'),
            'land' => Yii::t('app.base', 'Land'),
            'city' => Yii::t('app.base', 'City'),
            'street' => Yii::t('app.base', 'Street'),
            'house' => Yii::t('app.base', 'House'),
            'kv' => Yii::t('app.base', 'Kv'),
            'title' => Yii::t('app.base', 'Title'),
            'totalSquare' => Yii::t('app.base', 'Total Square'),
            'liveSquare' => Yii::t('app.base', 'Live Square'),
            'kitchenSquare' => Yii::t('app.base', 'Kitchen Square'),
            'rommCount' => Yii::t('app.base', 'Romm Count'),
            'floor' => Yii::t('app.base', 'Floor'),
            'floors' => Yii::t('app.base', 'Floors'),
            'builded' => Yii::t('app.base', 'Builded'),
            'wall' => Yii::t('app.base', 'Wall'),
            'repair' => Yii::t('app.base', 'Repair'),
            'balcon' => Yii::t('app.base', 'Balcon'),
            'bathroom' => Yii::t('app.base', 'Bathroom'),
            'elevator' => Yii::t('app.base', 'Elevator'),
            'communication' => Yii::t('app.base', 'Communication'),
            'description' => Yii::t('app.base', 'Description'),
            'acres' => Yii::t('app.base', 'Acres'),
            'plot' => Yii::t('app.base', 'Plot'),
            'exp_ya' => Yii::t('app.base', 'Export to Yandex'),
            'exp_avito' => Yii::t('app.base', 'Export to Avito'),
            'exp_domclick' => Yii::t('app.base', 'Export to Domcklic'),
            'exp_cian' => Yii::t('app.base', 'Export to CIAN'),
            'Files' => Yii::t('app.base', 'Files'),
        ];
    }

    /**
     * Gets query for [[Assets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    public static function getStatusesArray()
    {
        return [
            self::TYPE_INSALE => 'В продаже',
            self::TYPE_INDEAL => 'В сделке',
            self::TYPE_DROP => 'Снят с продажи',
            self::TYPE_SOLD => 'Продан',
        ];
    }

    public function getAdsName()
    {
        return ArrayHelper::getValue(self::getAdsArray(), $this->ads);
    }

    public function getAdsArray()
    {
        return [
            self::ADS_SALE => 'Продажа',
            self::ADS_RENT => 'Аренда',
        ];
    }

    public function getStepName()
    {
        return ArrayHelper::getValue(self::getStepArray(), $this->step);
    }

    public function getStepArray()
    {
        return [
            self::STEP_FIRST => 'Новостройка',
            self::STEP_SECOND => 'Вторичное',
        ];
    }

    public function getTypeName()
    {
        return ArrayHelper::getValue(self::getAdsArray(), $this->type);
    }

    public function getTypeArray()
    {
        return [
            self::TYPE_APPART => 'Квартира',
            self::TYPE_HOUSE => 'Дом',
            self::TYPE_LAND => 'Земля',
            self::TYPE_COMMERS => 'Коммерция',
        ];
    }

    public function getPropertyName()
    {
        return ArrayHelper::getValue(self::getAdsArray(), $this->type);
    }

    public function getPropertyArray()
    {
        return [
            self::PROPERTY_LIVE => 'жилая',
            self::PROPERTY_COMMERCICAL => 'коммерческая',
        ];
    }

    public function getBalconName()
    {
        return ArrayHelper::getValue(self::getBalconArray(), $this->balcon);
    }

    public static function getBalconArray()
    {
        return [
            self::BALCON_NO => 'Нет балкона',
            self::BALCON_ONE => 'Один балкон',
            self::BALCON_TWO_MORE => 'Два и более',
            self::BALCON_TYPE_LOGGIA => 'Лоджия',
        ];
    }

    public function getElevatorName()
    {
        return ArrayHelper::getValue(self::getElevatorArray(), $this->elevator);
    }

    public static function getElevatorArray()
    {
        return [
            self::NO_ELEV => 'Нет лифта',
            self::ONE_ELEV => 'Один лифт',
            self::TWO_ELEV => 'Два и более',
        ];
    }

    public function getBathroomName()
    {
        return ArrayHelper::getValue(self::getBathroomArray(), $this->bathroom);
    }

    public static function getBathroomArray()
    {
        return [
            self::BATH_SEPARATE => 'Раздельный',
            self::BATH_COMBINED => 'Совмещенный',
            self::BATH_MORE => 'Два и более',
        ];
    }

    public function getKvName()
    {
        return ArrayHelper::getValue(self::getKvArray(), $this->kv);
    }

    public function getKvArray()
    {
        return [
            self::KV_STUD => 'Студия',
            self::KV_1 => '1-к квартира',
            self::KV_2 => '2-к квартира',
            self::KV_3 => '3-к квартира',
            self::KV_MORE => '4-к и более',
        ];
    }

    public function getSeller()
    {
        return $this->hasOne(User::class, ['id' => 'agent']);
    }

    public function getAgents()
    {
        $model = new User();

        return $model->find()->asArray()->where(['status' => User::STATUS_ACTIVE])->all();
    }

    public function getOwner()
    {
        return $this->hasOne(Clients::class, ['id' => 'client']);
    }

    public function getClients()
    {
        $model = new Clients();

        return $model->find()->asArray()->all();
    }

    public function getComm()
    {
        $model = new Communication();

        return $model->find()->asArray()->all();
    }

    public function getTypePlot()
    {
        $model = new TypePlot();

        return $model->find()->asArray()->all();
    }

    public function getTypeRepair()
    {
        $model = new TypeRepair();

        return $model->find()->asArray()->all();
    }

    public function getRepairType()
    {
        return $this->hasOne(TypeRepair::class, ['id' => 'repair']);
    }

    public function getTypeWall()
    {
        $model = new TypeWall();

        return $model->find()->asArray()->all();
    }

    public function getWallType()
    {
        return $this->hasOne(TypeWall::class, ['id' => 'wall']);
    }

    public function getImages()
    {
        return $this->hasMany(File::class, ['object_id' => 'id'])->where(['field' => 'base'])->orderBy(['ordering' => SORT_ASC]);
    }

    public function getImage()
    {
        return $this->hasOne(File::class, ['object_id' => 'id'])->where(['ordering' => 0])->andWhere(['field' => 'base']);
    }

    public function getFullAddress()
    {
        return $this->land . ' ' . $this->city . ', ' . $this->street . ', ' . $this->house . ', ' . $this->kv;
    }

    public function getDeals()
    {
        return $this->hasMany(Deals::class, ['object' => 'id']);
    }

    public function getAllObjects()
    {
        $model = new Base();
        return $model->find()->where(['status' => Base::TYPE_INSALE])->all();
    }

    public function beforeSave($insert)
    {
        $this->communication = json_encode($this->communication, JSON_UNESCAPED_SLASHES);
        return parent::beforeSave($insert);
    }
    public function afterFind()
    {
        parent::afterFind();
        $this->communication = str_replace('&quot;', '"', $this->communication);
        $this->communication = json_decode($this->communication);
    }
}
