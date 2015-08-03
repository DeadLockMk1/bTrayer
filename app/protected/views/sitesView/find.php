<?php
/* @var $this SitesViewController */


$this->breadcrumbs=array(
    'Sites',
);
$this->renderPartial('_filterForm', array(
        'pattern'=>$pattern,
        'uid'=>$uid,
        'limit'=>$limit,
        'page'=>$page,
        'state'=>$state,
        'sortBy'=>$sortBy,
        'sortDirection'=>$sortDirection,
        'isResult'=>isset($itemsProvider->rawData[0])
    )
);
$emptyText = '<img src="/images/oops.png"><h4>Oops! No sites found...</h4><p> Please, check request parameters'
//    .' or '
//    .CHtml::link('add new site', '/SiteNew/index', array(
//    'class'=>''
//    ))
    .'.</p>';
$dates = '\'
<div class = "slideList">
    <table class="url-dates">
        <tr class = "even">
            <td class = "lefted">Creation date</td>
            <td>\'.$data["recrawlDate"].\'</td>
        </tr>
        <tr class = "odd">
            <td class = "lefted">Touch date</td>
            <td>\'.$data["tcDate"].\'</td>
        </tr>
        <tr class = "even">
            <td class = "lefted">Update date</td>
            <td>\'.$data["uDate"].\'</td>
        </tr>
        <tr class = "odd">
            <td class = "lefted">Re-crawl date</td>
            <td>\'.$data["recrawlDate"].\'</td>
        </tr>
    </table>
</div>\'';
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'itemGrid',
    'summaryText' => '',
    'dataProvider' => $itemsProvider,
    'enablePagination' => true,
    'htmlOptions'=>array('class'=>'gr-s-sl-main'),
    'emptyText' => $emptyText,
    'columns' => array(
        array(
            'name' => 'nn',
            'header' => '#',
            'value' => '$row+1',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Site ID',  
            'value' => '"<a href=\"/SitesView/findSingle?siteId=".$data["id"]."\">".$data["id"]."</a>"',
            'type'=>'raw',
            'sortable' => true,
            'filter' => false,
            'htmlOptions' => array('class'=>'lefted'),
        ),  
        array(  
            'name' => 'Description',  
            'value' => '$data["description"]',  
            'sortable' => true,  
            'filter' => false,
            'htmlOptions' => array('class'=>'lefted'),
        ),  
        array(  
            'name' => 'Root URLs',
            'type' => 'raw',
            'value' => '"<div class=\"slideList\">".$data["urls_act"]."</div>"',
            'htmlOptions' => array('class'=>'lefted hide-switch', 'data-title'=>'Click here to see more root URLs (if exists)'),
        ),  
        array(  
            'name' => 'State',
            'type' => 'html',
            'value' => '$data["state_str"]',
            'htmlOptions' => array('class'=>'lefted'),
        ),  
        array(  
            'name' => 'Resources',
            'type' => 'raw',
            'value' => '"<a href = \"".Yii::app()->createUrl("UrlsView/find", array(
                        "form[siteId]"=>$data["id"],
                        "form[status]"=>"4",
                        "form[limit]"=>100,
                        "form[sortBy]"=>\'UDate\',
                        "form[sortDirection]"=>\'DESC\',
                        "form[crawledMore]"=>\'\',
                        "form[pN]"=>1
                        )
                    )."\" target=\"_blank\" >".$data["resources"]."</a>"',
            'htmlOptions' => array('class'=>'righted'),
        ), 
        array(  
            'name' => 'Contents',
            'type' => 'raw',
            'value' => '"<a href = \"".Yii::app()->createUrl("UrlsView/find", array(
                        "form[siteId]"=>$data["id"],
                        "form[status]"=>"7",
                        "form[limit]"=>100,
                        "form[sortBy]"=>\'UDate\',
                        "form[sortDirection]"=>\'DESC\',
                        "form[processedMore]"=>\'\',
                        "form[pN]"=>1,
                        "form[tags]"=>true,
                        )
                    )."\" target=\"_blank\" >".$data["contents"]."</a>"',
            'htmlOptions' => array('class'=>'righted'),
        ),
        array(  
            'name' => 'Collected',
            'type' => 'raw',
            'value' => '"<a href = \"".Yii::app()->createUrl("UrlsView/find", array(
                        "form[siteId]"=>$data["id"],
                        "form[status]"=>"",
                        "form[limit]"=>10,
                        "form[sortBy]"=>\'UDate\',
                        "form[sortDirection]"=>\'DESC\',
                        "form[pN]"=>1
                        )
                    )."\" target=\"_blank\" >".$data["collectedURLs"]."</a>"',
            'htmlOptions' => array('class'=>'righted'),
        ),
        array(  
            'name' => 'New',
            'type' => 'raw',
            'value' => '"<a href = \"".Yii::app()->createUrl("UrlsView/find", array(
                        "form[siteId]"=>$data["id"],
                        "form[status]"=>"1",
                        "form[limit]"=>10,
                        "form[sortBy]"=>\'UDate\',
                        "form[sortDirection]"=>\'DESC\',
                        "form[pN]"=>1
                        )
                    )."\" target = \"_blank\" >".$data["newURLs"]."</a>"',
            'htmlOptions' => array('class'=>'righted'),
        ),
        array(  
            'name' => 'Deleted',  
            'value' => '$data["deletedURLs"]',
            'htmlOptions' => array('class'=>'righted'),
        ),
        array(  
            'name' => 'Size',  
            'value' => '$data["size"]',
            'htmlOptions' => array('class'=>'righted'),
        ),
        array(
            'name' => 'Errors',
            'type' => 'html',
            'value' => '(!empty($data["errorsString"])) ? "<span class = \"hl-redT info tooltiped\" title = \"".$data["errorsString"]."\">".$data["errors"]."</span>" : $data["errors"]',
            'htmlOptions' => array('class'=>'righted'),
        ),
        array(
            'name' => 'Iterations',
            'value' => '$data["iterations"]',

            'htmlOptions' => array('class'=>'righted'),
        ),
        array(
            'name' => 'Dates',
            'value' => $dates,
            'type' => 'html',
            'htmlOptions' => array('class'=>'lefted  hide-switch'),
        ),
        array(
            'name' => 'Recrawl period',
            'value' => '$data["recrawlPeriod"]',
            'htmlOptions' => array('class'=>'righted'),
        ),
        array(
            'name' => 'Priority',
            'value' => '$data["priority"]',
            'htmlOptions' => array('class'=>'righted'),
        ),
        array(
            'name' => 'Owner',
            'value' => '$data["owner"]',
            'htmlOptions' => array('class'=>'lefted inverted5'),
        ),

        array(
            'header' => 'Actions',
            'class'=>'CButtonColumn',
            'template'=>'<div class = "bttn-block">{View}{resources}{cleanup}{recrawl}{Delete}</div>',
            'htmlOptions' => array('class'=>'bttn-clmn'),
            'buttons'=>array(
                'View' => array(
                    'label'=>'V',
                    'url'=> 'Yii::app()->createUrl("SitesView/findSingle", array("siteId"=>$data["id"]))',
                    'options'=>array(
                        'class'=>'act-btn',
                        'target'=>'_blank',
                        'title'=>'View/Edit'
                        ),
                    ),
                'resources' => array(
                    'label'=>'R',
                    'url'=>'Yii::app()->createUrl("UrlsView/find", array(
                        "form[siteId]"=>$data["id"],
                        "form[status]"=>"",
                        "form[limit]"=>10,
                        "form[sortBy]"=>\'UDate\',
                        "form[sortDirection]"=>\'DESC\',
                        "form[pN]"=>1
                        )
                    )',
                    'options'=>array(
                        'class'=>'act-btn',
                        'target'=>'_blank',
                        'title'=>'Show Resources',
                    ),
                    ),
                'cleanup' => array(
                    'label'=>'C',
                    'url'=>'Yii::app()->createUrl("SiteCleanup/index", array("siteId"=>$data["id"]))',
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
                    'url'=>'Yii::app()->createUrl("SiteRecrawl/index", array("siteId"=>$data["id"], "iterations"=>$data["iterations"]))',
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
                'Delete' => array(
                    'label'=>'D',
                    'url'=>'Yii::app()->createUrl("SiteDelete/index", array("siteId"=>$data["id"], "state"=>$data["state"]))',
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
