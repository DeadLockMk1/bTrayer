<?php

class UrlsView
{
    private $operation = 'URL_FETCH';

    public function fetch($userId, $params, $one = false)
    {
        $data = array();
        $this->createRequest($userId, $params, $one);
        $this->sendRequest($userId);
        $json = $this->getResponse($userId);
        Logger::log("Response -> \n" . $json, false);
        $error = Errors::isError($json);
        if ($error !== 0) {
            $data['manError']['isError'] = true;
            $data['manError']['errorBody'] = $error;
            return $data;
        }
        if ($one !== false) {
            return $this->getSingleData($userId, $json);
        }
        return $this->getMultiData($userId, $json);
    }

    public function createRequest($userId, $params, $one = false)
    {
        if ($one != false) {
            $json = array(
                0 => array(
                    'algorithm' => 0,
                    'maxURLs' => 1,
                    'sitesCriterions' => array(
                        'ORDER BY' => 'CDate DESC'
                    ),
                    'sitesList' => array(),
                    'urlUpdate' => null,
                    'urlsCriterions' => array(
                        'WHERE' => "`urlMd5`='$params'",
                        'LIMIT' => 1,
                        'ORDER BY' => 'CDate ASC'
                    )
                )
            );
        } else {
            $conditions = $this->getConditions($params);
            $orderConditions = $this->getOrderConditions($params);
            $json = array(
                0 => array(
                    'algorithm' => 0,
                    'maxURLs' => $params['limit'],
                    'sitesCriterions' => array(
                        'WHERE' => "`Id`='{$params['siteId']}'",
                    ),
                    'sitesList' => array(),
                    'urlUpdate' => null,
                    'urlsCriterions' => array(
                        'WHERE' => "$conditions",
                        'ORDER BY' => $orderConditions
                    )
                )
            );
            if (isset($params['limit'])) {
                $from = $params['pN']*$params['limit']-$params['limit'];
                $json[0]['maxURLs'] = $params['limit'];
                $json[0]['urlsCriterions']['LIMIT'] = "$from, {$params['limit']}";

            }
        }

        $json = json_encode($json);
        Logger::log("Opertion ->" . $this->operation, false);
        Logger::log("Request -> \n" . $json, true);
        $path = Yii::app()->getBasePath() . '/json_temp/';
        $file = fopen($path . $userId . '_request.json', 'w');
        fwrite($file, $json);
    }

    public function getOrderConditions($params)
    {
        $orderByConditions = '';
        if ($params['sortBy'] == '') {
            $orderByConditions .= 'UDate';
        } else {
            $orderByConditions .= $params['sortBy'];
        }
        if ($params['sortDirection'] == '') {
            $orderByConditions .= ' DESC';
        } else {
            $orderByConditions .= ' ' . $params['sortDirection'];
        }
        return $orderByConditions;
    }

    public function getConditions($form)
    {
        $conditions = '';
        if ($form['status'] == '') {
            $conditions .= "`Status`>=0";
        }
        foreach ($form as $name => $value) {
            if (trim($value) != '') {
                switch ($name) {
                    case 'status':
                        $conditions .= "`Status`=$value";
                        break;
                    case 'resourceURL':
                        $conditions .= " AND `URL` LIKE '" . trim($value) . "%'";
                        break;
                    case 'resourceId':
                        $conditions .= " AND `URLMd5`='" . trim($value) . "'";
                        break;
                    case 'contentType':
                        $conditions .= " AND `ContentType`='" . trim($value) . "'";
                        break;
                    case 'state':
                        $conditions .= " AND `State`='" . trim($value) . "'";
                        break;
                    case 'type':
                        $conditions .= " AND `Type`='" . trim($value) . "'";
                        break;
                    case 'parentUrl':
                        $conditions .= " AND `ParentMd5`='" . md5(trim($value)) . "'";
                        break;
                    case 'errorMask':
                        if (trim($value) == '0')
                            $conditions .= " AND `ErrorMask`=" . trim($value)."";
                        elseif (trim($value) == 'Any')
                            $conditions .= " AND `ErrorMask`<>0";
                        else
                            $conditions .= " AND (`ErrorMask`&" . trim($value).")=". trim($value);
                        break;
                    case 'tagsMask':
//                        $conditions .= " AND `TagsMask`&" . trim($value);
//                        break;
                        if (trim($value) == '0')
                            $conditions .= " AND `TagsMask`=" . trim($value)."";
                        elseif (trim($value) == 'Any')
                            $conditions .= " AND `TagsMask`<>0";
                        else
                            $conditions .= " AND (`TagsMask`&" . trim($value).")=". trim($value);
                        break;
                    case 'tagsCount':
                        $conditions .= " AND `TagsCount`='" . trim($value) . "'";
                        break;
                    case 'httpCode':
                        $conditions .= " AND `HttpCode`='" . trim($value) . "'";
                        break;
                    case 'tcDateFrom':
                        $conditions .= " AND `TcDate`>='" . $form['tcDateFrom'] . ' ' . $form['tcTimeFrom']. "'";
                        break;
                    case 'tcDateTo':
                        $conditions .= " AND `TcDate` <='" . $form['tcDateTo'] . ' ' . $form['tcTimeTo'] . "'";
                        break;
                    case 'cDateFrom':
                        $conditions .= " AND `CDate`>='" . $form['cDateFrom'] . ' ' . $form['cTimeFrom']. "'";
                        break;
                    case 'cDateTo':
                        $conditions .= " AND `CDate` <='" . $form['cDateTo'] . ' ' . $form['cTimeTo'] . "'";
                        break;
                    case 'pDateFrom':
                        $conditions .= " AND `PDate`>='" . $form['pDateFrom'] . ' ' . $form['pTimeFrom']. "'";
                        break;
                    case 'pDateTo':
                        $conditions .= " AND `PDate` <='" . $form['pDateTo'] . ' ' . $form['pTimeTo'] . "'";
                        break;
                    case 'depthFrom':
                        $conditions .= " AND `Depth`>='" . $form['depthFrom'] . "'";
                        break;
                    case 'depthTo':
                        $conditions .= " AND `Depth`<='" . $form['depthTo'] . "'";
                        break;
                    case 'onlyRoot':
                        $conditions .= " AND `parentMd5` = ''";
                        break;
                    case 'crawledMore':
                        $conditions .= " AND `Crawled` > 0";
                        break;
                    case 'processedMore':
                        $conditions .= " AND `Processed` > 0";
                        break;

                    default:
                        break;
                }
            }
        }
        return $conditions;
    }

    public function sendRequest($userId)
    {
        $api = Yii::app()->params['api'];
        $path = Yii::app()->getBasePath() . '/shell/';
        $pathJson = Yii::app()->getBasePath() . '/json_temp/';
        $cmd = "sh " . $path . "url_fetch.sh $api $pathJson $userId";
        $json = shell_exec($cmd);
        $file = fopen($pathJson . $userId . '_response.json', 'w');
        fwrite($file, $json);
        fclose($file);
    }

    public function getResponse($userId)
    {
        $path = Yii::app()->getBasePath() . '/json_temp/';
        return file_get_contents($path . $userId . '_response.json');
    }

    public function getSingleData($userId, $json, $hl = true)
    {
        $toReturn = array();
        $data = array();
        $dataProvider = CJSON::decode($json);
        $data = $dataProvider["itemsList"][0]["itemObject"];
        if (empty($data)) {
            $id = Yii::app()->getRequest()->getParam('urlId');
            throw new CHttpException('404', "Resource with ID<br>$id<br>was not found...");
        }
            $toReturn['manError']['isError'] = false;
            $toReturn[] = $data;
            foreach ($data[0] as $i => $value) {
                if ($value === '') {
                    $data[0][$i] = '<div class="none" title="&quot;' . $i
                        . '&quot;: &quot;&quot;,"><span title="">none</span></div>';
                }
                if ($value === null) {
                    $data[0][$i] = '<div class="none" title="&quot;' . $i
                        . '&quot;: null,"><span title="">null</span></div>';
                }
            }
            $data[0] = array_replace($data[0], $this->getCounters($userId, $data[0]['urlMd5']));
            $data[0]['state_str'] = $this->getStrValues($userId, 0)['state'];
            $data[0]['status_str'] = $this->getStrValues($userId, 0)['status'];
            $data[0]['url_act'] = '<a target = "_blank" href="'.$data[0]['url'].'">'.$data[0]['url'].'</a>';
            $toReturn[] = $data;
            return $toReturn;
        }

    public function getCounters($userId, $urlId)
    {
        $counters = array();
        $counters['crawled'] = 0;
        $counters['processed'] = 0;
        $counters['linksI'] = 0;
        $counters['linksE'] = 0;
        $counters['tagsCount'] = 0;
        $counters['freq'] = 0;
        $counters['crawlingTime'] = 0;
        $counters['processingTime'] = 0;
        $counters['totalTime'] = 0;
        $counters['size'] = 0;
        $counters['mRate'] = 0;
        $counters['mRateCNT'] = 0;
        $json = CJSON::decode($this->getResponse($userId));
        foreach ($json['itemsList'] as $item) {
            foreach ($item['itemObject'] as $siteItem) {
                if ($siteItem['urlMd5'] == $urlId) {
                    $counters['crawled'] += $siteItem['crawled'];
                    $counters['processed'] += $siteItem['processed'];
                    $counters['linksI'] += $siteItem['linksI'];
                    $counters['linksE'] += $siteItem['linksE'];
                    $counters['tagsCount'] += $siteItem['tagsCount'];
                    $counters['freq'] += $siteItem['freq'];
                    $counters['crawlingTime'] += $siteItem['crawlingTime'];
                    $counters['processingTime'] += $siteItem['processingTime'];
                    $counters['totalTime'] += $siteItem['totalTime'];
                    $counters['size'] += $siteItem['size'];
                    $counters['mRate'] += $siteItem['mRate'];
                    $counters['mRateCNT']++;
                }
            }
        }
        $counters['mRate'] = $counters['mRate'] / $counters['mRateCNT'];
        return $counters;
    }

    public function getStrValues($userId, $n)
    {
        $ret = array();
        $json = $this->getResponse($userId);
        $data = CJSON::decode($json);
        $state = $data['itemsList'][0]['itemObject'][$n]['state'];
        $status = $data['itemsList'][0]['itemObject'][$n]['status'];
        switch ($state) {
            case '0':
                $ret['state'] = 'Enabled';
                break;
            case '1':
                $ret['state'] = 'Disabled';
                break;
            case '2':
                $ret['state'] = 'Error';
                break;
        }
        switch ($status) {
            case '0':
                $ret['status'] = 'Undefined';
                break;
            case '1':
                $ret['status'] = 'New';
                break;
            case '2':
                $ret['status'] = 'Selected for crawling';
                break;
            case '3':
                $ret['status'] = 'Crawling';
                break;
            case '4':
                $ret['status'] = 'Crawled';
                break;
            case '5':
                $ret['status'] = 'Selected to process';
                break;
            case '6':
                $ret['status'] = 'Processing';
                break;
            case '7':
                $ret['status'] = 'Processed';
                break;
            case '8':
                $ret['status'] = 'Selected for crawling (incremental)';
                break;
        }
        return $ret;
    }

    public function getMultiData($userId, $json)
    {
        $data = array();
        $dataProvider = CJSON::decode($json);
        $items = $dataProvider["itemsList"][0]["itemObject"];
        foreach ($items as $i => $urlItem) {
            $data[$i] = array_replace($urlItem, $this->getCounters($userId, $urlItem['urlMd5']));
            if (isset($data[$i])) {
                $data[$i]['state_str'] = $this->getStrValues($userId, $i)['state'];
                $data[$i]['status_str'] = $this->getStrValues($userId, $i)['status'];
            }
        }
        $data['manError']['isError'] = false;
        return $data;
    }

    public function getLimits($userId)
    {
        $limitsProvider = array();
        $json = $this->getResponse($userId);
        $data = CJSON::decode($json);
        $limitsProvider[] = array(
            'limit_name' => 'Priority',
            'limit_value' => $data['itemsList'][0]['itemObject'][0]['priority'],
            'limit_name_f' => 'priority'
        );
        $limitsProvider[] = array(
            'limit_name' => 'Max URLs from page',
            'limit_value' => $data['itemsList'][0]['itemObject'][0]['maxURLsFromPage'],
            'limit_name_f' => 'maxURLsFromPage'
        );
        $limitsProvider[] = array(
            'limit_name' => 'Processing delay, ms',
            'limit_value' => $data['itemsList'][0]['itemObject'][0]['processingDelay'],
            'limit_name_f' => 'processingDelay'
        );
        $limitsProvider[] = array(
            'limit_name' => 'Request delay, ms',
            'limit_value' => $data['itemsList'][0]['itemObject'][0]['requestDelay'],
            'limit_name_f' => 'requestDelay'
        );
        $limitsProvider[] = array(
            'limit_name' => 'HTTP Timeout, ms',
            'limit_value' => $data['itemsList'][0]['itemObject'][0]['httpTimeout'],
            'limit_name_f' => 'httpTimeout'
        );
        return new CArrayDataProvider($limitsProvider, array(
            'keyField' => 'limit_name',
            'pagination' => false
        ));
    }

    public function getErrorsTypes($userId)
    {
        $eTypes = array();
        $json = $this->getResponse($userId);
        $data = CJSON::decode($json);
        $mask = $data['itemsList'][0]['itemObject'][0]['errorMask'];
        for ($power = 0; $power <= 64; $power++) {
            $error = $mask & pow(2, $power);
            if ($error != 0) {
                $eTypes[] = $power;
            }
        }
        $errors = Dictionary::getErrorsByMask($eTypes);
        return new CArrayDataProvider($errors, array(
            'keyField' => 'errorType',
            'pagination' => false
        ));
    }

    public function getTagsTypes($userId)
    {
        $tTypes = array();
        $json = $this->getResponse($userId);
        $data = CJSON::decode($json);
        $mask = $data['itemsList'][0]['itemObject'][0]['tagsMask'];
        for ($power = 0; $power <= 64; $power++) {
            $tag = $mask & pow(2, $power);
            if ($tag != 0) {
                $tTypes[] = $power;
            }
        }
        $tags = Dictionary::getTagsByMask($tTypes);
        return new CArrayDataProvider($tags, array(
            'keyField' => 'tag',
            'pagination' => false
        ));
    }

    public function getContentParams($data)
    {
        return array(
            'siteId' => $data['siteId'],
            'url' => $data['url'],
            'urlMd5' => $data['urlMd5'],
        );
    }

    public function getHistoryParams($data)
    {
        return array(
            'siteId' => $data['siteId'],
            'urlMd5' => $data['urlMd5'],
        );
    }

    public static function getContents($userId)
    {
        $request = Yii::app()->request;
        $json[] = array(
            'contentTypeMask' => $request->getParam("mask"),
//            'contentTypeMask' => 4095,
            'siteId' => $request->getParam("siteId"),
            'url' => $request->getParam("url"),
            'urlFetch' => null,
            'urlMd5' => $request->getParam("urlMd5"),
        );
        $json = CJSON::encode($json);
        $path = Yii::app()->getBasePath() . '/json_temp/';
        $file = fopen($path . $userId . '_request_content.json', 'w');
        fwrite($file, $json);
        $api = Yii::app()->params['api'];
        $path = Yii::app()->getBasePath() . '/shell/';
        $pathFile = Yii::app()->getBasePath() . '/json_temp/' . $userId . '_request_content.json';
        $cmd = "sh " . $path . "url_content.sh $api $pathFile";
        $json = shell_exec($cmd);
        $path = Yii::app()->getBasePath() . '/json_temp/';
        $file = fopen($path . $userId . '_response_content.json', 'w+');
        fwrite($file, $json);
        fclose($file);
        $response = file_get_contents($path . $userId . '_response_content.json');
        $respDecoded = CJSON::decode($response);
//        VarDumper::dump($request->getParam("mask"));
//        VarDumper::dump($response);
        if ($request->getParam("t") == 0 || $request->getParam("t") == 2) {
            if(!isset($respDecoded['itemsList'][0]['itemObject'][0]['rawContents'][0])) {
                $rawContent = 'No contents found...';
            } else {
                $rawContent = base64_decode($respDecoded['itemsList'][0]['itemObject'][0]['rawContents'][0]['buffer']);
            }
            $contentItem['type'] = 'raw';
            $contentItem['contents'] = '<textarea id = "url-content">' . CHtml::encode($rawContent) . '</textarea>';
            return $contentItem;
        } elseif ($request->getParam("t") == 1) {
            if (!isset($respDecoded['itemsList'][0]['itemObject'][0]['processedContents'][0])) {
                $proContent = '{"Sorry...": "...no contents found"}';
                $contentItem['type'] = 'processed';
                $contentItem['contents'] = $proContent;
            } else {
                $proContent = base64_decode($respDecoded['itemsList'][0]['itemObject'][0]['processedContents'][0]['buffer']);
                $contentDecoded = CJSON::decode($proContent);
                $contentDecoded = self::contentFormat($contentDecoded);
                $contentItem['type'] = 'processed';
                $contentItem['contents'] = $contentDecoded;
                $contentItem['contents'] = CJSON::encode($contentItem['contents']);
            }
            return $contentItem;
        } elseif ($request->getParam("t") == 3) {
            if (!isset($respDecoded['itemsList'][0]['itemObject'][0]['headers'][0])) {
                $proContent = 'No headers...';
                $contentItem['type'] = 'headers';
                $contentItem['contents'] = $proContent;
            } else {
                $proContent = base64_decode($respDecoded['itemsList'][0]['itemObject'][0]['headers'][0]['buffer']);
//                VarDumper::dump($proContent); die();
//                $contentDecoded = CJSON::decode($proContent);
                $contentItem['type'] = 'headers';
                $contentItem['contents'] = $proContent;
//                $contentItem['contents'] = CJSON::encode($contentItem['contents']);
            }
            return $contentItem;
        } elseif ($request->getParam("t") == 4) {
            if (!isset($respDecoded['itemsList'][0]['itemObject'][0]['cookies'][0])) {
                $proContent = 'No cookies...';
                $contentItem['type'] = 'headers';
                $contentItem['contents'] = $proContent;
            } else {
                $proContent = base64_decode($respDecoded['itemsList'][0]['itemObject'][0]['cookies'][0]['buffer']);
//                $contentDecoded = CJSON::decode($proContent);
                $contentItem['type'] = 'headers';
                $contentItem['contents'] = $proContent;
//                $contentItem['contents'] = CJSON::encode($contentItem['contents']);
            }
            return $contentItem;
        } elseif ($request->getParam("t") == 5) {
            if (!isset($respDecoded['itemsList'][0]['itemObject'][0]['requests'][0])) {
                $proContent = 'No requests...';
                $contentItem['type'] = 'headers';
                $contentItem['contents'] = $proContent;
            } else {
                $proContent = base64_decode($respDecoded['itemsList'][0]['itemObject'][0]['requests'][0]['buffer']);
//                $contentDecoded = CJSON::decode($proContent);
                $contentItem['type'] = 'headers';
                $contentItem['contents'] = $proContent;
//                $contentItem['contents'] = CJSON::encode($contentItem['contents']);
            }
            return $contentItem;
        } elseif ($request->getParam("t") == 6) {
            if (!isset($respDecoded['itemsList'][0]['itemObject'][0]['meta'][0])) {
                $proContent = 'No meta data...';
                $contentItem['type'] = 'headers';
                $contentItem['contents'] = $proContent;
            } else {
                $proContent = base64_decode($respDecoded['itemsList'][0]['itemObject'][0]['meta'][0]['buffer']);
//                $contentDecoded = CJSON::decode($proContent);
                $contentItem['type'] = 'headers';
                $contentItem['contents'] = $proContent;
//                $contentItem['contents'] = CJSON::encode($contentItem['contents']);
            }
            return $contentItem;
        } elseif ($request->getParam("t") == 7) {
            if(!isset($respDecoded['itemsList'][0]['itemObject'][0]['rawContents'][0])) {
                $rawContent = 'No contents found...';
            } else {
                $rawContent = base64_decode($respDecoded['itemsList'][0]['itemObject'][0]['rawContents'][0]['buffer']);
            }
            $contentItem['type'] = 'raw';
            $contentItem['contents'] = '<textarea id = "url-content">' . CHtml::encode($rawContent) . '</textarea>';
            return $contentItem;
        }
    }

    public function getHistory($useCriterions = false)
    {
        $nodes = array();
        $request = Yii::app()->request;
        if (!$useCriterions) {
            $json[] = array(
                'siteId' => $request->getParam('siteid'),
                'urlMd5' => $request->getParam('urlMd5'),
                'urlCriterions' => null,
                'logCriterions' => array(
                    'LIMIT' => 50,
                    'ORDER BY' => 'ODate DESC'
                ),
            );
        } else {
            $criterions = '';
            if ($_POST['operation'] == '') {
                $criterions .= "`OpCode`>=0";
            } else {
                $criterions .= "`OpCode`=" . $_POST['operation'];
            }
            foreach ($_POST as $name => $value) {
                if (trim($value) != '') {
                    switch ($name) {
                        case 'cDateFrom':
                            $criterions .= " AND `CDate`>=\"$value" . ' ' . $_POST['cTimeFrom']."\"";
                            break;
                        case 'cDateTo':
                            $criterions .= " AND `CDate`<=\"$value" . ' ' . $_POST['cTimeTo']."\"";
                            break;
                        case 'oDateFrom':
                            $criterions .= " AND `ODate`>=\"$value" . ' ' . $_POST['oTimeFrom']."\"";
                            break;
                        case 'oDateTo':
                            $criterions .= " AND `ODate`<=\"$value" . ' ' . $_POST['oTimeTo']."\"";
                            break;

                        default:
                            break;
                    }
                }
            }
            $pN = (isset($_POST['custom'])) ? $_POST['pN'] : $_POST['pNp'];
            $from = $pN*$request->getParam('limit')-$request->getParam('limit');
            $json[] = array(
                'siteId' => $request->getParam('siteid'),
                'urlMd5' => $request->getParam('urlMd5'),
                'urlCriterions' => null,
                'logCriterions' => array(
                    'WHERE' => $criterions,
                    'ORDER BY' => 'ODate DESC',
                    'LIMIT' => "$from, {$_POST['limit']}"
                ),
            );
        }
//        VarDumper::dump($json); die();
        $json = CJSON::encode($json);
        $path = Yii::app()->getBasePath() . '/json_temp/';
        $request = tempnam($path, '');
        $file = fopen($request, 'w');
        fwrite($file, $json);
        $api = Yii::app()->params['api'];
        $path = Yii::app()->getBasePath() . '/shell/';
        $cmd = "sh " . $path . "url_history.sh $api $request";
        $json = shell_exec($cmd);
        unlink($request);
        $path = Yii::app()->getBasePath() . '/json_temp/';
        $response = tempnam($path, '');
        $file = fopen($response, 'w+');
        fwrite($file, $json);
        fclose($file);
        $responseData = file_get_contents($response);
        $history = CJSON::decode($responseData);
//        VarDumper::dump($history); exit;
        unlink($response);
        if (!isset($history['itemsList']))
            throw new CHttpException('500',$responseData);
        foreach($history['itemsList'] as $n => $node) {
            $nodeName = $node['node'];
            $node = $node['itemObject'][0]['logRows'];

            foreach ($node as $i => $operation) {
//                foreach ($node['itemObject'][0]['logRows'][$i] as $k => $v) {
//                    $node['itemObject'][0]['logRows'][$i]["0".$k] = $v;
//                    unset($node['itemObject'][0]['logRows'][$i][$k]);
//                }
                $node[$i]['OpText'] = $this->getOpByCode($operation['OpCode']);
                $Object = CJSON::decode($operation['Object']);
                if (isset($Object['reason']) && $operation['OpCode'] == 21) {
                    $node[$i]['Reason'] = $this->getReasonByCode($Object['reason']);
                } else {
                    $node[$i]['Reason'] = '';
                }
            }
            $nodes[$nodeName] = new CArrayDataProvider($node, array(
                'keyField' => 'OpCode',
                'pagination' => false
            ));
        }
        return $nodes;
    }

    public function getStatistics($useCriterions = false)
    {
            /*
            $request = Yii::app()->request;
            if (!isset($request->getParam('urlMd5'))) {
                $urlMd5 = null;
            } else {
                $urlMd5 = null;
            }

            if (!$useCriterions) {
                $json[] = array(
                    'siteId' => $request->getParam('siteid'),
                    'urlMd5' => $request->getParam('urlMd5'),
                    'criterions' => array(
                        'LIMIT' => 1,
                        'ORDER BY' => 'ODate DESC'
                    ),
                );
            } else {
                $criterions = '';
                if ($_POST['operation'] == '') {
                    $criterions .= "`OpCode`>=0";
                } else {
                    $criterions .= "`OpCode`=" . $_POST['operation'];
                }
                foreach ($_POST as $name => $value) {
                    if (trim($value) != '') {
                        switch ($name) {
                            case 'cDateFrom':
                                $criterions .= " AND `CDate`>=\"$value" . ' ' . $_POST['cTimeFrom']."\"";
                                break;
                            case 'cDateTo':
                                $criterions .= " AND `CDate`<=\"$value" . ' ' . $_POST['cTimeTo']."\"";
                                break;
                            case 'oDateFrom':
                                $criterions .= " AND `ODate`>=\"$value" . ' ' . $_POST['oTimeFrom']."\"";
                                break;
                            case 'oDateTo':
                                $criterions .= " AND `ODate`<=\"$value" . ' ' . $_POST['oTimeTo']."\"";
                                break;

                            default:
                                break;
                        }
                    }
                }
                $pN = (isset($_POST['custom'])) ? $_POST['pN'] : $_POST['pNp'];
                $from = $pN*$request->getParam('limit')-$request->getParam('limit');
                $json[] = array(
                    'siteId' => $request->getParam('siteid'),
                    'urlMd5' => $request->getParam('urlMd5'),
                    'criterions' => array(
                        'WHERE' => $criterions,
                        'ORDER BY' => 'ODate DESC',
                        'LIMIT' => "$from, {$_POST['limit']}"
                    ),
                );
            }
    //        VarDumper::dump($json); die();
            $json = CJSON::encode($json);
            $path = Yii::app()->getBasePath() . '/json_temp/';
            $request = tempnam($path, '');
            $file = fopen($request, 'w');
            fwrite($file, $json);
            $api = Yii::app()->params['api'];
            $path = Yii::app()->getBasePath() . '/shell/';
            $cmd = "sh " . $path . "url_statistics.sh $api $request";
            $json = shell_exec($cmd);
            unlink($request);
            $path = Yii::app()->getBasePath() . '/json_temp/';
            $response = tempnam($path, '');
            $file = fopen($response, 'w+');
            fwrite($file, $json);
            fclose($file);
            $responseData = file_get_contents($response);
            $history = CJSON::decode($responseData);
    //        VarDumper::dump($history); exit;
            unlink($response); */
        $nodes = array();
        $history = $this->plug();
//        if (!isset($history['itemsList']))
//            throw new CHttpException('500',$responseData);
        foreach($history['itemsList'] as $n => $node) {
            $nodeName = $node['node'];
            $node = $node['itemObject'][0]['freqRows'];
            $nodes[$nodeName] = new CArrayDataProvider($node, array(
                'keyField' => 'FIns',
                'pagination' => false
            ));
        }
        return $nodes;
    }

    private function getOpByCode($opCode)
    {
        /* URL:
         20 - Insert,
         21 - Delete,
         22 - Update,
         23 - Cleanup,
         24 - Aging,
         25 - Content;
         Status:
         1 - New,
         2 - Selected to crawl,
         3 - Crawling,
         4 - Crawled,
         5 - Selected to process,
         6 - Processing,
         7 - Processed
        */
        switch ($opCode) {
            case 20:
                return "URL: Insert";
                break;
            case 21:
                return "URL: Delete";
                break;
            case 22:
                return "URL: Update URL";
                break;
            case 23:
                return "URL: Cleanup URL";
                break;
            case 24:
                return "URL: Aging";
                break;
            case 25:
                return "URL: Content";
                break;
            case 1:
                return "Status: New";
                break;
            case 2:
                return "Status: Selected to crawl";
                break;
            case 3:
                return "Status: Crawling";
                break;
            case 4:
                return "Status: Crawled";
                break;
            case 5:
                return "Status: Selected to process";
                break;
            case 6:
                return "Status: Processing";
                break;
            case 7:
                return "Status: Processed";
                break;

        }
    }

    private function getReasonByCode($reason)
    {
        /*
        REASON_USER_REQUEST = 0
        REASON_AGING = 1
        REASON_SITE_LIMITS = 2
        REASON_SELECT_TO_CRAWL_TTL = 3
        REASON_SELECT_TO_PROCESS_TTL = 4
        REASON_RECRAWL = 5
        REASON_CRAWLER_AUTOREMOVE = 6
        REASON_SITE_UPDATE_ROOT_URLS = 7
        REASON_RT_FINALIZER = 10
        REASON_PROCESSOR_DUPLICATE = 11
        */
        switch ($reason) {
            case 0:
                return "REASON_USER_REQUEST ";
                break;
            case 1:
                return "REASON_AGING";
                break;
            case 2:
                return "REASON_SITE_LIMITS";
                break;
            case 3:
                return "REASON_SELECT_TO_CRAWL_TTL";
                break;
            case 4:
                return "REASON_SELECT_TO_PROCESS_TTL";
                break;
            case 5:
                return "REASON_RECRAWL";
                break;
            case 6:
                return "REASON_CRAWLER_AUTOREMOVE";
                break;
            case 7:
                return "REASON_SITE_UPDATE_ROOT_URLS";
                break;
            case 10:
                return "REASON_RT_FINALIZER";
                break;
            case 11:
                return "REASON_PROCESSOR_DUPLICATE";
                break;

        }
    }

    public function contentFormat($jsonDecoded) {
        if (isset($jsonDecoded['default'])) {
            return $jsonDecoded;
        } else if (isset($jsonDecoded[0])) {
            foreach ($jsonDecoded[0] as $k => $v) {
                $jsonDecoded[0][$k] = array($v);
            }
        }
        return $jsonDecoded;
    }

    private function plug() {
        if (isset($_GET['urlMd5'])) {
            return array(
                'errorCode' => 0,
                'errorMessage' => '',
                'itemsList' => array(
                    0 => array(
                        'errorCode' => 0,
                        'errorMessage' => '',
                        'host' => 'localhost',
                        'id' => 2802077046,
                        'itemObject' => array(
                            0 => array(
                                'freqRows' => array(
                                    0 => array(
                                        'URLMd5'=>md5(0),
                                        'FIns'=>0,
                                        'FDel'=>1,
                                        'FUpd'=>42,
                                        'FNew'=>0,
                                        'FCrawled'=>5,
                                        'FProcessed'=>2,
                                        'FAged'=>0,
                                        'FDeleted'=>1,
                                        'FPurged'=>0,
                                        'CDate'=>'2015-07-21 18:20:04',
                                        'MDate'=>'2015-07-21 18:20:04',
                                    ),

                                ),
                                'siteId' => '3482ff72a1888d77d23422a95b8565a5',
                            ),
                        ),
                        'node' => 'm011_data',
                        'port' => '5530',
                        'time' => 148,
                    ),
                ),
            );
        }
        return array(
            'errorCode' => 0,
            'errorMessage' => '',
            'itemsList' => array(
                0 => array(
                    'errorCode' => 0,
                    'errorMessage' => '',
                    'host' => 'localhost',
                    'id' => 2802077046,
                    'itemObject' => array(
                        0 => array(
                            'freqRows' => array(
                                0 => array(
                                    'URLMd5'=>md5(0),
                                    'FIns'=>0,
                                    'FDel'=>1,
                                    'FUpd'=>42,
                                    'FNew'=>0,
                                    'FCrawled'=>5,
                                    'FProcessed'=>2,
                                    'FAged'=>0,
                                    'FDeleted'=>1,
                                    'FPurged'=>0,
                                    'CDate'=>'2015-07-21 18:20:04',
                                    'MDate'=>'2015-07-21 18:20:04',
                                ),
                                1 => array(
                                    'URLMd5'=>md5(1),
                                    'FIns'=>0,
                                    'FDel'=>1,
                                    'FUpd'=>42,
                                    'FNew'=>0,
                                    'FCrawled'=>5,
                                    'FProcessed'=>2,
                                    'FAged'=>0,
                                    'FDeleted'=>1,
                                    'FPurged'=>0,
                                    'CDate'=>'2015-07-21 18:20:04',
                                    'MDate'=>'2015-07-21 18:20:04',
                                ),
                                2 => array(
                                    'URLMd5'=>md5(2),
                                    'FIns'=>0,
                                    'FDel'=>1,
                                    'FUpd'=>42,
                                    'FNew'=>0,
                                    'FCrawled'=>5,
                                    'FProcessed'=>2,
                                    'FAged'=>0,
                                    'FDeleted'=>1,
                                    'FPurged'=>0,
                                    'CDate'=>'2015-07-21 18:20:04',
                                    'MDate'=>'2015-07-21 18:20:04',
                                ),
                                3 => array(
                                    'URLMd5'=>md5(3),
                                    'FIns'=>0,
                                    'FDel'=>1,
                                    'FUpd'=>42,
                                    'FNew'=>0,
                                    'FCrawled'=>5,
                                    'FProcessed'=>2,
                                    'FAged'=>0,
                                    'FDeleted'=>1,
                                    'FPurged'=>0,
                                    'CDate'=>'2015-07-21 18:20:04',
                                    'MDate'=>'2015-07-21 18:20:04',
                                ),
                                4 => array(
                                    'URLMd5'=>md5(4),
                                    'FIns'=>0,
                                    'FDel'=>1,
                                    'FUpd'=>42,
                                    'FNew'=>0,
                                    'FCrawled'=>5,
                                    'FProcessed'=>2,
                                    'FAged'=>0,
                                    'FDeleted'=>1,
                                    'FPurged'=>0,
                                    'CDate'=>'2015-07-21 18:20:04',
                                    'MDate'=>'2015-07-21 18:20:04',
                                ),
                                5 => array(
                                    'URLMd5'=>md5(5),
                                    'FIns'=>0,
                                    'FDel'=>1,
                                    'FUpd'=>42,
                                    'FNew'=>0,
                                    'FCrawled'=>5,
                                    'FProcessed'=>2,
                                    'FAged'=>0,
                                    'FDeleted'=>1,
                                    'FPurged'=>0,
                                    'CDate'=>'2015-07-21 18:20:04',
                                    'MDate'=>'2015-07-21 18:20:04',
                                ),

                            ),
                            'siteId' => '3482ff72a1888d77d23422a95b8565a5',
                            ),
                        ),
                    'node' => 'm011_data',
                    'port' => '5530',
                    'time' => 148,
                ),
            ),
        );
    }
}