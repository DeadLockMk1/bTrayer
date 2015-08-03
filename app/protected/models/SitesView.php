<?php

class SitesView
{
    private $opLog = 'SITE_FIND';
    public $responseFile;
    public $requestFile;
    public $single;

    public function dccCheck($userId)
    {
        $this->createRequestSingle($userId, '0', true);
        $json = $this->commandStatus($userId);
//        Logger::log("Response -> \n" . $json, false);
        Errors::isError($json);
        return $json;
    }

    public function createRequestSingle($userId, $siteId, $init = false)
    {
        $json = array(
            "deleteTaskId" => null,
            "id" => $siteId
        );
        $json = CJSON::encode($json);
        $this->opLog = "SITE_STATUS";
        if (!$init) {
            Logger::log("Opertion ->" . $this->opLog, false);
            Logger::log("Request -> \n" . $json, true);
        }
        $path = Yii::app()->getBasePath() . '/json_temp';
        $reqFile = tempnam($path, '');
        $this->requestFile = $reqFile;
        $file = fopen($reqFile, 'w');
        fwrite($file, $json);
        return $reqFile;
    }

    public function commandFind($userId)
    {
        $api = Yii::app()->params['api'];
        $path = Yii::app()->getBasePath() . '/shell/';
        $pathJson = Yii::app()->getBasePath() . '/json_temp/';
        $cmd = "sh " . $path . "site_find_by_criterions.sh $api $this->requestFile";
        $json = shell_exec($cmd);
        $resFile = tempnam($pathJson, '');
        $this->responseFile = $resFile;
        $file = fopen($resFile, 'w');
        fwrite($file, $json);
        fclose($file);
        return $this->getResponse($userId);
    }

    public function commandStatus($userId)
    {
        $api = Yii::app()->params['api'];
        $path = Yii::app()->getBasePath() . '/shell/';
        $pathTemp = Yii::app()->getBasePath() . '/json_temp/';
        $cmd = "sh " . $path . "site_status.sh $api $this->requestFile";
        $json = shell_exec($cmd);
        $resFile = tempnam($pathTemp, '');
        $this->responseFile = $resFile;
        $file = fopen($resFile, 'w');
        fwrite($file, $json);
        fclose($file);
        return $this->getResponse($userId);
    }

    public function getResponse()
    {
        return file_get_contents($this->responseFile);

    }

    public function findSite($userId, $reqFile, $one = false)
    {
        $data = array();
        if ($one !== false) {
            $json = $this->commandStatus($userId);
        } else {
            $json = $this->commandFind($userId);
        }
        Logger::log("Response -> \n" . $json, false);
        $error = Errors::isError($json);
        if ($error !== 0) {
            $data['manError']['isError'] = true;
            $data['manError']['errorBody'] = $error;
            return $data;
        }
        if ($one !== false) {
            return $this->getSingleData($userId, $json, $one);
        }
        return $this->getMultiData($userId, $json);
    }

    public function getSingleData($userId, $json, $one)
    {
        $urls = "";
        $links = "";
        $data = array();
        $dataProvider = CJSON::decode($json);
        $data[0] = $dataProvider["itemsList"][0]["itemObject"];
        $userDataStr = $data[0]['userId'];
        $userData = Dictionary::getUserData($data[0]['userId']);
        foreach ($userData as $v) {
            $userDataStr .= ' / ' . $v;
        }
        foreach ($data[0]["urls"] as $url) {
            if ($url != '')
                $urls = $urls . $url["url"] . "<br>";
                $links = $links . '<a class = "ext" target = "_blank" href="' . $url["url"] . '">' . $url["url"] . '</a>' . "<br>";
        }
        $data[0]["urls"] = $urls;
        $data[0]["urls_act"] = $links;
        $data[0]["state_str"] = $this->getState($userId, false, 0);
        $data[0]["urlType_str"] = $this->getURLType($userId, 0);
        $data[0]["fetchType_str"] = $this->getFetchType($userId, 0);
        $data[0]["userData"] = $userDataStr;
        return new CArrayDataProvider($data);
    }

    public function getState($userId, $hl, $n)
    {
        $json = $this->getResponse($userId, $this->responseFile, true);
        $data = CJSON::decode($json);
        if(isset($data['itemsList'][0]['itemObject'][$n])){
            $state = $data['itemsList'][0]['itemObject'][$n]['state'];
        } else {
            $state = $data['itemsList'][0]['itemObject']['state'];
        }
        if ($hl) {
            switch ($state) {
                case '1':
                    return '<div class = "hl-green">Active</div>';
                    break;
                case '2':
                    return '<div class = "hl-red">Disabled</div>';
                    break;
                case '3':
                    return '<div class = "hl-blue">Suspended</div>';
                    break;
            }
        } else {
            switch ($state) {
                case '1':
                    return 'Active';
                    break;
                case '2':
                    return 'Disabled';
                    break;
                case '3':
                    return 'Suspended';
                    break;
            }
        }
    }

    public function getURLType($userId, $n)
    {
        $json = $this->getResponse($userId, $this->responseFile, true);
        $data = CJSON::decode($json);
        if(isset($data['itemsList'][0]['itemObject'][$n])){
            $state = $data['itemsList'][0]['itemObject'][$n]['urlType'];
        } else {
            $state = $data['itemsList'][0]['itemObject']['urlType'];
        }
        switch ($state) {
            case '0':
                return 'Regular';
                break;
            case '1':
                return 'Single';
                break;
            case '3':
                return 'All';
                break;
        }
    }

    public function getFetchType($userId, $n)
    {
        $json = $this->getResponse($userId, $this->responseFile, true);
        $data = CJSON::decode($json);
        if(isset($data['itemsList'][0]['itemObject'][$n])){
            $state = $data['itemsList'][0]['itemObject'][$n]['fetchType'];
        } else {
            $state = $data['itemsList'][0]['itemObject']['fetchType'];
        }
        switch ($state) {
            case '1':
                return 'Static';
                break;
            case '2':
                return 'Dynamic';
                break;
            case '3':
                return 'External';
                break;
        }
    }

    public function getCounters($userId, $siteId)
    {
        $counters = array();
        $counters['collectedURLs'] = 0;
        $counters['deletedURLs'] = 0;
        $counters['contents'] = 0;
        $counters['errors'] = 0;
        $counters['iterations'] = 0;
        $counters['newURLs'] = 0;
        $counters['size'] = 0;
        $counters['resources'] = 0;
        $counters['avgSpeed'] = 0;
        $counters['avgSpeedCNT'] = 0;
        $json = CJSON::decode($this->getResponse($userId));
        foreach ($json['itemsList'] as $item) {  // FIXME: add single site support
            foreach ($item['itemObject'] as $siteItem) {
                if ($siteItem['id'] == $siteId) {
                    $counters['collectedURLs'] += $siteItem['collectedURLs'];
                    $counters['deletedURLs'] += $siteItem['deletedURLs'];
                    $counters['contents'] += $siteItem['contents'];
                    $counters['errors'] += $siteItem['errors'];
                    $counters['iterations'] += $siteItem['iterations'];
                    $counters['newURLs'] += $siteItem['newURLs'];
                    $counters['size'] += $siteItem['size'];
                    $counters['resources'] += $siteItem['resources'];
                    $counters['avgSpeed'] += $siteItem['avgSpeed'];
                    $counters['avgSpeedCNT']++;
                }
            }
        }
        $counters['avgSpeed'] = round($counters['avgSpeed'] / $counters['avgSpeedCNT']);
        return $counters;
    }

    public function getMultiData($userId, $json)
    {
        $urls = "";
        $links = "";
        $data = array();
        $dataProvider = CJSON::decode($json);
        foreach ($dataProvider["itemsList"][0]["itemObject"] as $key => $item) {
            $userData = Dictionary::getUserData($item['userId']);
            foreach ($item["urls"] as $url) {
                if ($url != '')
                    $urls = $urls . $url["url"] . "<br>";
                    $links = $links . '<a class = "ext" target = "_blank" href="' . $url["url"] . '">' . $url["url"] . '</a>' . "<br>";
            }
            $item["urls"] = $urls;
            $item["urls_act"] = $links;
            $item["nn"] = $key;
            $item["state_str"] = $this->getState($userId, true, $key);
            $item["owner"] = $userData['username'];
            $item["errorsString"] = Dictionary::getErrorsStringByMask((String)$item['errorMask']);
            $urls = "";
            $links = "";
            $data[] = $item;

        }
        $data['manError']['isError'] = false;
        return $data;
    }

    public function createRequest($pattern, $state, $limit, $uid, $pN, $sortBy, $sortDirection, $tags=false)
    {
        if ($tags) {
            $tagsCount = "AND `sites_urls`.`TagsCount`>0";
        } else {
            $tagsCount = '';
        }
        if ($uid !== "*"){
            $uid = Dictionary::getUIDByString($uid);
        } elseif ($uid === "*"){
            $uid = '1';
        }
        if ($uid == '1') {
            $sites = Dictionary::getSitesOfUser();
        } else {
            $sites = Dictionary::getSitesOfUser(array($uid));
        }
        $from = $pN*$limit-$limit;
        if ($state == "all") {
            $state = "";
        } else {
            $state = "AND `sites`.`State`=$state";
        }
        $criterions = array(
            'url' => null,
            'criterions' => array(
                "WHERE" =>
                    "`sites`.`Id` IN ($sites)  AND `sites`.`Id`=`sites_urls`.`Site_Id` $state $tagsCount AND `sites_urls`.`URL` LIKE '%$pattern%' GROUP BY sites.Id",
                "LIMIT" => "$from, $limit",
                "ORDER BY" => "sites.$sortBy $sortDirection"
            )
        );
        $json = json_encode($criterions);
        Logger::log("Opertion ->" . $this->opLog, false);
        Logger::log("Request -> \n" . $json, true);
        $path = Yii::app()->getBasePath() . '/json_temp/';
        $reqFile = tempnam($path, '');
        $file = fopen($reqFile, 'w');
        $this->requestFile = $reqFile;
        fwrite($file, $json);
    }



    public function getFilters($userId, $file, $n = 0)
    {
        $counter = 0;
        $filtersItems = array();
        $json = $this->getResponse($userId, $file, true);
        $data = CJSON::decode($json);
        $filters = $data['itemsList'][0]['itemObject']['filters'];
        foreach ($filters as $item) {
            $item["n"] = $counter++;
            $item["nn"] = $n;
            $filtersItems[] = $item;
        }
        $filtersProvider = new CArrayDataProvider($filtersItems, array(
            'keyField' => 'type',
            'pagination' => false,
        ));
        return $filtersProvider;
    }

    public function getProperties($userId, $file, $n)
    {
        $propsProvider = array();
        $json = $this->getResponse($userId, $file, true);
        $data = CJSON::decode($json);
        $props = $data['itemsList'][0]['itemObject']['properties'];
        $propsProvider = $props;
        foreach ($props as $property) {
            if ($property['name'] == 'SCRAPING_TYPE_NAME') {
                $scrapingType = $property['value'];
            }
        }
        if (!isset($scrapingType))
            $scrapingType = 'NOT SET';
        return array(
            'provider' => new CArrayDataProvider($propsProvider, array(
                'keyField' => 'name',
                'pagination' => false
                )
            ),
            'scrapingType' => $scrapingType
        );
    }

    public function getLimits($userId, $file, $n)
    {
        $limitsProvider = array();
        $json = $this->getResponse($userId, $file, true);
        $data = CJSON::decode($json);
        $limitsProvider[] = array(
            'limit_name' => 'Priority',
            'limit_value' => $data['itemsList'][0]['itemObject']['priority'],
            'limit_name_f' => 'priority'
        );
        $limitsProvider[] = array(
            'limit_name' => 'Max Urls',
            'limit_value' => $data['itemsList'][0]['itemObject']['maxURLs'],
            'limit_name_f' => 'maxURLs'
        );
        $limitsProvider[] = array(
            'limit_name' => 'Max resources',
            'limit_value' => $data['itemsList'][0]['itemObject']['maxResources'],
            'limit_name_f' => 'maxResources'
        );
        $limitsProvider[] = array(
            'limit_name' => 'Max Errors',
            'limit_value' => $data['itemsList'][0]['itemObject']['maxErrors'],
            'limit_name_f' => 'maxErrors'
        );
        $limitsProvider[] = array(
            'limit_name' => 'Max resource size',
            'limit_value' => $data['itemsList'][0]['itemObject']['maxResourceSize'],
            'limit_name_f' => 'maxResourceSize'
        );
        $limitsProvider[] = array(
            'limit_name' => 'Max URLs from page',
            'limit_value' => $data['itemsList'][0]['itemObject']['maxURLsFromPage'],
            'limit_name_f' => 'maxURLsFromPage'
        );
        $limitsProvider[] = array(
            'limit_name' => 'Processing delay, ms',
            'limit_value' => $data['itemsList'][0]['itemObject']['processingDelay'],
            'limit_name_f' => 'processingDelay'
        );
        $limitsProvider[] = array(
            'limit_name' => 'Request delay, ms',
            'limit_value' => $data['itemsList'][0]['itemObject']['requestDelay'],
            'limit_name_f' => 'requestDelay'
        );
        $limitsProvider[] = array(
            'limit_name' => 'HTTP timeout, ms',
            'limit_value' => $data['itemsList'][0]['itemObject']['httpTimeout'],
            'limit_name_f' => 'httpTimeout'
        );
        return new CArrayDataProvider($limitsProvider, array(
            'keyField' => 'limit_name',
            'pagination' => false
        ));
    }

    public function getUserId()
    {
        if (!isset(Yii::app()->request->cookies['UserId'])) {
            $userId = $this->generateUID();
            $cookie = new CHttpCookie('UserId', $userId);
            $cookie->expire = time() + 31536000;
            Yii::app()->request->cookies['UserId'] = $cookie;
            return $userId;
        }
        return Yii::app()->request->cookies['UserId']->value;
    }

    public function generateUID()
    {
        return md5(Yii::app()->session->sessionID);
    }

    public function getErrorsTypes($userId, $file, $n = null)
    {
        $eTypes = array();
        $json = $this->getResponse();
        $data = CJSON::decode($json);
        $mask = $data['itemsList'][0]['itemObject']['errorMask'];
        for ($power = 0; $power <= 64; $power++) {
            $error = $mask & pow(2, $power);
            if ($error != 0) {
                $eTypes[] = $power;
            }
        }
        $errors = Dictionary::getErrorsByMask($eTypes);
        if ($n !== null) {
            return new CArrayDataProvider($errors, array(
                'keyField' => 'errorType',
                'pagination' => false
            ));
        } else {
            $errStr = "";
            foreach ($errors as $error) {
                $errStr .= $error['errorType'].", ";
            }
        }
    }

    public function checkForErrors($json)
    {
        $data = CJSON::decode($json);
        if (is_null($data)) {
            return true;
        }
        if (!is_array($data["itemsList"][0]["itemObject"])) {
            return true;
        }
        return false;
    }
    public function rmTmpData()
    {
        unlink($this->requestFile);
        unlink($this->responseFile);
    }
    public function integrityCheck($siteId)
    {
        $ret = array();
        $urls = array(
            'Urls' => $this->urlFetch($siteId),
            'Sites' => $this->siteStatus($siteId),
        );

        $absInSites = array_diff($urls['Urls'], $urls['Sites']);
        $absInUrls = array_diff($urls['Sites'], $urls['Urls']);
        if (empty($absInSites) && empty($absInUrls)){
            return array(
                'code'=>0
            );
        }
        if (!empty($absInSites) && !isset($absInSites['empty'])) {
            foreach ($absInSites as $k => $v) {
                $ret[] = array(
                    'URLs' => $v,
                    'arrow' => '<div class = "arrows">&#8680;</div>',
                    'Sites' => 'Absent'
                );
            }
        }
        if (!empty($absInUrls) && !isset($absInUrls['empty'])) {
            foreach ($absInUrls as $k => $v) {
                $ret[] = array(
                    'Sites' => $v,
                    'arrow' => '<div class = "arrows">&#8680;</div>',
                    'URLs' => 'Absent'

                );
            }
        }
        return $ret;
    }
    public function syncUrls()
    {

    }
    public function siteStatus($siteId)
    {
        $siteStatus = new SitesView();
        $siteStatus->createRequestSingle(false, $siteId, true);
        $json = $siteStatus->commandStatus(false);
        $jsonDecoded = CJSON::decode($json);
        if (empty($jsonDecoded['itemsList'][0]['itemObject']['urls'])) {
            $URLs['empty'] = 'empty';
        }
        foreach ($jsonDecoded['itemsList'][0]['itemObject']['urls'] as $url) {
            $URLs[$url['urlMd5']] = $url['url'];
        }
        Logger::cleanLog();
        return $URLs;
    }
    public function urlFetch($siteId)
    {
        $urlFetch = new UrlsView();
        $userId = Yii::app()->user->id;
        $json = $urlFetch->fetch($userId, array(
            'siteId'=>$siteId,
            'onlyRoot'=>true,
            'pN'=>1,
            'limit'=>MAX_URLS_INTEGRITY_CHECK,
            'status' =>'',
            'sortBy' => '',
            'sortDirection' => '',
        ));
        unset($json['manError']);
        if (empty($json)) {
            $URLs['empty'] = 'empty';
        }
        foreach ($json as $url) {
            $URLs[$url['urlMd5']] = $url['url'];
        }
        Logger::cleanLog();
        return $URLs;
    }
}