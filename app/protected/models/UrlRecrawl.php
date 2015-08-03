<?php

class UrlRecrawl extends UrlCleanup
{
    public function recrawl()
    {
        $this->operation = "Re-Crawl";
        $this->opLog = "URL_RECRAWL (Based on URL_CLEANUP)";
        $this->dType = 1;
        $r = Yii::app()->request;
        $this->cleanupUrlInfo(
            $r->getParam('siteId'),
            $r->getParam('url'),
            $r->getParam('urlType'),
            '0', '1'
        );

        unset($cleanup);
        return true;
    }
}