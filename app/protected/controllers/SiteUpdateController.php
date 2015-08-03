<?php

class SiteUpdateController extends Controller
{
    public function actionIndex()
    {
        $command = new SiteUpdate;
        $command->updateSiteInfo();
        Yii::app()->request->redirect($_SERVER['HTTP_REFERER']);
    }
}
