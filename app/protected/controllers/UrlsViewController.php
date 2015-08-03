<?php

class UrlsViewController extends Controller
{
    public $log;

    public function actionIndex()
    {
        $this->pageTitle = 'Resources';
        Logger::log('');
        $data = array();
        $this->log = Logger::getTrace();
        $this->render('index', array(
            'dataProvider' => $data,
            'log' => $this->log,
        ));
    }

    public function actionFind()
    {
        $this->pageTitle = 'Resources';
        $request = Yii::app()->request;
        $params = $request->getParam('form');
        if (!isset($params['page']))
            $params['page'] = '1';
        $command = new UrlsView;
        $userId = Yii::app()->user->id;
        $data = $command->fetch($userId, $params);
        if ($data['manError']['isError'] == true) {
            Yii::app()->user->setFlash('error', 'Search ERROR: ' . $data['manError']['errorBody']);
            $this->redirect('/UrlsView/index');
        }
        unset($data['manError']);
        Yii::app()->user->setFlash('success', 'Search: SUCCESS');
        $sort = new CSort;

        $sort->defaultOrder = 'urlMd5 DESC';
        $sort->attributes = array('urlMd5');

        $itemsProvider = new CArrayDataProvider($data, array(
            'keyField' => 'CDate',
            'pagination' => false,
//            'sort' => $sort
        ));
        $this->log = Logger::getTrace();
        $this->render('find', array(
            'itemsProvider' => $itemsProvider,
            'params' => $params
        ));
    }

    public function actionFindSingle()
    {
        $request = Yii::app()->request;
        $params = $request->getParam('urlId');
        $command = new UrlsView;
        $userId = Yii::app()->user->id;
        $data = $command->fetch($userId, $params, true);
        if ($data['manError']['isError'] == true) {
            Yii::app()->user->setFlash('error', 'View ERROR: ' . $data['manError']['errorBody']);
            $this->redirect('/UrlsView/index');
        }
        unset($data['manError']);
        $this->pageTitle = 'Resource - ' . $data[0][0]['urlMd5'];
        Yii::app()->user->setFlash('success', 'View: SUCCESS');
        $itemsProvider = new CArrayDataProvider($data[0], array(
            'keyField' => 'tcDate',
            'pagination' => array(
                'pageSize' => 1
            )
        ));
        $itemsProviderHl = new CArrayDataProvider($data[1], array(
            'keyField' => 'tcDate',
            'pagination' => array(
                'pageSize' => 1
            )
        ));
        $limitsProvider = $command->getLimits($userId);
        $errorsProvider = $command->getErrorsTypes($userId);
        $tagsProvider = $command->getTagsTypes($userId);
        $contentParams = $command->getContentParams($data[0][0]);
        $historyParams = $command->getHistoryParams($data[0][0]);
        $this->log = Logger::getTrace();
        unset($command);
        $dict = new Dictionary;
        $descriptions = $dict->getDescriptions();
        $this->render('single', array(
            'itemsProvider' => $itemsProvider,
            'itemsProviderHl' => $itemsProviderHl,
            'limitsProvider' => $limitsProvider,
            'errorsProvider' => $errorsProvider,
            'tagsProvider' => $tagsProvider,
            'params' => $params,
            'contentParams' => $contentParams,
            'historyParams' => $historyParams,
            'descr' => $descriptions['URLS'],
        ));
    }

    public function actionContent()
    {
        $userId = Yii::app()->user->id;
        $contents = UrlsView::getContents($userId);
        if ($contents['type'] == 'raw') {
            $this->renderPartial('__contentRaw', array(
                    'data' => $contents['contents']
                )
            );
        } elseif ($contents['type'] == 'processed') {
            $this->renderPartial('__contentProcessed', array(
                    'data' => $contents['contents'],
//                    'dataProvider' => new CArrayDataProvider($contents['contents'], array(
//                            'keyField' => 'name'
//                        )
//                    )
                )
            );
        } elseif ($contents['type'] == 'headers') {
            $this->renderPartial('__contentRaw', array(
                    'data' => $contents['contents'],
//                    'dataProvider' => new CArrayDataProvider($contents['contents'], array(
//                            'keyField' => 'name'
//                        )
//                    )
                )
            );
        }
    }
    public function actionHistory()
    {
        $command = new UrlsView;
        $historyData = $command->getHistory(false);
        $this->renderPartial('_singleHistory', array(
                'historyData' =>$historyData
            ), false, true
        );
    }
    public function actionStatisticsSingle()
    {
        $command = new UrlsView;
        $statsData = $command->getStatistics(false);
        $this->renderPartial('_singleStatistics', array(
                'historyData' =>$statsData,
                'single'=>true,
            ), false, true
        );
    }
    public function actionStatistics()
    {
        $command = new UrlsView;
        $statsData = $command->getStatistics(false);
        $this->renderPartial('_singleStatistics', array(
                'historyData' =>$statsData,
                'single'=>false,
            ), false, true
        );
    }
//    public function processOutput($output)
//    {
//        return $output;
//    }
}