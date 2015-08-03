<?php /* @var $this Controller */
$assetsManager = Yii::app()->clientScript;
$assetsManager->registerCoreScript('jquery');
$assetsManager->registerCoreScript('jquery.ui');

// Disable jquery-ui default theme
$assetsManager->scriptMap=array(
//    'jquery-ui-bootstrap.css'=>false,
    'jquery-ui.css'=>false,
);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>

        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/hce-transparent.png" type="image/png" />
        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/component.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/loaders.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/menu.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/highlights.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto&subset=cyrillic-ext,latin' rel='stylesheet' type='text/css'>

        <script type="text/javascript" src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <!--        <script type="text/javascript" src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/js/modals/modernizr.custom.js"></script>-->
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/purl.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/script.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/copyright.js"></script>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
    <div id="mainmenu">
        <nav role="custom-dropdown">
            <input type="checkbox" id="button" class="small-menu-checkbox">
            <label for="button" onclick></label>
            <?php
                if (!UserModule::isGuest()) {
                    $subMenu['logInOut'] = array(
                        'label' => 'Logout ('.Yii::app()->user->name.')',
                        'url' => array('//user/logout'),
                        'visible' => true
                    );
                } else {
                    $subMenu['logInOut'] = array(
                        'label' => 'Login', 
                        'url' => array('//user/login'),
                        'visible' => true
                    );
                }
                $this->widget('zii.widgets.CMenu',array(
                    'items'=>array(
//                        array(
//                            'label'=>'Try It!',
//                            'url'=>array('//user/login', 'tryIt' => true),
//                            'visible' => UserModule::isGuest()
//                        ),
                        array(
                            'label'=>'Sites', 
                            'url'=>array('//SitesView/index'),
                            'visible' => !UserModule::isGuest()
                        ),
                       array(
                            'label'=>'Resources', 
                            'url'=>array('//UrlsView/index'),
                            'visible' => !UserModule::isGuest()
                        ),
                        // array('label'=>'Batches', 'url'=>array('')),
                        // array('label'=>'Stats', 'url'=>array('')),
                        // array('label'=>'Configuration', 'url'=>array('')),
                        array(
                            'label' => 'Users',
                            'url' => array('//user/admin/admin'),
                            'visible' => UserModule::isAdmin()
                        ),
                        array(
                            'label' => 'Profile',
                            'url' => array('//user/profile/profile'),
                            'visible' => UserModule::isNotGuestAndUserTemp()
                        ),
                        $subMenu['logInOut'],
                    )
                )); 
            ?>
            </ul>
        </nav>
    </div>

    <?php
        $logBttn = '<button id="traceback" class="ui-state-default ui-corner-all " onclick="toggleLog()">Log</button>';
    if (!UserModule::isGuest()) {
        echo $logBttn;
    }
    ?>
        <div id="log">
            <pre>
                <?php
                if (isset($this->log))
                    echo $this->log;
                Logger::cleanLog();
                ?>
            </pre>
        </div>
    <div class="container" id="page">
        <div id="header">
            <div id="logo"><img src="/images/hce-transparent.png" width="100"><?php echo CHtml::encode(Yii::app()->name); ?></div>
        </div><!-- header -->
        <?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
            )); ?><!-- breadcrumbs -->
        <?php endif?>

        <div id = "content">
            <?php $this->renderPartial('//app/_flash'); ?>
            <?php echo $content; ?>
        </div>

        <div class="clear"></div>

        <div id="footer">
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', 'UA-65671652-1', 'auto');
                ga('send', 'pageview');

            </script>
            <?php
                $svn = (file_exists('.svn/entries')) ? 'SVN '.file('.svn/entries')[3] : '' ;
            ?>
             DC service web administration interface.<br/>
             IOIX Ukraine 2015<br>
             <?=$svn?><br>
             Powered by Yii <?=Yii::getVersion()?><br>
            <button id = "darkSideBtn" onclick="toTheDarkSide()">
        </div><!-- footer -->
    </div><!-- page -->
    </body>
</html>