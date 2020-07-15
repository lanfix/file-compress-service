<?php

use yii\db\Connection;

return [
    'class' => Connection::class,
    /** Тут host=percona - это контейнер с percona */
    'dsn' => 'mysql:host=percona;dbname=project;',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8mb4'
];
