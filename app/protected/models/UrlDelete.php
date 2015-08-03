<?php

class UrlDelete extends UrlUpdate
{
    protected $operation = 'Delete';
    protected $opLog = 'URL_DELETE';

    public function delete()
    {
        $this->updateUrlInfo();
    }

    public function getJson()
    {
        $request = Yii::app()->getRequest();
        $json[] = array(
            'siteId' => $request->getPost('siteId'),
            'url' => $request->getPost('urlMd5'),
            'urlType' => 1,
            'criterions' => null,
        );
        return $json;
    }

    public function commandUpdate($reqFile)
    {
        $api = Yii::app()->params['api'];
        $path = Yii::app()->getBasePath() . '/shell/';
        $cmd = "sh " . $path . "url_delete.sh $api $reqFile";
        $json = shell_exec($cmd);
        Logger::log("Response ->\n" . $json);
        return $json;
    }
}