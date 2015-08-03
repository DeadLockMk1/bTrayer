<?php
class UsersSitesRightsController extends RController
{
    /**
     * @property RAuthorizer
     */
    private $_authorizer;

    /**
     * Initializes the controller.
     */
    public function init()
    {
        $this->_authorizer = $this->module->getAuthorizer();
        $this->layout = $this->module->layout;
        $this->defaultAction = 'index';

        // Register the scripts
        $this->module->registerScripts();
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array('accessControl');
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // Allow superusers to access Rights
                'actions' => array(
                    'index', 'search', 'update', 'edit', 'editOperationsFields',
                ),
                'users' => $this->_authorizer->getSuperusers(),
            ),
            array('deny', // Deny all users
                'users' => array('*'),
            ),
        );
    }

    public $log;

    /**
     * Sites rights page default.
     */
    public function actionIndex()
    {
        Logger::log('');
        $data = array();
        $model = new SitesView();
        $this->log = Logger::getTrace();
        $this->render('index', array('dataProvider' => $data,
            'log' => $this->log,
        ));
    }

    /**
     * Sites rights page after find.
     */
    public function actionSearch($pattern, $siteId, $searchUserId, $rights, $pageSize, $currentPage = 0)
    {
        $userId = Yii::app()->user->id;
        $model = new UsersSitesRights();

        $params = $model->buildFindParams(compact(
            'userId',
            'pattern',
            'siteId',
            'searchUserId',
            'limit',
            'currentPage',
            'pageSize'
        ));

        $model->createRequest($params);
        $sites = $model->search($params);
        $itemsProvider = new CArrayDataProvider($sites, array(
            'pagination' => array(
                'pageSize' => $pageSize,
            ),
        ));

        $pages = new CPagination(1000000000);
        $pages->pageVar = 'currentPage';

        $this->log = Logger::getTrace();
        $this->render('search', array(
            'model' => $model,
            'sites' => $model->encode($sites),
            'itemsProvider' => $itemsProvider,
            'pages' => $pages,
            'currentPage' => $currentPage,
            'pageSize' => $pageSize,
            'log' => $this->log,
        ));
    }

    /**
     * Update sites rights data.
     */
    public function actionUpdate()
    {
        $sites = Yii::app()->request->getPost('sites');
        $rights = Yii::app()->request->getPost('Rights');

        $model = new UsersSitesRights();
        $model->setRightsAllRecords($model->decode($sites), $rights);

        Yii::app()->user->setFlash($this->module->flashSuccessKey, 'Update success');
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * Editor for user site rights.
     *
     * @param string $siteId
     * @param string $userId
     */
    public function actionEdit($siteId, $userId)
    {
        $model = new UsersSitesRights();
        $site = $model->findByAttributes(array(
            'Site_Id' => $siteId, 'User_Id' => $userId,
        ));
        if (empty($site)) {
            $site = compact('siteId', 'userId');
        }
        $this->render('edit', array(
            'siteId' => $siteId,
            'userId' => $userId,
            'site' => $site,
            'model' => $model,
            'sites' => $model->encode(array($site)),
        ));
    }

    /**
     * Editor for operations fields.
     */
    public function actionEditOperationsFields()
    {
        $model = new UsersSitesRights();
        if (Yii::app()->request->isPostRequest) {
            $rightsList = Yii::app()->getRequest()->getPost('RightsList');
            $model->setRightsList($rightsList);
        }
        $rightsList = $model->getRightsList();
        $this->render('editOperationsFields', compact('model', 'rightsList'));
    }
}
