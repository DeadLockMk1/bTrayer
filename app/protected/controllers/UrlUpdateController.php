<?php

class UrlUpdateController extends Controller
{
    public function actionIndex()
    {
        $command = new UrlUpdate;
        $command->updateUrlInfo();
        Yii::app()->request->redirect($_SERVER['HTTP_REFERER'] . '#edit');
    }
}