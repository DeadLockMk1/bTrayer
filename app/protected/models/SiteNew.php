<?php

/**
 * Site New.
 *
 */
class SiteNew extends SiteUpdate
{
    /**
     *
     * Starts "New site" operation
     *
     */
    public function addNewSite()
    {
        CVarDumper::dump('asdasd');
        $this->opLog = "SITE_NEW";
        $this->operation = "Add new site";
        $result = $this->updateSiteInfo();
        return $result;
    }

    /**
     *
     * Starts update process.
     *
     * @param mixed $reqFile
     *
     * @return bool     true
     */
    public function commandUpdate($reqFile)
    {
        // Path to application
        $api = Yii::app()->params['api'];
        // Path to folder containing bash scripts
        $path = Yii::app()->getBasePath() . '/shell/';
        $cmd = "sh " . $path . "site_new.sh $api $reqFile";
        //Execute bash script, and get response JSON
        $json = shell_exec($cmd);
        $error = Errors::isError($json);
        if ($error !== 0) {
            Yii::app()->user->setFlash('error1', $this->operation . ' ERROR: ' . $error);
        } else {
            Yii::app()->user->setFlash('success1', $this->operation . ': SUCCESS');
        }
        Logger::log("Response ->\n" . $json);
        return $json;
    }

    public function getDefaults()
    {
        if (UserModule::isAdmin()) {
            return array(
                "priority" => "100",
                "maxURLs" => "1000",
                "maxURLsFromPage" => "200",
                "maxResources" => "200",
                "maxErrors" => "400",
                "maxResourceSize" => "1000000",
                "processingDelay" => "500",
                "requestDelay" => "500",
                "httpTimeout" => "30000",
            );
        } else {
            return array(
                "priority" => "100",
                "maxURLs" => "200",
                "maxURLsFromPage" => "50",
                "maxResources" => "200",
                "maxErrors" => "400",
                "maxResourceSize" => "1000000",
                "processingDelay" => "500",
                "requestDelay" => "500",
                "httpTimeout" => "30000",
            );
        }
    }
    public function getDefaultProps() {
        return array(
            "CONTENT_HASH" =>'{ "algorithm": 1, "tags": "title,description,content_encoded,media,pubdate", "delete": 1 }',
            "PROCESS_CTYPES" =>"text/html",
            "STORE_HTTP_HEADERS" =>"1",
            "STORE_HTTP_REQUEST" =>"1",
            "AUTO_REMOVE_RESOURCES" =>"1",
            "AUTO_REMOVE_WHERE" =>"ParentMd5<>\"\" AND Status IN (4,7) AND DATE_ADD(UDate, INTERVAL %RecrawlPeriod% MINUTE)<NOW()",
            "AUTO_REMOVE_ORDER" =>"ContentType ASC, Crawled ASC, TagsCount ASC, UDate ASC",
            "RECRAWL_DELETE_WHERE" =>"(`Status`=1 OR (`Status`=4 AND Crawled=0 AND Processed=0) OR `PDate`<CURDATE() OR `PDate` IS NULL OR CDate<CURDATE()) AND `ParentMd5`<>''",
        );
    }
    public function getTProps() {
        $data = Yii::app()->request->getParam("data");
        return $data["items"][0]["properties"];
    }
}