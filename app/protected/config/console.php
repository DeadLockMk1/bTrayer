<?php
// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	'import'=>array(
        'application.modules.*',
        'application.commands.*',
        'application.extensions.*',
        'application.modules.user.models.*',
        'application.modules.job.models.*',
	),

    'modules'=>array(
        'user' => array(),
        'job' => array()
    ),

	'commandMap' => array(
		'job' => 'application.modules.job.commands.JobCommand'      
	),

	// application components
	'components'=>array(
		'jobManager' => array(
            'class' => 'application.modules.job.components.JobManager',
            'jobs' => array(
                array(
                    'class' => 'DeleteUserTempJob',
                    'crontab' => '* */2 * * *',
                    'limit' => 10
                ),
            )
        ),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=dc_management',
            'tablePrefix' => '',
            'emulatePrepare' => true,
            'username' => 'hce',
            'password' => 'hce12345',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);