<?php

namespace app\modules\base\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%communication}}".
 *
 * @property int $id
 * @property string|null $name
 */
class Communication extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%communication}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Поле обязательно для заполнения'],
            [['name'], 'trim'],
            [['name'], 'unique', 'message' => 'Поле уже существует'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
}
