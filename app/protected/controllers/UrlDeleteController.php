<?php

class UrlDeleteController extends Controller
{
    public function actionIndex($siteId, $urlMd5, $urlType=1)
    {
        $this->renderPartial('__urlDeleteDialog', array(
                'siteId' => $siteId,
                'urlMd5' => $urlMd5,
                'urlType' => 1,
            )
        );
    }

    public function actionDelete()
    {
        $command = new UrlDelete;
        $command->delete();
        Yii::app()->request->redirect($_SERVER['HTTP_REFERER']);
    }
}