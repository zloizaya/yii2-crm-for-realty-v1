<?php

namespace app\modules\clients\models;

use Yii;

/**
 * This is the model class for table "{{%clients}}".
 *
 * @property int $id
 * @property string|null $surname
 * @property string|null $name
 * @property string|null $middle_name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $p_serial
 * @property string|null $p_number
 * @property string|null $p_date_take
 * @property string|null $p_who_take
 * @property string|null $p_code
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%clients}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['p_date_take'], 'safe'],
            [['surname', 'name', 'middle_name', 'phone', 'email', 'p_serial', 'p_number', 'p_who_take', 'p_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'middle_name' => 'Отчество',
            'phone' => 'Телефон',
            'email' => 'Email',
            'p_serial' => 'Паспорт серия',
            'p_number' => 'Паспорт номер',
            'p_date_take' => 'Дата выдачи',
            'p_who_take' => 'Кем выдан',
            'p_code' => 'Код подразделения',
        ];
    }

    public function getAll()
    {
        return Clients::find()->all();
    }

    public function getFullName()
    {
        return $this->surname . ' ' . $this->name . ' ' . $this->middle_name;
    }

    public function getBase()
    {
        return $this->hasMany(Base::class, ['client' => 'id']);
    }
}
