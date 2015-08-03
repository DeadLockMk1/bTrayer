<?php
class TagsReaperUIModule extends CWebModule
{
	private $cache = false;
	private $_assetsUrl;

	public $session = array(
		'timeout' => '-24 hour',
		'password' => '',
		'glue' => '|',
        'api' => array(
            'token' => 'qRs5RgNbzRAJts00BNpFeLLVNEtFxwFOMRX5deLrMptcb9bgdRqS3TXcm3vaEFRA'
        )
	);

	public function init()
	{
		$this->defaultController = 'TagsReaperUI';
		
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'TagsReaperUI.models.*',
			'TagsReaperUI.models.TagsReaperUISession.*',
            'TagsReaperUI.models.Demo.*',
			'TagsReaperUI.models.Batch.*',
            'TagsReaperUI.models.Command.*',
            'TagsReaperUI.models.Command.Error.*',
            'TagsReaperUI.components.*',
			'TagsReaperUI.controllers.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

	/**
     * Registers the necessary scripts.
     */
    public function registerScripts()
    {
    	// Get the url to the module assets
    	$assetsUrl = $this->getAssetsUrl();

    	// Register the necessary scripts
    	$cs = Yii::app()->getClientScript();
    	$cs->registerScriptFile($assetsUrl . '/js/tryIt.js');
        $cs->registerCssFile($assetsUrl . '/css/style.css');

        $cs->registerCssFile($assetsUrl . '/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css');
        $cs->registerCssFile($assetsUrl . '/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css');
        $cs->registerScriptFile($assetsUrl . '/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js');

//        $cs->registerCssFile($assetsUrl . '/js/plugins/bootstrap/css/bootstrap.min.css');
//        $cs->registerScriptFile($assetsUrl . '/js/plugins/bootstrap/js/bootstrap.min.js');

        $cs->registerCssFile($assetsUrl . '/js/plugins/jstree/themes/default/style.min.css');
        $cs->registerScriptFile($assetsUrl . '/js/plugins/jstree/jstree.js');

        $cs->registerScriptFile($assetsUrl . '/js/plugins/chained/chained.min.js');

        $cs->registerScriptFile($assetsUrl . '/js/plugins/typeahead/typeahead.min.js');
        $cs->registerCssFile($assetsUrl . '/js/plugins/typeahead/typeahead.css');

        $cs->registerScriptFile($assetsUrl . '/js/plugins/format/jquery.format.js');

        
//        $cs->registerScriptFile($assetsUrl . '/js/plugins/cookie/jquery.cookie.js');
        //$cs->registerScriptFile($assetsUrl . '/js/plugins/unserialize/unserialize.jquery.latest.js');
        //$cs->registerScriptFile($assetsUrl . '/js/plugins/sisyphus/sisyphus.js');
//        $cs->registerScriptFile($assetsUrl . '/js/plugins/jQuery-Storage-API/jquery.storageapi.js');

        //$cs->registerScriptFile($assetsUrl . '/js/plugins/xpathrefine/xpathrefine.js');
        //$cs->registerScriptFile($assetsUrl . '/js/plugins/xpathrefine/xpath_tool_injection.js');

        //$cs->registerCssFile($assetsUrl . '/css/log.css');

        $cssAlaskaNames = array(
            'font-awesome.min',
            'jquery.flipcountdown',
            'jquery-ui',
            //'bootstrap.min',
            'owl.carousel',
            'easy-responsive-tabs',
            'jquery.circliful',
            'cubeportfolio.min',
            'megamenu',
            'styles',
            'custom',
            'custom2'

            /*//'bootstrap.min',
            //'bootstrap-theme',
            'cubeportfolio.min',
            'custom',
            'easy-responsive-tabs',
            'font-awesome.min',
            'jquery.circliful',
            'jquery.flipcountdown',
            'jquery-ui',
            'megamenu',
            //'old_styles',
            'owl.carousel',
            'responsive-tabs',
            'styles',
            'custom2',*/
        );
//        foreach ($cssAlaskaNames as $cssAlaskaName) {
//            $cs->registerCssFile($assetsUrl . '/css/alaska/css/' . $cssAlaskaName . '.css');
//        }
    }

    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null) {
            $assetsPath = Yii::getPathOfAlias('TagsReaperUI.assets');

            if ($this->cache === false) {
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath, false, -1, true);
            } else {
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath);
            }
        }

        return $this->_assetsUrl;
    }
}
