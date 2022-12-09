<?php

namespace app\modules\users;

use Yii;
use yii\filters\AccessControl;

/**
 * users module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\users\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii2mod\rbac\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin' , 'manager']
                    ]
                ]
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
