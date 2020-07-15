<?php

namespace app\modules\frontend;

class Module extends \yii\base\Module
{

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\frontend\controllers';
    public $defaultRoute = 'home/index';
    public $layout = 'main';

}
