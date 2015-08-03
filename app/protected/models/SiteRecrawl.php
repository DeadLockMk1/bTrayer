<?php

class SiteRecrawl
{
    protected $operation = 'Re-crawl';
    protected $opLog = 'SITE_RECRAWL (Based on SITE_UPDATE)';

    public function recrawl()
    {
        $siteId = Yii::app()->getRequest()->getPost('id');
        $iterations = Yii::app()->getRequest()->getPost('iterations');
        $cleanup = Yii::app()->getRequest()->getPost('cleanup');
        if (isset($cleanup)) {
            $command = new SiteCleanup;
            $command->cleanupSiteInfo($siteId);
            unset($command);
        }
        $json = array(
            "cDate" => null,
            "description" => null,
            "errorMask" => null,
            "errors" => null,
            "filters" => null,
            "httpTimeout" => null,
            "id" => $siteId,
            "iterations" => null,
            "maxErrors" => null,
            "maxResourceSize" => null,
            "maxResources" => null,
            "maxURLs" => null,
            "priority" => null,
            "properties" => null,
            "requestDelay" => null,
            "resources" => null,
            "state" => 1,
            "tcDate" => null,
            "uDate" => null,
            "updateType" => 0,
            "urlType" => null,
            "urls" => null,
            "contents" => null,
            "processingDelay" => null,
            "size" => null,
            "avgSpeed" => null,
            "avgSpeedCounter" => null,
            "maxURLsFromPage" => null,
            "criterions" => null,
            "userId" => null,
            "recrawlPeriod" => null,
            "recrawlDate" => 'NOW()',
            "collectedURLs" => null,
            "fetchType" => null
        );
        Logger::log("Operation ->" . $this->opLog, false);
        $json = CJSON::encode($json);
        Logger::log("Request ->\n" . $json, true);
        $reqFile = tempnam(Yii::app()->getBasePath() . '/json_temp', '');
        $request = fopen($reqFile, "w");
        fwrite($request, $json);
        fclose($request);
        $this->commandRecrawl($reqFile);
        unlink($reqFile);
        return true;
    }

    public function commandRecrawl($reqFile)
    {
        $api = Yii::app()->params['api'];
        $path = Yii::app()->getBasePath() . '/shell/';
        $cmd = "sh " . $path . "rnd_site_update.sh $api $reqFile";
        $json = shell_exec($cmd);
        $error = Errors::isError($json);
        if ($error !== 0) {
            Yii::app()->user->setFlash('error1', $this->operation . ' WARNING: ' . $error);
        } else {
            Yii::app()->user->setFlash('success1', $this->operation . ': SUCCESS');
        }
        Logger::log("Response ->\n" . $json);
        return true;
    }
}