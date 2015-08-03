<?php

if (empty($data)) {
    $data = '';
}
$this->layout = false;
$contentType = !empty($contentType) ? $contentType : 'text/html; charser=utf-8';
header('Content-type: '.$contentType);
echo $data;
Yii::app()->end();
