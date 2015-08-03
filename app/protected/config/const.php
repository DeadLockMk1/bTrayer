<?php
defined('YII_ENABLE_ERROR_HANDLER') or define('YII_ENABLE_ERROR_HANDLER', false);
defined('YII_ENABLE_EXCEPTION_HANDLER') or define('YII_ENABLE_EXCEPTION_HANDLER', false);

define('DB_DATETIME_FORMAT', 'Y-m-d H:i:s');
define('DB_DATE_FORMAT', 'Y-m-d');

/*$debugIPs = array(
    '127.0.0.1' => true,
    // ...
);
define('IS_PUBLIC_INSTALLATION', (!isset($debugIPs[$_SERVER['SERVER_ADDR']]) ? true : false));*/

define('MAIN_MYSQL_HOST', $ini['MysqlHost']);
define('MAIN_MYSQL_USER', $ini['MysqlUser']);
define('MAIN_MYSQL_PASSWORD', $ini['MysqlPassword']);
define('ADMIN_EMAIL', $ini['adminEmail']);
define('PATH_TO_API', $ini['PathToApi']);
define('PATH_TO_API_DIR', $ini['PathToApiDir']);
define('PATH_TO_TMP_DIR', $ini['PathToTmpDir']);
define('MAX_URLS_INTEGRITY_CHECK', 1000);
define('PATH_JSON_TEMP', Yii::app()->getBasePath().'/json_temp');
define('PATH_SHELL', Yii::app()->getBasePath().'/shell');