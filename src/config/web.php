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
            'cookieValidationKey' => '90a5e3620018765f8250643dc2a834c8f',
        ],
        'cache' => [
            'class' => yii\caching\FileCache::class,
        ],
        'errorHandler' => [
            'errorAction' => 'frontend/site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'frontend/site/welcome',
                'demo.php' => 'frontend/site/welcome',
                'generator.php' => 'frontend/site/get-file-link',
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
