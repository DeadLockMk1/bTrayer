<?php
$this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'itemGrid',
        'summaryText' => '',
        'dataProvider' => $dataProvider,
        'enablePagination' => false,
        'htmlOptions'=>array('class'=>''),
        'columns' => array(
            array(
                'name' => 'nn',
                'header' => '',
                'value' => '$row+1',
                'htmlOptions'=>array('class'=>'lefted'),
            ),
            array(
                'name' => 'URL Md5',
                'value' => '$data["URLMd5"]',
                'htmlOptions'=>array('class'=>'lefted word-wrp'),
            ),
            array(
                'name' => 'Insert',
                'value' => '$data["FIns"]',
                'htmlOptions'=>array('class'=>'righted word-wrp'),
            ),
            array(
                'name' => 'Delete',
                'value' => '$data["FDel"]',
                'htmlOptions'=>array('class'=>'righted word-wrp'),
            ),
            array(
                'name' => 'Update',
                'value' => '$data["FUpd"]',
                'htmlOptions'=>array('class'=>'righted word-wrp'),
            ),
            array(
                'name' => 'Crawled',
                'value' => '$data["FCrawled"]',
                'htmlOptions'=>array('class'=>'righted word-wrp'),
            ),
            array(
                'name' => 'Processed',
                'value' => '$data["FProcessed"]',
                'htmlOptions'=>array('class'=>'righted word-wrp'),
            ),
            array(
                'name' => 'Aged',
                'value' => '$data["FAged"]',
                'htmlOptions'=>array('class'=>'righted word-wrp'),
            ),
            array(
                'name' => 'Deleted',
                'value' => '$data["FDeleted"]',
                'htmlOptions'=>array('class'=>'righted word-wrp'),
            ),
            array(
                'name' => 'Purged',
                'value' => '$data["FPurged"]',
                'htmlOptions'=>array('class'=>'righted word-wrp'),
            ),
            array(
                'name' => 'CDate',
                'value' => '$data["CDate"]',
                'htmlOptions'=>array('class'=>'lefted word-wrp'),
            ),
            array(
                'name' => 'MDate',
                'value' => '$data["MDate"]',
                'htmlOptions'=>array('class'=>'lefted word-wrp hide-switch'),
            ),

        ),
    ));
?>
<?php
$assetsManager = Yii::app()->clientScript;
$assetsManager->registerCoreScript('jquery');
$assetsManager->registerCoreScript('jquery.ui');

// Disable jquery-ui default theme
$assetsManager->scriptMap=array(
    'jquery-ui-bootstrap.css'=>false,
    'jquery-ui.css'=>false,
    'jquery.js'=>false,
);
?>
