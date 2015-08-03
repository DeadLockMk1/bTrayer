<?php

/**
 * Created by PhpStorm.
 * User: Aleksey
 * Date: 28.07.2015
 * Time: 14:32
 */
class RestoreJsonGenerator
{
    public function getJson()
    {
        $data = file_get_contents(Yii::app()->params['dataFolder'].DIRECTORY_SEPARATOR.'autofill_template.json');
        $jsonDecoded = json_decode($data, true);
        $props = Yii::app()->request->getParam('data');
        $url = Yii::app()->request->getParam('url');
        if (isset($props['template'])){
            $props['template'] = json_decode($props['template'], true);
        }
        $jsonDecoded['items'][0]['properties'] = $props;
        $jsonDecoded['items'][0]['urlObj']['url'] = $url;
//        VarDumper::dump($jsonDecoded);
        return json_encode($jsonDecoded);
    }
}