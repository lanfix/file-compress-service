<?php

use yii\db\Connection;

return [
    'class' => Connection::class,
    /** Тут host=percona - это контейнер с percona */
    'dsn' => 'mysql:host=percona;dbname=project;',
    'username' => 'root',
    'password' => '888c779f6907bc3bee3bbdc11010',
    'charset' => 'utf8mb4'
];
