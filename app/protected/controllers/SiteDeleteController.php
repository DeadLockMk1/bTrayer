<?php

class SiteDeleteController extends Controller
{
    public function actionIndex($siteId, $state)
    {
        $this->renderPartial("__siteDeleteDialog", array(
            'id' => $siteId,
            'state' => $state
        ));
    }

    public function actionDelete($siteId, $state, $type = 1)
    {
        $disabledOk = true;
        if ($state !=2) {
            $disabledOk = $this->disableSite($siteId);
        }
        if ($disabledOk) {
            $this->deleteSite($siteId, $type);
        }
        Yii::app()->request->redirect($_SERVER['HTTP_REFERER']);
    }

    public function disableSite($siteId)
    {
        $_POST["id"] = $siteId;
        $_POST["state"] = 2;
        $commandUpdate = new SiteUpdate('SITE_UPDATE(disable site)', 'Disable site');
        return $commandUpdate->updateSiteInfo();
    }
    public function deleteSite($siteId, $type)
    {
        $commandDelete = new SiteDelete;
        $commandDelete->commandDelete($siteId, $type);
        unset($commandDelete);
    }
}