<?php

use yii\caching\FileCache;
use yii\mutex\MysqlMutex;
use yii\queue\db\Queue;
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
        'queue' => [
            'class' => Queue::class,
            'db' => 'db', // Компонент подключения к БД или его конфиг
            'tableName' => '{{%queue}}', // Имя таблицы
            'channel' => 'default', // Выбранный для очереди канал
            'mutex' => MysqlMutex::class, // Мьютекс для синхронизации запросов
            'deleteReleased' => true //удаляем из базы успешные очереди
        ],
        'authManager' => [
            'class' => DbManager::class,
        ],
        'db' => (require __DIR__ . '/db.php'),
        'log' => (require __DIR__ . '/log.php'),
        'mailer' => (require __DIR__ . '/mailer.php'),

    ],
    'params' => (require __DIR__ . '/params.php')
];
