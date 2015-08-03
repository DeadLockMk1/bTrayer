<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$ini = parse_ini_file('protected/config/config.ini');
require_once 'const.php';
return array(
    'sourceLanguage' => 'en',
    'language' => 'en',
    'basePath'=>dirname(dirname(__FILE__)),
    'runtimePath'=>dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'runtime',
    'name'=>'DC service Web UI',
    'defaultController'=>'SitesView',
    'theme' => 'default',

    // preloading 'log' component
    'preload'=>array('log','booster', 'debug'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.models.behaviors.*',
        'application.models.behaviors.Serialize.*',
        'application.components.*',
        'application.helpers.*',
        'application.vendors.*',
        'application.modules.user.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.models.*',
        'application.modules.rights.components.*',
        'application.modules.account.*',
        'application.modules.account.models.*',
        'application.models.AccountSite.*',
        'application.modules.TagsReaperUI.widgets.*',
        'application.modules.TagsReaperUI.helpers.*',
        'application.modules.TagsReaperUI.components.*',
    ),

    'modules'=>array(
        // uncomment the following to enable the Gii tool
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'hce12345',
        ),

        /*
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
        */
        'user'=>array(
                'tableUsers' => 'users',
                'tableProfiles' => 'profiles',
                'tableProfileFields' => 'profiles_fields',
                'hash' => 'md5', // encrypting method (php hash function)
                'sendActivationMail' => false, // send activation email
                'loginNotActiv' => false, // allow access for non-activated users
                'activeAfterRegister' => true, // activate user on registration (only sendActivationMail = false)
                'autoLogin' => true, // automatically login from registration
                'registrationUrl' => array('/user/registration'), // registration path
                'recoveryUrl' => array('/user/recovery'), // recovery password path
                'loginUrl' => array('/user/login'), // login form path
                'returnUrl' => array('/user/profile'), // page after login
                'returnLogoutUrl' => array('/user/login'), // page after logout
        ),
        'rights'=>array(
                'superuserName'=>'Admin', // Name of the role with super user privileges. 
                'authenticatedName'=>'Authenticated',  // Name of the authenticated user role. 
                'userIdColumn'=>'id', // Name of the user id column in the database. 
                'userNameColumn'=>'username',  // Name of the user name column in the database. 
                'enableBizRule'=>true,  // Whether to enable authorization item business rules. 
                'enableBizRuleData'=>true,   // Whether to enable data for business rules. 
                'displayDescription'=>true,  // Whether to use item description instead of name. 
                'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages. 
                'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages.
                'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested. 
                'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights. 
                'appLayout'=>'application.views.layouts.main', // Application layout. 
                'cssFile'=>'rights.css', // Style sheet file to use for Rights. 
                'install'=>false,  // Whether to enable installer. 
                'debug'=>true, 
        ),
        'account' => array(),
        'job' => array(),
        'TagsReaperUI' => array(),
    ),

    // application components
    'components'=>array(
        
        'user'=>array(
                'class'=>'RWebUser',
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                'loginUrl'=>array('/user/login'),
        ),
        'authManager'=>array(
                'class'=>'RDbAuthManager',
                'connectionID'=>'db',
                'defaultRoles'=>array(),
        ),
        /*'request'=>array(
            'enableCsrfValidation'=>true,
        ),*/
        'debug' => array(
            'class' => 'application.extensions.yii2-debug.Yii2Debug',
        ),
        'cache' => array(
            'class' => 'system.caching.CDummyCache'
        ),
        'booster' => array(
            'class' => 'application.extensions.booster.components.Booster',
        ),
        'format'=>array(
            'class'=>'application.components.YFormatter',
        ),
        'session' => array(
            'autoStart' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'showScriptName' => false,
            'urlFormat'=>'path',
            'rules'=>array(
                '<controller:TagsReaperUI>/<action:tryIt>'=>'TagsReaperUI/TagsReaperUI/tryIt',
                '<controller:TagsReaperUI>/<action:createSession>'=>'TagsReaperUI/TagsReaperUI/createSession',
                '<controller:TagsReaperUI>/<action:getContentForVTP>'=>'TagsReaperUI/TagsReaperUI/getContentForVTP',
                '<controller:TagsReaperUI>/<action:toggleUserInfoForm>'=>'TagsReaperUI/TagsReaperUI/toggleUserInfoForm',
                '<controller:TagsReaperUI>/<action:validationDynamicFields>'=>'TagsReaperUI/TagsReaperUI/validationDynamicFields',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),
        /*
        'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ),
        */
        // uncomment the following to use a MySQL database
        'db'=>array(
            'connectionString' => 'mysql:host='.MAIN_MYSQL_HOST.';dbname=dc_management',
            'tablePrefix' => '',
            'emulatePrepare' => true,
            'username' => MAIN_MYSQL_USER,
            'password' => MAIN_MYSQL_PASSWORD,
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        /*'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),*/
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                // uncomment the following to show log messages on web pages

                array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'info, cmd',
//                    'showInFireBug'=>true,
                ),

            ),
        ),
        'securityManager'=>array(
            'cryptAlgorithm' => 'blowfish',
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        'adminEmail' => ADMIN_EMAIL,
        'api'=>PATH_TO_API,
        'apiDir'=>PATH_TO_API_DIR,
        'tmpDir'=>PATH_TO_TMP_DIR,
        'dataFolder'=>dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'data',
        'bashScrFolder'=>dirname(dirname(dirname(__FILE__))).'/shell/',
        'webRoot'=>dirname(dirname(dirname(__FILE__))),
    ),
);
