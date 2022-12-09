<?php

namespace app\modules\developers\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use app\modules\residential\models\Residential;

/**
 * This is the model class for table "{{%developers}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $site
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $description
 * @property string|null $director
 * @property string|null $inn
 * @property string|null $kpp
 * @property string|null $ogrn
 * @property string|null $address
 */
class Developers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%developers}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => \nsept\behaviors\CyrillicSlugBehavior::className(),
                'attribute' => 'name',
                'ensureUnique' => true,
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
            [['name', 'slug', 'site', 'email', 'phone', 'director', 'inn', 'kpp', 'ogrn', 'address'], 'string', 'max' => 255],
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
            'slug' => 'Slug',
            'site' => 'Site',
            'email' => 'Email',
            'phone' => 'Phone',
            'description' => 'Description',
            'director' => 'Director',
            'inn' => 'Inn',
            'kpp' => 'Kpp',
            'ogrn' => 'Ogrn',
            'address' => 'Address',
        ];
    }

    public function getResidential()
    {
        return $this->hasMany(Residential::class, ['developer' => 'id']);
    }
}
