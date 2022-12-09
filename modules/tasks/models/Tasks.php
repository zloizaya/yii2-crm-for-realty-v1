<?php

namespace app\modules\tasks\models;

use Yii;
use app\modules\users\models\User;
use app\modules\clients\models\Clients;
use app\modules\deals\models\Deals;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%tasks}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $closed_at
 * @property string|null $deadline
 * @property int|null $deal
 * @property int|null $client
 * @property int|null $executor
 * @property int|null $statement
 * @property int|null $comments
 * @property int|null $status
 */
class Tasks extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_WAIT = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_CLOSED = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tasks}}';
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['created_at', 'updated_at', 'closed_at', 'deadline'], 'safe'],
            [['deal', 'client', 'executor', 'statement', 'comments', 'status'], 'integer'],
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
            'description' => 'Описание',
            'created_at' => 'Дата постановки',
            'updated_at' => 'Изменена',
            'closed_at' => 'Закрыта',
            'deadline' => 'Крайний срок',
            'deal' => 'Сделка',
            'client' => 'Клиент',
            'executor' => 'Исполнитель',
            'statement' => 'Постановщик',
            'comments' => 'Комментарии',
            'status' => 'Статус',
        ];
    }

    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_NEW => '<span class="badge bg-primary">Новая</span>',
            self::STATUS_WAIT => '<span class="badge bg-warning">Отложена</span>',
            self::STATUS_ACTIVE => '<span class="badge bg-danger">В работе</span>',
            self::STATUS_CLOSED => '<span class="badge bg-success">Закрыта</span>',
        ];
    }

    public function getExecutor()
    {
        return $this->hasOne(User::class, ['id' => 'executor']);
    }

    public function getStatement()
    {
        return $this->hasOne(User::class, ['id' => 'statement']);
    }

    public function getClient()
    {
        return $this->hasOne(Clients::class, ['id' => 'client']);
    }

    public function getDeal()
    {
        return $this->hasOne(Deals::class, ['id' => 'deal']);
    }
}
