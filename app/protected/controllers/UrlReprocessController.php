<?php

class UrlReprocessController extends Controller
{
    public function actionIndex($siteId, $urlMd5)
    {
        $this->renderPartial('__urlReprocessDialog', array(
                'siteId' => $siteId,
                'urlMd5' => $urlMd5,
            )
        );
    }

    public function actionReprocess()
    {
        $command = new UrlReprocess;
        $command->updateUrlInfo();
        Yii::app()->request->redirect($_SERVER['HTTP_REFERER']);
    }
}