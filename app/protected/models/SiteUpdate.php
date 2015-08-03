<?php

class SiteUpdate extends AccountTypesLimitsSite
{
    public $opLog;
    public $operation;

    function __construct($opLog  = 'SITE_UPDATE', $operation = 'Update')
    {
        $this->opLog = $opLog;
        $this->operation = $operation;
    }


    public function updateSiteInfo($criterions = null, $updateType = 1)
    {
        if (!$this->validateSite()) {
            return false;
        }
        $userId = Yii::app()->user->id;
        if (is_null(Yii::app()->getRequest()->getPost('siteId'))) {
            $id = $this->getId();
        } else {
            $id = Yii::app()->getRequest()->getPost('siteId');
        }
        $rcArray = array();
        $rcArray[] = Yii::app()->getRequest()->getPost('recrawlDate');

        if (is_array($rcArray[0])) {
            if (($rcArray[0]['date'] == '') && ($rcArray[0]['time'] == '')) {
                $recrawlDate = null;
            } elseif (($rcArray[0]['date'] != '') && ($rcArray[0]['time'] != '')) {
                $recrawlDate = $rcArray[0]['date'] . ' ' . $rcArray[0]['time'];
                $recrawlDate = '"' . date('Y-m-d H:i:s', strtotime($recrawlDate)) . '"';
            } elseif (($rcArray[0]['date'] == '') || ($rcArray[0]['time'] == '')) {
                Yii::app()->user->setFlash('notification', 'Please, specify both date and time for "Recrawl date" !');
                return false;
            }
        } else {
            $recrawlDate = $rcArray[0];
        }

        if ($updateType == 1) {
            $urlsArr = $this->getUrlsArray();
            $propsArr = $this->getPropsArray();
            $filtersArr = $this->getFiltersArray($urlsArr);
        } elseif ($updateType == 0) {
            $urlsArr = array();
            $propsArr = null;
            $filtersArr = null;
        }
        $json = array(
            "cDate" => null,
            "description" => Yii::app()->getRequest()->getPost('description'),
            "errorMask" => null,
            "errors" => null,
            "filters" => $filtersArr,
            "httpTimeout" => Yii::app()->getRequest()->getPost('httpTimeout'),
            "id" => $id,
            "iterations" => null,
            "maxErrors" => Yii::app()->getRequest()->getPost('maxErrors'),
            "maxResourceSize" => Yii::app()->getRequest()->getPost('maxResourceSize'),
            "maxResources" => Yii::app()->getRequest()->getPost('maxResources'),
            "maxURLs" => Yii::app()->getRequest()->getPost('maxURLs'),
            "priority" => Yii::app()->getRequest()->getPost('priority'),
            "properties" => $propsArr,
            "requestDelay" => Yii::app()->getRequest()->getPost('requestDelay'),
            "resources" => null,
            "state" => Yii::app()->getRequest()->getPost('state'),
            "tcDate" => '',
            "tcDateProcess" => '',
            "uDate" => 'NOW()',
            "updateType" => $updateType,
            "urlType" => Yii::app()->getRequest()->getPost('urlType'),
            "urls" => $urlsArr,
            "contents" => null,
            "processingDelay" => Yii::app()->getRequest()->getPost('processingDelay'),
            "size" => null,
            "avgSpeed" => null,
            "avgSpeedCounter" => null,
            "maxURLsFromPage" => Yii::app()->getRequest()->getPost('maxURLsFromPage'),
            "userId" => $userId,
            "recrawlPeriod" => Yii::app()->getRequest()->getPost('recrawlPeriod'),
            "recrawlDate" => $recrawlDate,
            "collectedURLs" => null,
            "fetchType" => Yii::app()->getRequest()->getPost('fetchType'),
            "criterions" => $criterions
        );
        Logger::log("Opertion ->" . $this->opLog, false);
        foreach ($json as $key => $value) {
            if ($value === "") {
                $value = null;
                $json[$key] = $value;
            }
        }
        $json = CJSON::encode($json);
        Logger::log("Request ->\n" . $json, false);
        $reqFile = tempnam(Yii::app()->getBasePath() . '/json_temp', '');
        $request = fopen($reqFile, "w");
        fwrite($request, $json);
        fclose($request);
        $response = $this->commandUpdate($reqFile);
        unlink($reqFile);
        $UsersSitesRights = new UsersSitesRights();
        $UsersSitesRights->setRightsSingleRecord(
            array(
                'userId' => $userId,
                'siteId' => $id
            ),
            true
        );

        return $response;
    }

    public function getId()
    {
        $id = Yii::app()->getRequest()->getPost('id');
        if ($id != null) {
            return $id;
        }
        $urls = $this->getUrlsArray();
        $id = md5(Yii::app()->user->id . '-' . $urls[0]);
        $_POST["siteId"] = $id;
        return $id;
    }

    public function getUrlsArray()
    {
        $urlsArray = null;
        $rootUrls = Yii::app()->getRequest()->getPost('rootUrls');
        $rootUrls = str_replace("\r", '', $rootUrls);
        $rootUrls = explode("\n", $rootUrls);
        foreach ($rootUrls as $item) {
            if ($item != '')
                $urlsArray[] = $item;
        }
        // $rootUrls = array_diff($rootUrls, array("\r", ''));
        return $urlsArray;
    }

    public function getFiltersArray()
    {
        $state = Yii::app()->getRequest()->getPost('fstate');
        $action = Yii::app()->getRequest()->getPost('faction');
        $stage = Yii::app()->getRequest()->getPost('fstage');
        $opCode = Yii::app()->getRequest()->getPost('fopCode');
        $subject = Yii::app()->getRequest()->getPost('fsubject');
        $groupId = Yii::app()->getRequest()->getPost('fgroupId');
        $type = Yii::app()->getRequest()->getPost('ftype');
        $mode = Yii::app()->getRequest()->getPost('fmode');
        $pattern = Yii::app()->getRequest()->getPost('fpattern');
        $siteId = Yii::app()->getRequest()->getPost('id');
        $filters = array();
        for ($i = 0; $i < count($state); $i++) {
            $filters[] = array(
                'state' => $state[$i],
                'action' => $action[$i],
                'stage' => $stage[$i],
                'opCode' => $opCode[$i],
                'subject' => $subject[$i],
                'groupId' => $groupId[$i],
                'mode' => $mode[$i],
                'pattern' => $pattern[$i],
                'siteId' => $siteId,
                'uDate' => 'NOW()'
            );
        }
        return $filters;
    }

    public function getPropsArray()
    {
        $props = array();
        $propsn = array();
        $propsv = array();
        foreach ($_POST as $k => $v) {
            if (preg_match("/^n_/", (string)$k))
                $propsn[] = $v;
            if (preg_match("/^v_/", (string)$k))
                $propsv[] = $v;
        }
        foreach ($propsn as $i => $name) {
            $props[] = array(
                "siteId" => $_POST["siteId"],
                "name" => $name,
                "uDate" => "NOW()",
                "value" => $propsv[$i]
            );
        }
//        $props = array_combine($propsn, $propsv);
        return $props;
    }

    public function commandUpdate($reqFile)
    {
        $api = Yii::app()->params['api'];
        $path = Yii::app()->getBasePath() . '/shell/';
        $cmd = "sh " . $path . "rnd_site_update.sh $api $reqFile";
        $json = shell_exec($cmd);
        $error = Errors::isError($json);
        if ($error !== 0) {
            Yii::app()->user->setFlash('error2', $this->operation . ' WARNING: ' . $error);
            Logger::log("Response ->\n" . $json);
            return false;
        } else {
            Yii::app()->user->setFlash('success2', $this->operation . ': SUCCESS');
            Logger::log("Response ->\n" . $json);
            return true;
        }
    }

    public function getDescriptions()
    {
        $list = parse_ini_file(Yii::app()->basePath.'/config/descriptions.ini', true);
        return $this->setNl2br($list);
    }

    public function setNl2br ($in)
    {
        if (!is_array($in)) {
            return nl2br($in);
        }
        foreach ($in as $k=>$v) {
            if (is_array($v)) {
                $in[$k] = $this->setNl2br($v);
            } else {
                $in[$k] = nl2br($v);
            }
        }
        return $in;
    }
}