<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'ReBaseCRM v1.0',
    'language'=>'ru-RU',
    'timeZone' => 'Europe/Moscow',
    'name' => 'ReBaseCRM v1.0',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4et7ZqdB2BgndKQwxuhdvH8XxTYFvq2LfD466ynT',
            'enableCookieValidation' => false,
            'baseUrl'=> '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                ],
                'yii2mod.rbac' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/rbac/messages',
                ],
                'app.base' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                ],
                'app.export' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                ],
                'app.resident' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                ],
                'app.deals' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                ],
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/comments/messages',
                ],
            ],
        ],
        'formatter' => [
            'class' => 'maxdancepro\phoneFormatter\i18n\Formatter',
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'RUB',
            'numberFormatterSymbols' => [
                NumberFormatter::CURRENCY_SYMBOL => 'руб',
            ]
        ],
        'user' => [
            'identityClass' => 'app\modules\users\models\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => false,
            'transport' => [
                'scheme' => 'smtps',
                'host' => 'smtp.beget.com',
                'username' => 'admin@rebasecrm.ru',
                'password' => 'P@$$word12!',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'base/main',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
                '<_m:[\w\-]+>' => '<_m>/main/index',
                'export/yafeed.xml' => '/export/main/yafeed',
            ],
        ],
    ],
    'container' => [
        'definitions' => [
            'corpsepk\DaData\SuggestionsWidget' => [
                'token' => 'you token',
            ],
        ],
    ],
    'modules' => [
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
        'base' => [
            'class' => 'app\modules\base\Module',
        ],
        'developers' => [
            'class' => 'app\modules\developers\Module',
        ],
        'residential' => [
            'class' => 'app\modules\residential\Module',
        ],
        'clients' => [
            'class' => 'app\modules\clients\Module',
        ],
        'users' => [
            'class' => 'app\modules\users\Module',
        ],
        'profile' => [
            'class' => 'app\modules\profile\Module',
        ],
        'deals' => [
            'class' => 'app\modules\deals\Module',
        ],
        'tasks' => [
            'class' => 'app\modules\tasks\Module',
        ],
        'settings' => [
            'class' => 'app\modules\settings\Module',
        ],
        'files' => [
            'class' => 'floor12\files\Module',
            'storage' => '@webroot/images',
            'cache' => '@webroot/images_cache',
            'token_salt' => 'ksnu9uBJhbjUu',
        ],
        'export' => [
            'class' => 'app\modules\export\Model',
        ],
        'comment' => [
            'class' => 'yii2mod\comments\Module',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
        'gridviewKrajee' =>  [
            'class' => '\kartik\grid\Module',
            // your other grid module settings
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    unset($config['components']['cache']);
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}


return $config;
