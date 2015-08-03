<?php

class UrlReprocess extends UrlUpdate
{
    public function getJson()
    {
        $this->operation = "Re-process";
        $request = Yii::app()->getRequest();
        $json[] = array(
            'CDate' => null,
            'UDate' => 'NOW()',
            'batchId' => null,
            'charset' => null,
            'contentMask' => null,
            'contentType' => null,
            'contentURLMd5' => null,
            'crawled' => null,
            'crawlingTime' => null,
            'depth' => null,
            'eTag' => null,
            'errorMask' => null,
            'freq' => null,
            'httpCode' => null,
            'httpMethod' => null,
            'httpTimeout' => null,
            'lastModified' => null,
            'linksE' => null,
            'linksI' => null,
            'mRate' => null,
            'mRateCounter' => null,
            'maxURLsFromPage' => null,
            'pDate' => null,
            'parentMd5' => null,
            'priority' => null,
            'processed' => null,
            'processingDelay' => null,
            'processingTime' => null,
            'rawContentMd5' => null,
            'requestDelay' => null,
            'siteId' => $request->getPost('siteId'),
            'siteSelect' => null,
            'size' => null,
            'state' => 0,
            'status' => 4,
            'tagsCount' => null,
            'tagsMask' => null,
            'tcDate' => null,
            'totalTime' => null,
            'type' => null,
            'url' => null,
            'urlMd5' => $request->getPost('urlMd5'),
            'urlUpdate' => 1,
        );
        return $json;
    }
}