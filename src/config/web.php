<?php

$config = [
    'id' => 'web-app',
    'basePath' => dirname(__DIR__),
    'language' => $_COOKIE['beamore-language'] ?? 'ru-RU',
    'timeZone' => 'Europe/Moscow',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'frontend' => [
            'class' => app\modules\frontend\Module::class,
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'UCFC1Ja961LaP0N2s90Qt1M5zQrRcqOL1d',
        ],
        'cache' => [
            'class' => yii\caching\FileCache::class,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/|welcome' => 'frontend/site/welcome',
                '<controller>' => 'frontend/<controller>/index',
                '<controller>/<action>' => 'frontend/<controller>/<action>',
            ],
        ],
        'user' => [
            'enableAutoLogin' => false,
        ],
        'db' => (require __DIR__ . '/db.php'),

    ],
    'params' => []
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
