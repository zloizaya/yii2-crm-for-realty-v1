<?php

namespace app\modules\deals\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%documents}}".
 *
 * @property int $id
 * @property string $created_at
 * @property int $did
 * @property string $name
 * @property int $owner
 * @property string $link
 */
class Documents extends \yii\db\ActiveRecord
{
    public $docs;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%documents}}';
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
            [['created_at', 'did', 'name', 'owner', 'link'], 'required'],
            [['created_at'], 'safe'],
            [['did', 'owner'], 'integer'],
            [['name', 'link'], 'string', 'max' => 255],
            [['docs'], 'file', 'skipOnEmpty' => false, 'extensions' => ['pdf', 'xlsx', 'docx'], 'maxFiles' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.deals', 'ID'),
            'created_at' => Yii::t('app.deals', 'Created At'),
            'did' => Yii::t('app.deals', 'Did'),
            'name' => Yii::t('app.deals', 'Name'),
            'owner' => Yii::t('app.deals', 'Owner'),
            'link' => Yii::t('app.deals', 'Link'),
        ];
    }
}
