<?php

class UrlRecrawlController extends Controller
{
    public function actionIndex($url, $urlType, $siteId)
    {
        $this->renderPartial("__siteRecrawlDialog", array(
            'url' => $url,
            'urlType' => $urlType,
            'siteId' => $siteId,
        ));
    }

    public function actionRecrawl()
    {
        $command = new UrlRecrawl();
        $command->recrawl();
        Yii::app()->request->redirect($_SERVER['HTTP_REFERER']);
    }
}