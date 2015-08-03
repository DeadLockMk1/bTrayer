<?php

class SiteRecrawlController extends Controller
{
    public function actionIndex($siteId, $iterations)
    {
        $this->renderPartial("__siteRecrawlDialog", array(
            'id' => $siteId,
            'iterations' => $iterations
        ));
    }

    public function actionRecrawl()
    {
        $command = new SiteRecrawl();
        $command->recrawl();
        Yii::app()->request->redirect($_SERVER['HTTP_REFERER']);
    }
}