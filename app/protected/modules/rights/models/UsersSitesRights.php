<?php
class UsersSitesRights extends UsersRights
{
    /**
     * Rights key.
     *
     * @var string
     */
    private $__key = 'Site';

    /**
     * Returns the static model of the specified AR class.
     *
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Table name.
     *
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users_sites_rights';
    }

    /**
     * Returns sites by search params.
     *
     * @param array $params
     *
     * @return array
     */
    public function search($params)
    {
        $sites = array();
        $json = $this->commandFind($params['userId']);
        $dataProvider = CJSON::decode($json);
        foreach ($dataProvider["itemsList"][0]["itemObject"] as $item) {
            $item['urls'] = YFormatter::arrayUrlsToStringUrls($item['urls']);
            $sites[] = $item;
        }
        foreach ($sites as $site) {
            $ids['sites'][] = $site['id'];
            $ids['users'][] = $site['userId'];
        }
        if (empty($sites)) {
            return $sites;
        }
        $usersSitesRights = $this->findAllByAttributes(array(
            'Site_Id' => $ids['sites'], 'User_Id' => $ids['users'], )
        );
        foreach ($sites as &$site) {
            $site['Rights'] = array();
            foreach ($usersSitesRights as $userSiteRight) {
                if ($site['id'] == $userSiteRight->Site_Id &&
                    $site['userId'] == $userSiteRight->User_Id) {
                    $site['Rights'] = $userSiteRight->Rights;
                }
            }
            if (!empty($params['rights']) && !array_intersect($params['rights'], $site['Rights'])) {
                $site = array();
            }
        }

        return array_filter($sites);
    }

    /**
     * Create request json file.
     *
     * @param array $params
     */
    public function createRequest($params)
    {
        $pattern = Dictionary::switchCh($params['pattern']);
        $criterions = $this->__createRequestCriterions($params);
        $json = json_encode($criterions);
        Logger::log("Sending request -> \n".$json, true);
        $path = Yii::app()->getBasePath().'/json_temp/';
        $file = fopen($path.$params['userId'].'_request.json', 'w');
        fwrite($file, $json);
    }

    /**
     * Start command by userId.
     *
     * @param string $userId
     *
     * @return array
     */
    public function commandFind($userId)
    {
        $api = Yii::app()->params['api'];
        $path = Yii::app()->getBasePath().'/shell/';
        $pathJson = Yii::app()->getBasePath().'/json_temp/';
        $cmd = "sh ".$path."site_find_by_criterions.sh $api $pathJson $userId";
        $json = shell_exec($cmd);
        $file = fopen($pathJson.$userId.'_response.json', 'w');
        fwrite($file, $json);
        fclose($file);

        return $this->getResponse($userId);
    }

    /**
     * Returns response by userId.
     *
     * @param string $userId
     *
     * @return array
     */
    public function getResponse($userId)
    {
        $path = Yii::app()->getBasePath().'/json_temp/';

        return file_get_contents($path.$userId.'_response.json');
    }

    /**
     * Update users sites rights.
     *
     * @param array $records
     * @param array $rights
     *
     * @return boolean
     */
    public function setRightsAllRecords($records, $rights = array())
    {
        if (empty($records)) {
            return false;
        }
        foreach ($records as $record) {
            $params = $this->buildRightsSingleRecordParams(
                $record, $rights
            );
            $this->setRightsSingleRecord($params);
        }

        return true;
    }

    /**
     * Set rights for user site.
     *
     * @param array   $params
     * @param boolean $autoSet
     *
     * @return boolean
     */
    public function setRightsSingleRecord($params, $autoSet = false)
    {
        $result = false;
        if (empty($params['siteId']) ||
            empty($params['userId']) ||
            (!isset($params['rights']) &&
             empty($autoSet))) {
            return $result;
        }
        if (empty($params['conditions'])) {
            $params['conditions'] = 'User_Id = :userId AND Site_Id = :siteId';
        }
        if (empty($params['params'])) {
            $params['params'] = array(
                ':siteId' => $params['siteId'],
                ':userId' => $params['userId'],
            );
        }
        if (!empty($autoSet)) {
            $params['rights'] = array_keys($this->getRightsList());
        }
        if (!empty($params['rights'])) {
            $rightsBitMask = $this->createBitMask(
                $params['rights'], $this->statesData
            );
            $isExists = $this->findAll($params['conditions'], $params['params']);
            if (!empty($isExists)) {
                if (!empty($autoSet)) {
                    $result = true;
                } else {
                    $result = $this->updateAll(
                        array('Rights' => $rightsBitMask),
                        $params['conditions'],
                        $params['params']
                    );
                }
            } else {
                // TODO: Yii - why need 'new' every time for save?
                $model = new UsersSitesRights();
                $model->Site_Id = $params['siteId'];
                $model->User_Id = $params['userId'];
                $model->Rights = $rightsBitMask;
                $result = $model->save();
            }
        } else {
            $result = $this->deleteAll(
                $params['conditions'], $params['params']
            );
        }

        return $result;
    }

    /**
     * Encode array data in string.
     *
     * @param array $data
     *
     * @return string
     */
    public function encode($data)
    {
        return base64_encode(serialize($data));
    }

    /**
     * Decode string data to array.
     *
     * @param string $data
     *
     * @return array
     */
    public function decode($data)
    {
        return unserialize(base64_decode($data));
    }

    /**
     * Returns find params default.
     *
     * @param array $params
     *
     * @return array
     */
    public function buildFindParams($params)
    {
        if (!empty($params['rights'])) {
            if (strpos($params['rights'], ',') !== false) {
                $params['rights'] = explode(',', $params['rights']);
            } else {
                $params['rights'] = (array) $params['rights'];
            }
            foreach ($params['rights'] as &$right) {
                $right .= 'Site';
            }
        }
        if (!empty($params['currentPage']) && $params['currentPage'] >= 2) {
            $currentPage = $params['currentPage'] * $params['pageSize'];
            $params['limit'] = array(
                ($currentPage - $params['pageSize']),
                ($currentPage + 1),
            );
        }
        if (empty($params['limit'])) {
            $params['limit'] = array(0, ($params['pageSize'] + 1));
        }

        return $params;
    }

    /**
     * Returns update site params.
     *
     * @param array $site
     * @param array $rights
     *
     * @return array
     */
    public function buildRightsSingleRecordParams($record, $rights = array())
    {
        $siteId = $this->_getValueFromRecord($record, array(
            'id', 'siteId', 'Id', 'Site_Id',
        ));
        $userId = $this->_getValueFromRecord($record, array(
            'userId', 'User_Id',
        ));
        $rights = (!empty($rights[$siteId]) ? $rights[$siteId] : array());

        return array(
            'siteId' => $siteId,
            'userId' => $userId,
            'rights' => $rights,
        );
    }

    /**
     * Returns rights key.
     *
     * @return string
     */
    protected function _getRightsKey()
    {
        return $this->__key;
    }

    /**
     * Create criterions for request.
     *
     * @param array $params
     *
     * @return array
     */
    private function __createRequestCriterions($params)
    {
        extract($params);
        $criterions = array(
            'url' => "http://%$pattern%",
            'criterions' => array(
                "ORDER BY" => "CDate ASC",
            ),
        );
        if (!empty($searchUserId)) {
            $criterions['criterions']['WHERE']['AND'][] = "`User_Id`=$searchUserId";
        }
        if (!empty($siteId)) {
            $criterions['criterions']['WHERE']['AND'][] = "`Site_Id`=\"$siteId\"";
        }
        if (!empty($limit)) {
            $criterions['criterions']['LIMIT'] = implode(', ', $limit);
        }
        if (!empty($criterions['criterions']['WHERE']['AND'])) {
            $criterions['criterions']['WHERE'] = implode(' AND ', $criterions['criterions']['WHERE']['AND']);
        }

        return $criterions;
    }
}
