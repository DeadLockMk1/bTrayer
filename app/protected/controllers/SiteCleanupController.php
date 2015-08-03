<?php

class SiteCleanupController extends Controller
{
    public function actionIndex($siteId)
    {
        $this->renderPartial("__cleanupDialog", array(
            'id' => $siteId
        ));
    }

    public function actionCleanup($siteId)
    {
        $command = new SiteCleanup;
        $command->cleanupSiteInfo($siteId);
        unset($command);
        Yii::app()->request->redirect($_SERVER['HTTP_REFERER']);
    }
}