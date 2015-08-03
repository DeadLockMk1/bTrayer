<?php
/* @var $this SitesViewController */

?>
<?php
echo CHtml::tag('div', array(
        'class'=>'gr-s-fv-nameTag'
    ),
    '<b>Status</b>');
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $itemsProvider,
    'htmlOptions'=>array('class'=>'gr-s-fv-statsLeft'),
    'columns' => array( 
        array(  
            'name' => 'SITE ID: '.$itemsProvider->rawData[0]['id'],
            'type' => 'raw',
            'value' => '$data["description"]',
            'htmlOptions'=>array('class'=>'centred'),
        ),
    )  
));
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $itemsProvider,
    'htmlOptions'=>array('class'=>'gr-s-fv-statsRight'),
    'columns' => array( 
        array(  
            'name' => 'State',  
            'value' => '$data["state_str"]',
            'type' => 'html',
            'htmlOptions'=>array('class'=>'lefted'),
        ),  
        array(  
            'name' => 'Fetch type',  
            'value' => '$data["fetchType_str"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'URL type',  
            'value' => '$data["urlType_str"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'User data (ID/login/name)',
            'value' => '$data["userData"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
    )  
));
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
            'value' => '$data["cDate"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),  
        array(  
            'name' => 'Crawling touch date',
            'value' => '$data["tcDate"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(
            'name' => 'Processing touch date',
            'value' => '$data["tcDateProcess"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Update date',  
            'value' => '$data["uDate"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Re-crawl date',  
            'value' => '$data["recrawlDate"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Re-crawl period, minutes',  
            'value' => '$data["recrawlPeriod"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
    )  
));
echo CHtml::tag('div', array(
        'class'=>'gr-s-fv-nameTag'
    ),
    '<b>Counters</b>');
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $itemsProvider,
    'htmlOptions'=>array('class'=>'gr-s-fv-countersLeft'),
    'columns' => array(   
        array(  
            'name' => 'Collected URLs',  
            'value' => '$data["collectedURLs"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'New URLs',  
            'value' => '$data["newURLs"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Resources',  
            'value' => '$data["resources"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Contents',  
            'value' => '$data["contents"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Deleted URLs',  
            'value' => '$data["deletedURLs"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
    )
));
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $itemsProvider,
    'htmlOptions'=>array('class'=>'gr-s-fv-countersRight'),
    'columns' => array(   
        array(  
            'name' => 'Iterations',  
            'value' => '$data["iterations"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Errors',  
            'value' => '$data["errors"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Average speed',  
            'value' => '$data["avgSpeed"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
        array(  
            'name' => 'Size',  
            'value' => '$data["size"]',
            'htmlOptions'=>array('class'=>'righted'),
        ),
    )
));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $errorsProvider,
    'htmlOptions'=>array('class'=>'gr-s-fv-errors'),
    'emptyText' => '<h5>No errors!</h5>',
    'columns' => array( 
        array(
            'name' => 'Error types',  
            'value' => '$data["errorType"]',
            'htmlOptions'=>array(
                'class'=>'lefted',
            )
        ),
    ),
));
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $itemsProvider,
    'htmlOptions'=>array('class'=>'gr-s-fv-urls'),
    'columns' => array( 
        array(  
            'name' => 'Root URLs',  
            'type' => 'raw',
            'value' => 'CHtml::tag("div",array("class"=>"scrollable lefted"),$data["urls_act"])',
            'htmlOptions'=>array(
                'class'=>'',
            )
        ),
    )  
));
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $limitsProvider,
    'htmlOptions'=>array('class'=>'gr-s-fv-limits'),
    'columns' => array(   
        array(  
            'name' => 'Limit',
            'value' => '$data["limit_name"]',
            'htmlOptions'=>array('class'=>'lefted'),
        ),
        array(  
            'name' => 'Value',
            'value' => '$data["limit_value"]',
            'htmlOptions'=>array('class'=>'righted'),
        )
    )  
));
?>
<?php
echo CHtml::tag('div', array(
        'class'=>'gr-s-fv-nameTag'
    ),
    '<b>Filters</b>');
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $filtersProvider,
    'htmlOptions'=>array('class'=>'gr-s-fv-filters'),
    'emptyText' => '<h5>No filters found...</h5>',
    'columns' => array( 
        array(  
            'name' => 'Pattern',  
            'value' => '$data["pattern"]',
            'htmlOptions' => array(
                'class' => 'lefted',
                'onClick'=>'' 
            ),
        ),
        array(  
            'name' => 'Action',  
            'value' => '$data["action"]',
            'htmlOptions'=>array(
                'class'=>'righted',
                'onClick'=>'',
            ),
        ),
        array(  
            'name' => 'Operation code',  
            'value' => '$data["opCode"]',
            'htmlOptions'=>array(
                'class'=>'righted',
                'onClick'=>'',
            ),
        ),
        array(  
            'name' => 'Stage',  
            'value' => '$data["stage"]',
            'htmlOptions'=>array(
                'class'=>'righted',
                'onClick'=>'',
            ),
        ),
        array(  
            'name' => 'State',  
            'value' => '$data["state"]',
            'htmlOptions'=>array(
                'class'=>'righted',
                'onClick'=>'',
            ),
        ),
        array(  
            'name' => 'Mode',  
            'value' => '$data["mode"]',
            'htmlOptions'=>array(
                'class'=>'righted',
                'onClick'=>''
            ),
        ),
        array(
            'name' => 'Group ID',
            'value' => '$data["groupId"]',
            'htmlOptions'=>array(
                'class'=>'righted',
                'onClick'=>'',
            ),
        ),
        array(  
            'name' => 'Subject',  
            'value' => '$data["subject"]',
            'htmlOptions'=>array(
                'class'=>'lefted',
                'onClick'=>'',
            ),
        ),
        array(  
            'name' => 'cDate',  
            'value' => '$data["cDate"]',
            'htmlOptions'=>array(
                'class'=>'lefted',
                'onClick'=>'',
            ),
        ),
        array(  
            'name' => 'uDate',  
            'value' => '$data["uDate"]',
            'htmlOptions'=>array(
                'class'=>'lefted',
                'onClick'=>'',
            ),
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{View}',
            'buttons'=>array(
                'View' => array(
                    'label'=>'Details',
                    'url'=> 'Yii::app()->createUrl("ajax/getFilterItem", array("n"=>$data["n"],"nn"=>$data["nn"]))',
                    'options' => array(
                        'class'=>'act-btn',
                        'title'=>'Show detailed info',
                        'ajax' => array(
                            'type' => 'get', 
                            'url'=>'js:$(this).attr("href")', 
                            'success' => 'js:function(data) {
                                            $("#filter_item_modal").dialog("open");
                                            $("#filter_item_modal").dialog("option", "width", 1000);
                                            $("#filter_item_modal").html(data);
                                            $("#filter_item_modal").dialog("option", "position", "center");
                                        }'
                            )),
                ),
            ),
        ),
    )  
));
echo CHtml::tag('div', array(
        'class'=>'gr-s-fv-nameTag'
    ),
    '<b>Properties</b>');
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $propsProvider,
    'htmlOptions'=>array('class'=>'gr-s-fv-props'),
    'emptyText' => '<h5>No properties found...</h5>',
    'columns' => array(
        array(  
            'name' => 'Name',
            'type' => 'html',
            'value' => '"<textarea>".$data["name"]."</textarea>"',
        ),
        array(
            'name' => 'Value',
            'type'=>'raw',
            'value' => 'CHtml::textArea("property_value", $data["value"], array(
                "class" => "w100 textarea-transparent",
                "readonly" => true,
            ))',
            'htmlOptions' => array('class'=>'gr-s-fv-props-val pNone'),
        ),
        array(  
            'name' => 'cDate',
            'type'=>'html',
            'value' => '$data["cDate"]',
            'htmlOptions' => array('class'=>'lefted w10'),
        ),
        array(  
            'name' => 'uDate',
            'type'=>'html',
            'value' => '$data["uDate"]',
            'htmlOptions' => array('class'=>'lefted w10'),
        ),
    )
));
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'filter_item_modal',
    'options' => array(
        'title' => 'View filter item',
        'autoOpen' => false,
        'resizable'=> true,
    ),
));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>