<?php

use yii\caching\FileCache;
use yii\rbac\DbManager;

return [
    'id' => 'console-app',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'timeZone' => 'Europe/Moscow',
    'components' => [
        'cache' => [
            'class' => FileCache::class,
        ],
        'authManager' => [
            'class' => DbManager::class,
        ],
        'db' => (require __DIR__ . '/db.php'),
    ],
    'params' => [],
];
