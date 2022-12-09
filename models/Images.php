<?php

namespace app\models;

use Yii;
use app\modules\residential\models\Residential;
use app\modules\base\models\Base;

/**
 * This is the model class for table "{{%images}}".
 *
 * @property int $id
 * @property int|null $uid
 * @property string|null $name
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%images}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid'], 'integer'],
            [['name', 'thmb'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'name' => 'Name',
            'thmb' => 'Thmb',
        ];
    }

    public function getResidential()
    {
        return $this->hasOne(Residential::class, ['id' => 'uid']);
    }

    public function getBase()
    {
        return $this->hasOne(Base::class, ['id' => 'uid']);
    }
}
