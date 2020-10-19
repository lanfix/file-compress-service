<?php

require __DIR__ . '/../Builder.php';

/**
 * Копирование конфигов из ./config в соответствующую
 * директорию в проекте. Одним словом - МИГРАЦИЯ_КОНФИГУРАЦИИ
 */
Builder::copyFilesFromDirToDir(
    __DIR__ . '/config',
    __DIR__ . '/../../src/config',
    'start copying configuration files'
);

/**
 * Копирование публичных файлов
 */
Builder::copyFilesFromDirToDir(
    __DIR__ . '/public',
    __DIR__ . '/../../src/public',
    'start copying public files'
);

/**
 * Создание нужных директорий
 */
Builder::createDirectoryIfNotExists(__DIR__ . '/../../src/public/assets');
Builder::createDirectoryIfNotExists(__DIR__ . '/../../src/runtime');
Builder::createDirectoryIfNotExists(__DIR__ . '/../../src/public/gallery');
Builder::createDirectoryIfNotExists(__DIR__ . '/../../src/public/cache');

/**
 * Копирование файла .env
 */
Builder::copyFile(__DIR__ . '/.env.dist', __DIR__ . '/.env');