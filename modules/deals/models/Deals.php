<?php

namespace app\modules\deals\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use app\modules\base\models\Base;
use app\modules\clients\models\Clients;
use app\modules\users\models\User;
use app\modules\deals\models\TransactionParticipant;
use floor12\files\models\File;

/**
 * This is the model class for table "{{%deals}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $closed_at
 * @property int|null $buyer
 * @property int|null $seller
 * @property int|null $agent
 * @property string|null $price
 * @property string|null $commission
 * @property int|null $comments
 * @property int|null $status
 * @property int|null $object
 * @property int $task
 */
class Deals extends \yii\db\ActiveRecord
{
    public $docs;
    public $id_deal;
    public $did;
    public $bid;
    public $sid;
    public $cid;
    public $aid;
    public $field;
    public $oaid;

    const STATUS_NEW = 1;
    const STATUS_DOC = 2;
    const STATUS_REG = 3;
    const STATUS_OK = 4;
    const STATUS_NO = 5;
    const STATUS_WAIT = 6;

    const TYPE_SALE = 1;
    const TYPE_ESCORT = 2;

    const NAME_AGENT = 1;
    const NAME_BUYER = 2;
    const NAME_SELLER = 3;
    const NAME_OAID = 4;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%deals}}';
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
                'value' => date('Y-m-d H:i:s'),
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
            [['created_at', 'updated_at', 'closed_at'], 'safe'],
            [['type_deal', 'responsible', 'buyer', 'seller', 'status', 'object', 'task'], 'integer'],
            //[['task'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'type_deal' => Yii::t('app.deals', 'Type Deal'),
            'created_at' => 'Создана',
            'updated_at' => 'Обновлена',
            'closed_at' => 'Закрыта',
            'responsible' => Yii::t('app.deals', 'Responsible'),
            'buyer' => 'Покупатель',
            'seller' => 'Продавец',
            'agent' => 'Агент',
            'price' => 'Сумма сделки',
            'commission' => 'Комиссия',
            'comments' => 'Комментарии',
            'status' => 'Статус',
            'object' => 'Объект',
            'task' => 'Задачи',
        ];
    }

    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_NEW => 'Новая',
            self::STATUS_DOC => 'Готовим документы',
            self::STATUS_REG => 'На регистрации',
            self::STATUS_OK => 'Успешно',
            self::STATUS_NO => 'Провалено',
            self::STATUS_WAIT => 'Приостановлена',
        ];
    }

    public function getMembersName()
    {
        return ArrayHelper::getValue(self::getMembersArray(), $this->name);
    }

    public function getMembersArray()
    {
        return [
            self::NAME_AGENT => Yii::t('app.deals', 'Agent'),
            self::NAME_BUYER => Yii::t('app.deals', 'Buyer'),
            self::NAME_SELLER => Yii::t('app.deals', 'Seller'),
            self::NAME_OAID => Yii::t('app.deals', 'Outside members'),
        ];
    }

    public function getTypeName()
    {
        return ArrayHelper::getValue(self::getTypeArray(), $this->type_deal);
    }

    public function getTypeArray()
    {
        return [
            self::TYPE_SALE => Yii::t('app.deals', 'Type sale'),
            self::TYPE_ESCORT => Yii::t('app.deals', 'Type escort'),
        ];
    }

    public function getObjects()
    {
        return $this->hasOne(Base::class, ['id' => 'object']);
    }

    public function getResp()
    {
        return $this->hasOne(User::class, ['id' => 'responsible']);
    }

    public function getSell()
    {
        return $this->hasOne(Clients::class, ['id' => 'seller']);
    }

    public function getBuy()
    {
        return $this->hasOne(Clients::class, ['id' => 'buyer']);
    }

    public function getDoc()
    {
        return $this->hasMany(Documents::class, ['did' => 'id']);
    }

    public function getMembers()
    {
        return $this->hasMany(TransactionParticipant::class, ['did' => 'id']);
    }

    public function beforeSave($insert)
    {
        $object = Base::findOne($this->object);
        $this->seller = $object->owner->id;
        $this->responsible = $object->seller->id;
        return parent::beforeSave($insert);
    }

    public function getAgents()
    {
        $model = new User();

        return $model->find()->asArray()->where(['status' => User::STATUS_ACTIVE])->all();
    }
}
