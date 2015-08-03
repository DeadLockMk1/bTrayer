<?php

class UrlUpdate extends AccountTypesLimitsSite
{
    protected $operation = 'Update';
    protected $opLog = 'URL_UPDATE';

    public function updateUrlInfo()
    {
        if (!$this->validateSite()) {
            return false;
        }
        $userId = Yii::app()->user->id;

        $json = $this->getJson();

        Logger::log("Opertion ->" . $this->opLog, false);
        foreach ($json[0] as $key => $value) {
            if ($value == '') {
                $value = null;
                $json[0][$key] = $value;
            }
        }
        $json = CJSON::encode($json);
        Logger::log("Request ->\n" . $json, true);
        $reqFile = tempnam(Yii::app()->getBasePath() . '/json_temp', '');
        $request = fopen($reqFile, "w");
        fwrite($request, $json);
        fclose($request);
        $response = $this->commandUpdate($reqFile);
        $error = Errors::isError($response);
        if ($error !== 0) {
            Yii::app()->user->setFlash('error1', $this->operation . ' ERROR: ' . $error);
        } else {
            Yii::app()->user->setFlash('success1', $this->operation . ': SUCCESS');
        }
        unlink($reqFile);
        $UsersSitesRights = new UsersSitesRights();
        $UsersSitesRights->setRightsSingleRecord(
            array(
                'userId' => $userId,
            ),
            true
        );

        return $response;
    }

    public function getJson()
    {
        $request = Yii::app()->getRequest();
        $json[] = array(
            'CDate' => null,
            'UDate' => 'NOW()',
            'batchId' => null,
            'charset' => $request->getPost('charset'),
            'contentMask' => null,
            'contentType' => $request->getPost('contentType'),
            'contentURLMd5' => null,
            'crawled' => null,
            'crawlingTime' => null,
            'depth' => null,
            'eTag' => null,
            'errorMask' => null,
            'freq' => null,
            'httpCode' => null,
            'httpMethod' => $request->getPost('httpMethod'),
            'httpTimeout' => $request->getPost('httpTimeout'),
            'lastModified' => null,
            'linksE' => null,
            'linksI' => null,
            'mRate' => null,
            'mRateCounter' => null,
            'maxURLsFromPage' => $request->getPost('maxURLsFromPage'),
            'pDate' => null,
            'parentMd5' => null,
            'priority' => $request->getPost('priority'),
            'processed' => null,
            'processingDelay' => $request->getPost('processingDelay'),
            'processingTime' => null,
            'rawContentMd5' => null,
            'requestDelay' => $request->getPost('requestDelay'),
            'siteId' => $request->getPost('siteId'),
            'siteSelect' => null,
            'size' => null,
            'state' => $request->getPost('state'),
            'status' => $request->getPost('status'),
            'tagsCount' => null,
            'tagsMask' => null,
            'tcDate' => null,
            'totalTime' => null,
            'type' => $request->getPost('type'),
            'url' => $request->getPost('url'),
            'urlMd5' => $request->getPost('urlMd5'),
            'urlUpdate' => 1,
        );
        return $json;
    }

    public function commandUpdate($reqFile)
    {
        $api = Yii::app()->params['api'];
        $path = Yii::app()->getBasePath() . '/shell/';
        $cmd = "sh " . $path . "url_update.sh $api $reqFile";
        $json = shell_exec($cmd);
        Logger::log("Response ->\n" . $json);
        return $json;
    }
}