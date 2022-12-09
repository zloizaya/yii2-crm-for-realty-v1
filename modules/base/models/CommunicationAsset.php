<?php

namespace app\modules\base\models;

use Yii;

/**
 * This is the model class for table "{{%communication_asset}}".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $cid
 * @property int|null $oid
 */
class CommunicationAsset extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%communication_asset}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['cid', 'oid'], 'integer'],
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
            'cid' => Yii::t('app.base', 'Cid'),
            'oid' => Yii::t('app.base', 'Oid'),
        ];
    }
}
