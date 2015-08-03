<?php
# @var $message - string
class Logger
{
    public static function log($message, $isJson = false)
    {
        $from = array(
            ',',
            '{',
            '}',
            ':{'
        );
        $to   = array(
            ",\n    ",
            "{\n    ",
            "\n}",
            ":\n{\t"
        );
        if ($isJson) {
            $message = str_replace($from, $to, $message);
        }
        $logPath = (Yii::app()->getBasePath() . '/runtime');
        $log     = fopen($logPath . '/last.log', 'a');
        $logHistory     = fopen($logPath . '/'.date('Y-m-d').'_dc-ui.log', 'a');
        $string  = date("\n\n" . '[d-m-Y H:i:s] >>> ') . $message;
//        Yii::log($message, 'info', 'json');
        fwrite($log, CHtml::encode($string));
        fclose($log);
        fwrite($logHistory, $string);
        fclose($logHistory);
    }
    public static function getTrace()
    {
        $logPath    = (Yii::app()->getBasePath() . '/runtime');
        $logContent = file_get_contents($logPath . '/last.log');
        return $logContent;
    }
    public static function cleanLog()
    {
        $logPath = (Yii::app()->getBasePath() . '/runtime');
        $log     = fopen($logPath . '/last.log', 'w');
    }
}
?>