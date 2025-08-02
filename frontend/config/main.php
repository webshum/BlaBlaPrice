<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'assetManager' => [
            'bundles' => [
                \yii\web\JqueryAsset::class => [
                    'sourcePath' => null,
                    'js' => ["/{$_ENV['APP_THEME']}/js/jquery.js"],
                ],
                \yii\web\YiiAsset::class => [
                    'sourcePath' => null,
                    'js' => ["/{$_ENV['APP_THEME']}/js/yii.js"],
                ],
                \yii\validators\ValidationAsset::class => [
                    'sourcePath' => null,
                    'js' => ["/{$_ENV['APP_THEME']}/js/yii.validation.js"],
                ],
                \yii\widgets\ActiveFormAsset::class => [
                    'sourcePath' => null,
                    'js' => ["/{$_ENV['APP_THEME']}/js/yii.activeForm.js"],
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
            'cookieValidationKey' => 'hS2d9Jk3lN8mPqRtYzWxCvBnMfGhJkLp',
        ],
        'user' => [
            'loginUrl' => ["site/login"],
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-frontend',
                'httpOnly' => true
            ],
        ],
        'session' => [
            'class' => yii\web\Session::class,
            'cookieParams' => [
                'path' => '/',
                'httponly' => true,
                'secure' => false,
                'samesite' => 'Lax',
            ],
            'timeout' => 86400,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'logFile' => '@runtime/logs/app.log',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
            ],
        ],
        'view' => [
            'theme' => [
                'basePath' => '@appTheme',
                'baseUrl' => '@appTheme',
                'pathMap' => [
                    '@app/views' => '@appTheme',
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    /* Debug */
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['46.211.72.103', '::1'],
    ];

    /* GII */
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['46.211.72.103', '::1'],
    ];
}

return $config;
