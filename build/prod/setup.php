<?php
/**
 * Скрипт сборки проекта
 */

function makeRightSlashes($path)
{
    return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
}

/**
 * Копирование конфигов из ./config в соответствующую
 * директорию в проекте. Одним словом - МИГРАЦИЯ_КОНФИГУРАЦИИ
 */
echo "\e[32m>>> \e[36mstart copying configuration files...\e[37m ";
$configureDir = makeRightSlashes(__DIR__ . '/config');
$copyTo = makeRightSlashes(__DIR__ . '/../../src/config');
if($openConfigureDir = opendir($configureDir)) {
    while(false !== ($file = readdir($openConfigureDir))) {
        if($file == "." || $file == "..") continue;
        $fullFilePath = $configureDir . DIRECTORY_SEPARATOR . $file;
        $finalFilePath = $copyTo . DIRECTORY_SEPARATOR . $file;
        @copy($fullFilePath, $finalFilePath);
    }
}
echo "\e[32mOK!\e[37m\n";

echo "\e[32m>>> \e[36mstart copying public files...\e[37m ";
$configureDir = makeRightSlashes(__DIR__ . '/public');
$copyTo = makeRightSlashes(__DIR__ . '/../../src/public');
if($openConfigureDir = opendir($configureDir)) {
    while(false !== ($file = readdir($openConfigureDir))) {
        if($file == "." || $file == "..") continue;
        $fullFilePath = $configureDir . DIRECTORY_SEPARATOR . $file;
        $finalFilePath = $copyTo . DIRECTORY_SEPARATOR . $file;
        @copy($fullFilePath, $finalFilePath);
    }
}
echo "\e[32mOK!\e[37m\n";

echo "\e[32m>>> \e[36mcreating directory for assets...\e[37m ";
@mkdir(makeRightSlashes(__DIR__ . '/../../src/public/assets'), 0775, true);
echo "\e[32mOK!\e[37m\n";

/**
 * Копирование файла .env
 */
echo "\e[32m>>> \e[36mcopying env file...\e[37m ";
copy(__DIR__ . '/.env.dist', __DIR__ . '/.env');
echo "\e[32mOK!\e[37m\n";