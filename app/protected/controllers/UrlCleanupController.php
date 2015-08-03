<?php

class UrlCleanupController extends Controller
{
    public function actionIndex($url, $urlType, $siteId)
    {
        $this->renderPartial("__cleanupDialog", array(
            'url' => $url,
            'urlType' => $urlType,
            'siteId' => $siteId,
        ));
    }

    public function actionCleanup()
    {
        $r = Yii::app()->request;
        $command = new UrlCleanup;
        $command->cleanupUrlInfo(
            $r->getParam('siteId'),
            $r->getParam('url'),
            $r->getParam('urlType'),
            $r->getParam('state'),
            $r->getParam('status')
        );
        unset($command);
        Yii::app()->request->redirect($_SERVER['HTTP_REFERER']);
    }
}