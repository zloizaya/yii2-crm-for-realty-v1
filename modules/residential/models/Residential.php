<?php

namespace app\modules\residential\models;

use Yii;
use floor12\files\models\File;
use app\modules\developers\models\Developers;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%residential}}".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $developer
 * @property string|null $land
 * @property string|null $city
 * @property string|null $distric
 * @property string|null $street
 * @property string|null $home
 * @property string|null $law
 * @property string|null $floors
 * @property string|null $squares
 * @property string|null $type_buildings
 * @property string|null $stage
 * @property string|null $deadline
 * @property string|null $comfort
 * @property string|null $description
 */
class Residential extends \yii\db\ActiveRecord
{
    const FZ_214 = 0;
    const FZ_215 = 1;

    public $files;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%residential}}';
    }

    public function behaviors()
    {
        return [
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
            [['developer'], 'integer'],
            [['description'], 'string'],
            [['title', 'land', 'city', 'distric', 'street', 'home', 'law', 'floors', 'squares', 'type_buildings', 'stage', 'deadline', 'comfort'], 'string', 'max' => 255],
            ['resid', 'file', 'extensions' => ['jpg', 'png', 'jpeg', 'gif'], 'maxFiles' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'developer' => 'Developer',
            'land' => 'Land',
            'city' => 'City',
            'distric' => 'Distric',
            'street' => 'Street',
            'home' => 'Home',
            'law' => 'Law',
            'floors' => 'Floors',
            'squares' => 'Squares',
            'type_buildings' => 'Type Buildings',
            'stage' => 'Stage',
            'deadline' => 'Deadline',
            'comfort' => 'Comfort',
            'description' => 'Description',
            'images' => 'Изображения',
        ];
    }

    public function getFzName()
    {
        return ArrayHelper::getValue(self::getFzArray(), $this->law);
    }

    public static function getFzArray()
    {
        return [
            self::FZ_214 => 'ФЗ-214',
            self::FZ_215 => 'ФЗ-215',
        ];
    }

    public function getImages()
    {
        return $this->hasMany(File::class, ['object_id' => 'id'])->where(['field' => 'resid'])->orderBy(['ordering' => SORT_ASC]);
    }

    public function getImage()
    {
        return $this->hasOne(File::class, ['object_id' => 'id'])->where(['field' => 'resid'])->orderBy(['ordering' => SORT_ASC]);
    }

    public function getDevelopers()
    {
        return $this->hasOne(Developers::class, ['id' => 'developer']);
    }

    public function getObject()
    {
        return $this->hasMany(Base::class, ['id' => 'rid']);
    }
}
