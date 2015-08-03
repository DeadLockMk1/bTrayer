<?php
/* @var $this SitesViewController */

$this->breadcrumbs=array(
    'Resources',
);
echo CHtml::tag('div', array(
        'class'=>'gr-r-form-btn',
        'onClick'=>'toggleUrlsForm()'
    ),
    'Extended resources search');
$this->renderPartial('_form', array(
            'siteId'=>      (!isset($params['siteId'])) ? '' : $params['siteId'],
            'status'=>      (!isset($params['status'])) ? '' : $params['status'],
            'resourceURL'=> (!isset($params['resourceURL'])) ? '' : $params['resourceURL'],
            'resourceId'=>  (!isset($params['resourceId'])) ? '' : $params['resourceId'],
            'contentType'=> (!isset($params['contentType'])) ? '' : $params['contentType'],
            'tcDateFrom'=>  (!isset($params['tcDateFrom'])) ? '' : $params['tcDateFrom'],
            'tcDateTo'=>    (!isset($params['tcDateTo'])) ? '' : $params['tcDateTo'],
            'tcTimeFrom'=>  (!isset($params['tcTimeFrom'])) ? '' : $params['tcTimeFrom'],
            'tcTimeTo'=>    (!isset($params['tcTimeTo'])) ? '' : $params['tcTimeTo'],
            'limit'=>       (!isset($params['limit'])) ? '10' : $params['limit'],
            'httpCode'=>    (!isset($params['httpCode'])) ? '' : $params['httpCode'],
            'state'=>       (!isset($params['state'])) ? '' : $params['state'],
            'depthFrom'=>   (!isset($params['depthFrom'])) ? '' : $params['depthFrom'],
            'depthTo'=>     (!isset($params['depthTo'])) ? '' : $params['depthTo'],
            'type'=>        (!isset($params['type'])) ? '' : $params['type'],
            'cDateFrom'=>   (!isset($params['tcDateFrom'])) ? '' : $params['cDateFrom'],
            'cDateTo'=>     (!isset($params['tcDateTo'])) ? '' : $params['cDateTo'],
            'cTimeFrom'=>   (!isset($params['tcTimeFrom'])) ? '' : $params['cTimeFrom'],
            'cTimeTo'=>     (!isset($params['tcTimeTo'])) ? '' : $params['cTimeTo'],
            'pDateFrom'=>   (!isset($params['tcDateFrom'])) ? '' : $params['pDateFrom'],
            'pDateTo'=>     (!isset($params['tcDateTo'])) ? '' : $params['pDateTo'],
            'pTimeFrom'=>   (!isset($params['tcTimeFrom'])) ? '' : $params['pTimeFrom'],
            'pTimeTo'=>     (!isset($params['tcTimeTo'])) ? '' : $params['pTimeTo'],
            'parentUrl'=>   (!isset($params['parentUrl'])) ? '' : $params['parentUrl'],
            'errorMask'=>   (!isset($params['errorMask'])) ? '' : $params['errorMask'],
            'onlyRoot'=>    (!isset($params['onlyRoot'])) ? false : $params['onlyRoot'],
            'tagsMask'=>    (!isset($params['tagsMask'])) ? '' : $params['tagsMask'],
            'tagsCount'=>   (!isset($params['tagsCount'])) ? '' : $params['tagsCount'],
            'sortBy'=>      (!isset($params['sortBy'])) ? 'UDate' : $params['sortBy'],
            'sortDirection'=>   (!isset($params['sortDirection'])) ? 'DESC' : $params['sortDirection'],
            'page'=>        (!isset($params['page'])) ? '1' : $params['pN'],
            'hidden'=>'hidden',
            'position'=>'pos-abs',
            'btn'=>'',
            )
        );
        if ($params['pN'] != '0') {
            echo CHtml::tag('div', array(
                'class' => 'filter_form_pagination',
            ));
            if (isset($itemsProvider->rawData[0])) {
                echo CHtml::tag('div', array(
                    'class' => 'next_page',
                    'id' => 'NextPageURLsButton'
                ),
                    CHtml::encode('MORE>>')
                );
            }

            if ($params['pN'] != '1') {
                echo CHtml::tag('div', array(
                    'class' => 'prev_page',
                    'id' => 'PrevPageURLsButton'
                ),
                    CHtml::encode('<<BACK')
                );
            }
            echo CHtml::closeTag('div');
        }
$dates = '\'
<div class = "slideList">
    <table class="url-dates">
        <tr class = "even">
            <td class = "lefted">Creation date</td>
            <td>\'.$data["CDate"].\'</td>
        </tr>
        <tr class = "odd">
            <td class = "lefted">Touch date</td>
            <td>\'.$data["tcDate"].\'</td>
        </tr>
        <tr class = "even">
            <td class = "lefted">Update date</td>
            <td>\'.$data["UDate"].\'</td>
        </tr>
        <tr class = "odd">
            <td class = "lefted">Last modified</td>
            <td>\'.$data["lastModified"].\'</td>
        </tr>
        <tr class = "even">
            <td class = "lefted">Publication date</td>
            <td>\'.$data["pDate"].\'</td>
        </tr>
    </table>
</div>\'';
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',  
    'summaryText' => '',
    'dataProvider' => $itemsProvider,  
    'enablePagination' => true, 
    'htmlOptions'=>array('class'=>'gr-s-sl-main'),
    'emptyText' => '<img src="/images/oops.png"><h4>Oops! Nothing found... Please, try again!</h4>',
    'columns' => array(
        array(
            'name' => 'nn',
            'header' => '#',
            'value' => '$row+1',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(
            'name' => 'Id',
            'value' => '"<a href=\"/UrlsView/findSingle?urlId=".$data["urlMd5"]."\">".$data["urlMd5"]."</a>"',
            'type'=>'raw',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'URL',
            'value' => '"<a class = \"ext\" target = \"_blank\" href = \"{$data["url"]}\">{$data["url"]}</a>"',
            'type' => 'raw',
            'htmlOptions'=>array('class'=>'lefted word-wrp'),
        ),
        array(  
            'name' => 'Status',
            'value' => '$data["status_str"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Crawled',
            'value' => '$data["crawled"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Processed',
            'value' => '$data["processed"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Error mask',
            'value' => '$data["errorMask"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Size',
            'value' => '$data["size"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(
            'name' => 'Total time',
            'value' => '$data["totalTime"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(
            'name' => 'Tags count',
            'value' => '$data["tagsCount"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(
            'name' => 'Tags mask',
            'value' => '$data["tagsMask"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(
            'name' => 'Dates',
            'value' => $dates,
            'htmlOptions'=>array('class'=>'centred hide-switch'),
            'type' => 'raw',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'<div class = "bttn-block">{View}{Cleanup}{recrawl}{reprocess}{Download}{Delete}</div>',
            'htmlOptions' => array('class'=>'bttn-clmn'),
            'buttons'=>array(
                'View' => array(
                    'label'=>'V',
                    'url'=> 'Yii::app()->createUrl("UrlsView/findSingle?urlId=".$data["urlMd5"])',
                    'options'=>array(
                        'class'=>'act-btn',
                        'title'=>'View/Edit',
                        'target'=>'_blank',
                    ),
                ),
                'Cleanup' => array(
                    'label'=>'C',
                    'url'=>'Yii::app()->createUrl("UrlCleanup/index", array(
                        "siteId"=>$data["siteId"],
                        "url"=>$data["url"],
                        "urlType"=>$data["type"],
                        ))',
                    'options'=>array(
                        'class'=>'act-btn',
                        'title'=>'Cleanup',
                        'ajax' => array(
                            'type' => 'post', 
                            'url'=>'js:$(this).attr("href")', 
                            'success' => 'js:function(data) {
                                    $("#cleanup-dialog").remove();
                                    $("body").append(data);
                                }',
                            'error' => 'js:function(data) {
                                    console.log(data);
                                    if (data.status == 403) {
                                        alert("You have no permissions to perform this action!");
                                    }
                                }'
                        ),
                    ),
                ),
                'recrawl' => array(
                    'label'=>'Rc',
                    'url'=>'Yii::app()->createUrl("UrlRecrawl/index", array(
                        "siteId"=>$data["siteId"],
                        "url"=>$data["url"],
                        "urlType"=>$data["type"],
                        ))',
                    'options'=>array(
                        'class'=>'act-btn',
                        'title'=>'Re-crawl',
                        'ajax' => array(
                            'type' => 'post', 
                            'url'=>'js:$(this).attr("href")', 
                            'success' => 'js:function(data) {
                                    $("#recrawl-dialog").remove();
                                    $("body").append(data);
                                }',
                            'error' => 'js:function(data) {
                                    console.log(data);
                                    if (data.status == 403) {
                                        alert("You have no permissions to perform this action!");
                                    }
                                }'
                            ),
                        ),
                    ),
                'reprocess' => array(
                    'label'=>'Rp',
                    'url'=>'Yii::app()->createUrl("UrlReprocess/index", array(
                        "siteId"=>$data["siteId"],
                        "urlMd5"=>$data["urlMd5"],
                        ))',
                    'options'=>array(
                        'class'=>'act-btn',
                        'title'=>'Re-process',
                        'ajax' => array(
                            'type' => 'post', 
                            'url'=>'js:$(this).attr("href")', 
                            'success' => 'js:function(data) {
                                    $("#recrawl-dialog").remove();
                                    $("body").append(data);
                                }',
                            'error' => 'js:function(data) {
                                    console.log(data);
                                    if (data.status == 403) {
                                        alert("You have no permissions to perform this action!");
                                    }
                                }'
                            ),
                        ),
                    ),
                'Download' => array(
                    'label'=>'Dw',
                    'url'=>'Yii::app()->createUrl("ResourceDownload/index", array(
                        "siteId"=>$data["siteId"],
                        "url"=>$data["url"],
                        "urlMd5"=>$data["urlMd5"],
                    ))',
                    'options'=>array(
                        'class'=>'act-btn',
                        'title'=>'Download',
                        'ajax' => array(
                            'type' => 'post', 
                            'url'=>'js:$(this).attr("href")', 
                            'success' => 'js:function(data) {
                                    $("#dw-dialog").remove();
                                    $("body").append(data);
                                }'
                            ),
                        ),
                    ),
                'Delete' => array(
                    'label'=>'D',
                    'url'=>'Yii::app()->createUrl("UrlDelete/index", array(
                        "siteId"=>$data["siteId"],
                        "urlMd5"=>$data["urlMd5"],
                        "urlType"=>$data["type"],
                    ))',
                    'options'=>array(
                        'class'=>'act-btn',
                        'title'=>'Delete',
                        'ajax' => array(
                            'type' => 'post',
                            'url'=>'js:$(this).attr("href")',
                            'success' => 'js:function(data) {
                                    $("#delete-dialog").remove();
                                    $("body").append(data);
                                }',
                            'error' => 'js:function(data) {
                                    console.log(data);
                                    if (data.status == 403) {
                                        alert("You have no permissions to perform this action!");
                                    }
                                }'
                            ),
                        ),
                    ),
                ),
            ),
        ),  
    )
);
 
