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
        'https://cdn.jsdelivr.net/jquery.typeit/4.4.0/typeit.min.js',
        '/js/master.js',
    ];

    public $depends = [
        JqueryAsset::class
    ];

}