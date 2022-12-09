<?php

namespace app\modules\export\models;

use Yii;
use DOMDocument;
use yii\behaviors\TimestampBehavior;
use yii\web\Response;
use app\modules\base\models\Base;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%export}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $link
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $status
 */
class Export extends \yii\db\ActiveRecord
{
    const AVITO_TRUE = 1;
    const AVITO_FALSE = 0;
    const YANDEX_TRUE = 1;
    const YANDEX_FALSE = 0;
    const DOMCLICK_TRUE = 1;
    const DOMCLICK_FALSE = 0;
    const CIAN_TRUE = 1;
    const CIAN_FALSE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%export}}';
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
                'value' => date('d.m.Y'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['name', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.export', 'ID'),
            'name' => Yii::t('app.export', 'Name'),
            'link' => Yii::t('app.export', 'Link'),
            'created_at' => Yii::t('app.export', 'Created At'),
            'updated_at' => Yii::t('app.export', 'Updated At'),
            'status' => Yii::t('app.export', 'Status'),
        ];
    }

    public function getExportName()
    {
        return ArrayHelper::getValue(self::getExportArray(), $this->export);
    }

    public static function getExportArray()
    {
        return [
            self::AVITO_TRUE => Yii::t('app.export', 'Avito Export True'),
            self::YANDEX_TRUE => Yii::t('app.export', 'Yandex Export True'),
            self::AVITO_FALSE => Yii::t('app.export', 'Avito Export False'),
            self::YANDEX_FALSE => Yii::t('app.export', 'Yandex Export False'),
            self::DOMCLICK_TRUE => Yii::t('app.export', 'Domclick Export True'),
            self::DOMCLICK_FALSE => Yii::t('app.export', 'Domclick Export False'),
            self::CIAN_TRUE => Yii::t('app.export', 'Cian Export True'),
            self::CIAN_FALSE => Yii::t('app.export', 'Cian Export False'),
        ];
    }
}
