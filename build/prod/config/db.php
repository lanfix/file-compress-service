<?php

use yii\db\Connection;

return [
    'class' => Connection::class,
    /** Тут host=percona - это контейнер с percona */
    'dsn' => 'mysql:host=percona;dbname=project;',
    'username' => 'root',
    'password' => '6a7da8638a4d17326de1405a62ea',
    'charset' => 'utf8mb4'
];
