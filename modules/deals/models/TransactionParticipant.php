<?php

namespace app\modules\deals\models;

use Yii;
use app\modules\users\models\User;
use app\modules\clients\models\Clients;
/**
 * This is the model class for table "{{%transaction_participant}}".
 *
 * @property int $id
 * @property int|null $aid
 * @property string|null $member_name
 */
class TransactionParticipant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%transaction_participant}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['did'], 'integer'],
            [[ 'aid', ], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.deals', 'ID'),
            'aid' => Yii::t('app.deals', 'Aid'),
        ];
    }

    public function getInagents()
    {
        return $this->hasMany(User::class, ['id' => 'aid']);
    }

    public function getClients()
    {
        return $this->hasMany(Clients::class, ['cid' => 'id']);
    }

    public function getSellers()
    {
        return $this->hasMany(Clients::class, ['sid' => 'id']);
    }
}
