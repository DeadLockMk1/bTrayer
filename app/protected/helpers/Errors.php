<?php 
class Errors {
    public static function isError($jsonRaw) {
        $json = CJSON::decode($jsonRaw);
        if (is_null($json)) {
            throw new CHttpException('DCC',"Can't access DC Client. Please, check the \"PathToApi\" string in config.ini");
        }
        if (isset($json['errorCode'])) {
            $nodes = explode(';', $json['errorCode']);
            foreach ($nodes as $k => $v) {
                if(($v != 0) || ($v != 0)) {
                    return $json['errorMessage'];
                }
            }
        }
        if (isset($json['error_code'])) {
            $nodes = explode(';', $json['error_code']);
            foreach ($nodes as $k => $v) {
                if(($v != 0) || ($v != 0)) {
                    return $json['error_message'];
                }
            }
        }
        if ((isset($json['itemsList'][0]['errorCode'])) && ($json['itemsList'][0]['errorCode'] != 0)) {
            return $json['itemsList'][0]['errorMessage'];
        } elseif ((isset($json['itemsList'][0]['itemObject']['errorCode'])) && ($json['itemsList'][0]['itemObject']['errorCode'] != 0)) {
            return $json['itemsList'][0]['itemObject']['errorMessage'];
        }
        return 0;
    }
}
