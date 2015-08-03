<?php
$this->breadcrumbs=array(
    'Resources'=>Yii::app()->request->urlReferrer,
    $itemsProvider->rawData[0]['urlMd5'],
);
//                                                                                      Status
echo CHtml::tag('div', array(
        'class'=>'gr-s-fv-nameTag'
    ),
    '<b>Stats</b>');
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',  
    'summaryText' => '',
    'dataProvider' => $itemsProvider,  
    'enablePagination' => true, 
    'htmlOptions'=>array('class'=>'gr-r-fv-statsLeft'), 
    'columns' => array( 
        array(  
            'name' => 'SITE ID: <a target="_blank" href="/SitesView/findSingle?siteId='.$itemsProvider->rawData[0]['siteId'].'">'.$itemsProvider->rawData[0]['siteId'].'</a>',
            'type'=>'raw',
            'value' => '"URL: "."<a target = \"_blank\" href = \"{$data["url"]}\">{$data["url"]}</a>"',
            'htmlOptions'=>array('class'=>'centred word-wrp'),
        ),
    ),
));
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $itemsProvider,
    'htmlOptions'=>array('class'=>'gr-r-fv-statsRight'),
    'columns' => array( 
        array(  
            'name' => 'State',  
            'type'=>'html',
            'value' => '$data["state_str"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Status',  
            'type'=>'html',
            'value' => '$data["status_str"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Type',  
            'type'=>'html',
            'value' => '$data["type"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Batch ID',  
            'type'=>'html',
            'value' => '$data["batchId"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Charset',  
            'type'=>'html',
            'value' => '$data["charset"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Content type',  
            'type'=>'html',
            'value' => '$data["contentType"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Depth',  
            'type'=>'html',
            'value' => '$data["depth"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'eTag',  
            'type'=>'html',
            'value' => '$data["eTag"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'HTTP Code',  
            'type'=>'html',
            'value' => '$data["httpCode"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'HTTP method',  
            'type'=>'html',
            'value' => '$data["httpMethod"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Site select',  
            'type'=>'html',
            'value' => '$data["siteSelect"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Crawled',  
            'type'=>'html',
            'value' => '$data["crawled"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Processed',  
            'type'=>'html',
            'value' => '$data["processed"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
    )
));
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $limitsProvider,
    'htmlOptions'=>array('class'=>'gr-r-fv-limits'),
    'columns' => array(   
        array(  
            'name' => 'Limits',  
            'value' => '$data["limit_name"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(
            'name' => '',
            'value' => '$data["limit_value"]',
            'htmlOptions'=>array('class'=>'righted'),
        )
    )  
));
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $errorsProvider,
    'htmlOptions'=>array('class'=>'gr-r-fv-errors'),
    'emptyText' => '<h5>No errors!</h5>',
    'columns' => array( 
        array(
            'name' => 'Error types',  
            'value' => '$data["errorType"]'  
        ),
    ),
));
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $tagsProvider,
    'htmlOptions'=>array('class'=>'gr-r-fv-tags'),
    'emptyText' => '<h5>No tags...</h5>',
    'columns' => array( 
        array(
            'name' => 'Tags',  
            'value' => '$data["tag"]',
            'htmlOptions'=>array('class'=>'centred'),
        ),
    ),
));
//                                                                                      Dates
echo CHtml::tag('div', array(
        'class'=>'gr-s-fv-nameTag'
    ),
    '<b>Dates</b>');
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $itemsProvider,
    'htmlOptions'=>array('class'=>'gr-s-fv-dates'),
    'columns' => array( 
        array(  
            'name' => 'Creation date',  
            'type'=>'html',
            'value' => '$data["CDate"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Publication date',  
            'type'=>'html',
            'value' => '$data["pDate"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Update date',  
            'type'=>'html',
            'value' => '$data["UDate"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Touch date',  
            'type'=>'html',
            'value' => '$data["tcDate"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Last modified',  
            'type'=>'html',
            'value' => '$data["lastModified"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
    )
));
//                                                                                      MD5
echo CHtml::tag('div', array(
        'class'=>'gr-s-fv-nameTag'
    ),
    '<b>MD5</b>');
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $itemsProvider,
    'htmlOptions'=>array('class'=>'gr-s-fv-dates'),
    'columns' => array( 
        array(  
            'name' => 'URL md5',  
            'type'=>'html',
            'value' => '$data["urlMd5"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Raw content md5',  
            'type'=>'html',
            'value' => '$data["rawContentMd5"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Content md5',  
            'type'=>'html',
            'value' => '$data["contentURLMd5"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Parent md5',  
            'type'=>'html',
            'value' => '$data["parentMd5"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
    )
));
//                                                                                      Counters
echo CHtml::tag('div', array(
        'class'=>'gr-s-fv-nameTag'
    ),
    '<b>Counters</b>');
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $itemsProvider,
    'htmlOptions'=>array('class'=>'gr-s-fv-dates'),
    'columns' => array( 
        array(  
            'name' => 'Internal links',  
            'type'=>'html',
            'value' => '$data["linksI"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'External links',  
            'type'=>'html',
            'value' => '$data["linksE"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Mutuability rate',  
            'type'=>'html',
            'value' => '$data["mRate"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Mutuability rate counter',  
            'type'=>'html',
            'value' => '$data["mRateCounter"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Tags count',  
            'type'=>'html',
            'value' => '$data["tagsCount"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Frequency',  
            'type'=>'html',
            'value' => '$data["freq"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Crawling time',  
            'type'=>'html',
            'value' => '$data["crawlingTime"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Processing time',  
            'type'=>'html',
            'value' => '$data["processingTime"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Total time',  
            'type'=>'html',
            'value' => '$data["totalTime"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Size',  
            'type'=>'html',
            'value' => '$data["size"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
    )
));
?>