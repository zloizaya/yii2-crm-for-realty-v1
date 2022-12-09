<?php

namespace app\modules\deals;

use Yii;
use yii\filters\AccessControl;

/**
 * deals module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\deals\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii2mod\rbac\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin' , 'manager', 'agent']
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
