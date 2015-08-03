<?php

if (empty($data)) {
    $data = array();
}
$this->layout = false;
header('Content-type: application/json;');
echo json_encode($data);
Yii::app()->end();
