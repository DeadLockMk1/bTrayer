<?php

class SitesViewController extends Controller
{
    public $log;

    public function actionIndex(){
        $this->pageTitle = 'Find sites';
        Logger::log('');
        $userId = Yii::app()->user->id;
        $data = array();
        $command = new SitesView;
        $command->dccCheck($userId);
        $this->log = Logger::getTrace();
        $command->rmTmpData();
        $this->render('index', array(
            'dataProvider' => $data,
            'log' => $this->log
        ));
    }

    public function actionFind($uid, $limit, $state, $pattern, $pN, $sortBy, $sortDirection)
    {
        $this->pageTitle = 'Find sites';
        $command = new SitesView;
        $userId = Yii::app()->user->id;
        $command->createRequest($pattern, $state, $limit, $uid, $pN, $sortBy, $sortDirection);
        $data = $command->findSite($userId, false);
        if ($data['manError']['isError'] == true) {
            Yii::app()->user->setFlash('error', 'Search ERROR: ' . $data['manError']['errorBody']);
            $this->redirect('/');
        }
        unset ($data['manError']);
        Yii::app()->user->setFlash('success', 'Search: SUCCESS');
        $itemsProvider = new CArrayDataProvider($data, array(
            'pagination' => array(
                'pageSize' => $limit
            )
        ));
        $this->log = Logger::getTrace();
        $command->rmTmpData();
        $this->render('find', array(
            'itemsProvider' => $itemsProvider,
            'log' => $this->log,
            'pattern' => $pattern,
            'uid' => $uid,
            'limit' => $limit,
            'page' => $pN,
            'state' => $state,
            'sortBy' => $sortBy,
            'sortDirection' => $sortDirection
        ));
    }

    public function actionFindSingle($siteId, $n = 0)
    {
        $this->pageTitle = 'Site - ' . $siteId;
        $data = array();
        $command = new SitesView;
        $userId = Yii::app()->user->id;
        $reqFile = $command->createRequestSingle($userId, $siteId);
        $itemsProvider = $command->findSite($userId, $reqFile, $n);
        $resFile = $command->responseFile;
        $filtersProvider = $command->getFilters($userId, $resFile, $n);
        $propsProvider = $command->getProperties($userId, $resFile, $n);
        $limitsProvider = $command->getLimits($userId, $resFile, $n);
        $errorsProvider = $command->getErrorsTypes($userId, $resFile, $n);
        $this->log = Logger::getTrace();
        Yii::app()->user->setFlash('success', 'View: SUCCESS');
        $dict = new Dictionary;
        $descriptions = $dict->getDescriptions();
        $command->rmTmpData();
        unset($dict);
        unset($command);
        $this->render('findSingle', array(
            'itemsProvider' => $itemsProvider,
            'filtersProvider' => $filtersProvider,
            'propsProvider' => $propsProvider['provider'],
            'scrapingType' => $propsProvider['scrapingType'],
            'limitsProvider' => $limitsProvider,
            'errorsProvider' => $errorsProvider,
            'descr'=>$descriptions['SITES'],
            'n' => $n,
            'log' => print_r($this->log, true)
        ));
    }
    public function actionIntegrityCheckRequest()
    {
        $siteId = Yii::app()->request->getParam('id');
        $command = new SitesView();
        $res = $command->integrityCheck($siteId);
        if (isset($res['code']) && $res['code'] == 0) {
            $this->renderPartial('__integrityCheckOk');
        } else {
            $this->renderPartial('__integrityCheckFail', array(
                'itemsProvider' => new CArrayDataProvider($res, array(
                    'keyField' => 'Sites',
                    'pagination' => false
                )),
                'id' => $siteId
            ));
        }
    }
    public function actionIntegrityCheck()
    {
        $this->renderPartial('__integrityCheckModal', array(
            'id' => Yii::app()->request->getParam('id')
        ));
    }
    public function actionIntegrityFix()
    {
        $command = new SiteUpdate();
        $command->updateSiteInfo(null, 0);
        return true;
    }
    public function actionGetTProps() {
        $command = new SiteNew;
        $propsArr = CJSON::encode($command->getTProps());
        echo $propsArr;
    }
    public function actionHistory() {
        $command = new UrlsView;
        $historyData = $command->getHistory(true);
        $this->renderPartial('//urlsView/_singleHistory', array(
                'historyData' =>$historyData
            ), false, true
        );
    }
    public function actionStatistics() {
        $command = new UrlsView;
        $statsData = $command->getStatistics(true);
        $this->renderPartial('//urlsView/_singleStatistics', array(
                'historyData' =>$statsData,
                'single' =>false,
            ), false, true
        );
    }
}
