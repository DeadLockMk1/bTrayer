<?php

class ResourceDownloadController extends Controller
{
    public function actionIndex($siteId, $url, $urlMd5) {
        $this->renderPartial('__resourceDownload', array(
                'siteId' => $siteId,
                'url' => $url,
                'urlMd5' => $urlMd5,
            )
        );
    }

    public function actionDw()
    {

        $request = Yii::app()->request;
        $options = $request->getPost('options');
        $command = new ResourceDownload;
        $command->download($options);
    }
}
