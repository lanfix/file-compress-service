<?php

namespace app\modules\frontend\controllers;

class SiteController extends BaseController
{

    public function actionWelcome()
    {
        $this->view->title = 'Welcome, friend!';
        return $this->render('welcome');
    }

}