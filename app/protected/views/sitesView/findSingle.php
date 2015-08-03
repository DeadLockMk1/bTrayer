<div class = "uc"></div>
<?php
$this->breadcrumbs=array(
    'Sites'=>Yii::app()->request->urlReferrer, $itemsProvider->rawData[0]['id'],
);
$statsUrl = '/UrlsView/statistics?siteid='.$itemsProvider->rawData[0]['id'];
$tabs = array(
    'Site info'=>array(
        'id'=>'view',
        'content'=>$this->renderPartial('_siteFields', array(
            'itemsProvider'=>$itemsProvider,
            'filtersProvider'=>$filtersProvider,
            'propsProvider'=>$propsProvider,
            'limitsProvider'=>$limitsProvider,
            'errorsProvider'=>$errorsProvider,
            'n'=>$n,
        ),TRUE
        ),
    ),
    'Update site info'=>array(
        'id'=>'edit',
        'content'=>$this->renderPartial('_siteFieldsEdit', array(
            'itemsProvider'=>$itemsProvider,
            'filtersProvider'=>$filtersProvider,
            'propsProvider'=>$propsProvider,
            'limitsProvider'=>$limitsProvider,
            'errorsProvider'=>$errorsProvider,
            'scrapingType'=>$scrapingType,
            'descr'=>$descr,
        ),TRUE
        ),
    ),
    'History'=>array(
        'id'=>'history',
        'content'=>$this->renderPartial('_history', array(
            'itemsProvider'=>$itemsProvider,
        ),TRUE
        ),
    ),
    'Statistics'=>array(
        'id'=>'statistics',
        'content'=>$this->renderPartial('_statistics', array(
            'itemsProvider'=>$itemsProvider,
        ),TRUE
        ),
    ),
);
if ((Yii::app()->user->name == 'viewer')) {
    unset($tabs['Update site info']);
}
$this->widget('zii.widgets.jui.CJuiTabs',array(
    'id'=>'TabMenu',
    'tabs'=>$tabs
));
?>