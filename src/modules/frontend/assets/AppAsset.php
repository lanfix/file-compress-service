<?php

namespace app\modules\frontend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        '/css/master.css',
    ];

    public $js = [
        '/js/master.js',
    ];

    public $depends = [
        JqueryAsset::class
    ];

}