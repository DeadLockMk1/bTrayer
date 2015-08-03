<div class = "uc"></div>
<?php
$historyUrl = '/UrlsView/history?siteid='.$historyParams['siteId'].'&urlMd5='.$historyParams['urlMd5'];
$statsUrl = '/UrlsView/statisticsSingle?siteid='.$historyParams['siteId'].'&urlMd5='.$historyParams['urlMd5'];
$tabs = array(
    'Resource info'=>array(
        'id'=>'view',
        'content'=>$this->renderPartial('_singleView', array(
            'itemsProvider' => $itemsProviderHl,
            'limitsProvider' => $limitsProvider,
            'errorsProvider' => $errorsProvider,
            'tagsProvider' => $tagsProvider,
            'params' => $params
        ),TRUE
        )
    ),
    'Edit'=>array(
        'id'=>'edit',
        'content'=>$this->renderPartial('_singleEdit', array(
            'itemsProvider' => $itemsProvider,
            'limitsProvider' => $limitsProvider,
            'descr' => $descr,
        ),TRUE
        )
    ),
    'Content'=>array(
        'id'=>'contents',
        'content'=>$this->renderPartial('_singleContent', array(
            'p' => $contentParams,
        ),TRUE
        )
    ),
    'History'=>array(
        'ajax' => $historyUrl,
        'id'=>'history',
    ),
    'Statistic'=>array(
        'ajax' => $statsUrl,
        'id'=>'statistic',
    ),
);
if ((Yii::app()->user->name == 'viewer')) {
    unset($tabs['Edit']);
}
$this->widget('zii.widgets.jui.CJuiTabs',array(
    'options'=>array(
        'collapsible'=>false,
    ),
    'id'=>'TabMenu',
    'tabs'=>$tabs
));
?>
<script type="text/javascript">
//    $("#ui-id-8").click(function () {
        $('#ui-id-9').html("<div class='loader-overlay'><div class='loader'>Loading...</div></div>");
//    });
</script>
