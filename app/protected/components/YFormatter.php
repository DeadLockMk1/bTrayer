<?php
class YFormatter extends CFormatter {
    /**
     *
     * Text formatter shortening long texts and displaying the full text
     * as the span title.
     *
     * To be used in GridViews for instance.
     * @param string $value
     * @param string $shortTextLimit
     * @return string  Encoded and possibly html formatted string ('span' if the text is long).
     */
    public function formatShortText($value, $shortTextLimit = 100, $defaultValue = '-') {
        if(strlen($value)>$shortTextLimit) {
            $a = mb_substr($value,0,$shortTextLimit-3,Yii::app()->charset);
            $retval=CHtml::tag('span',array('title'=>$value),CHtml::encode($a.'...'));
        } else {
            $retval=CHtml::encode($value);
        }       
        return (!empty($retval) ? $retval : $defaultValue);
    }

    /**
     * Create link for each url in string urls
     * @param  string $urlsString
     * @param  string $splitter
     * @return string
     */
    public function createLinkForEachUrlInString($urlsString, $splitter = ',') {
        if (empty($urlsString)) {
            return '';
        }
        $urlsArray = explode($splitter, $urlsString);
        foreach ($urlsArray as &$url) {
            $url = CHtml::encode($url);
            $url = CHtml::link($url, $url);
        }
        return implode($splitter, $urlsArray);
    }

    /**
     * Convert array urls to single string url
     * @param  array   $urls
     * @param  string  $arrayKey
     * @param  integer $limit
     * @param  string  $splitter
     * @return string
     */
    public function arrayUrlsToStringUrls($urls, $arrayKey = 'url', $limit = 64, $splitter = ',') {
        $urlsString = '';
        if (empty($urls)) {
            return $urlsString;
        }
        foreach ($urls as $url) {
            $break = false;
            $url = (!empty($url[$arrayKey]) ? $url[$arrayKey] : $url);
            $urlsString .= $url . $splitter;
            $urlsStringLen = mb_strlen($urlsString);
            if ($urlsStringLen == $limit) {
                $break = true;
            } elseif ($urlsStringLen > ($limit + 1)) {
                $urlsArray = explode($splitter, $urlsString);
                array_pop($urlsArray);
                array_pop($urlsArray);
                $urlsString = implode($splitter, $urlsArray);
                $break = true;
            }
            if ($break) {
                break;
            }
        }     
        if ($break) {
            $urlsString = YFormatter::createLinkForEachUrlInString($urlsString) . '...';
        } else {
            $urlsString = mb_substr($urlsString, 0, (mb_strlen($urlsString) - 1));
            $urlsString = YFormatter::createLinkForEachUrlInString($urlsString);
        }
        return $urlsString;
    }
}