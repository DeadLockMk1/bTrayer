<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */

class Controller extends CController
{
//	public function init() {
//		$this->attachBehavior('bootstrap', new BController($this));
//	}
	public function filters()
    {
        return array(
            'accessControl',
        );
    }

	public function accessRules()
    {
	    $baseRules = array(
            array('allow',
            	'actions' => array('login', 'logout', 'registration', 'recovery', 'captcha'),
            )
        );
	    $rules = $this->getAccessRules();
	    $contollerId = Yii::app()->controller->id;
        if (!empty($rules[$contollerId]['extends'])) {
	        $rules[$contollerId] = $rules[$rules[$contollerId]['extends']];
    	}
        if (!empty($rules[$contollerId])) {
            foreach ($rules[$contollerId] as $rule) {
                $baseRules[] = $rule;
            }
        }
        //VarDumper::dump($contollerId);
    	$baseRules[] = array('deny',
            'users' => array('*')
        );
        //VarDumper::dump($baseRules);
        //exit;
        return $baseRules;
    }

    public function getAccessRules() {
		$siteParams = array(
			'site' => array(
		    	'userId' => Yii::app()->request->getParam('uid'),
                'siteId' => Yii::app()->request->getParam('siteId')
		    )
		);

	    $rules = array(
		    'sitesView' => array(
		        array(
			    	'allow',
		            'actions' => array(),
		            'roles' => array('readSite' => $siteParams),
		        ),
		    ),
		    'siteNew' => array(
			    array(
			    	'allow',
		            'actions' => array(),
		            'roles' => array('createSite' => $siteParams),
		        )
		    ),
		    'siteDelete' => array(
			    array(
			    	'allow',
		            'actions' => array(),
		            'roles' => array('deleteSite' => $siteParams),
		        )
		    ),
	        'siteUpdate' => array(
			    array(
			    	'allow',
		            'actions' => array(),
		            'roles' => array('updateSite' => $siteParams),
		        )
		    ),
            'siteRecrawl' => array('extends' => 'siteNew'),
            'siteCleanup' => array('extends' => 'siteDelete'),
            'urlsView' => array('extends' => 'sitesView'),
			'urlUpdate' => array('extends' => 'siteUpdate'),
            'urlRecrawl' => array('extends' => 'siteUpdate'),
            'urlReprocess' => array('extends' => 'siteUpdate'),
            'urlCleanup' => array('extends' => 'siteDelete'),
            'urlDelete' => array('extends' => 'siteDelete'),
            'resourceDownload' => array('extends' => 'sitesView'),
            'ajax' => array('extends' => 'sitesView'),
        );
        return $rules;
    }

    /**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
}