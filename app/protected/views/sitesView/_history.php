<?php
/* @var $this SitesViewController */
$form = $form=$this->beginWidget('CActiveForm',
    array(
        'htmlOptions' => array('class' => 'filter_form centred', 'id' => 'HistoryForm'),
        'action' => Yii::app()->createUrl('SitesView/history'),
        'method'=>'GET'
    )
);
?>
<table class = "w100">
    <tr>
        <td rowspan = "1" class = "lefted">
            <span  class = "btn btn-default" id = "hisMore" style="margin-left: 10px; margin-top: -1px;">More</span>
            <?=CHtml::textField('urlMd5', '', array(
                    'class' => 'filter_et form-control ilblock lefted md5',
                    'placeholder'=>'URL Md5',
                    'length'=>'32',
                    'required'=>'true'
                )
            )?>
            <?=CHtml::label('Operation:', false, array("id"=>"filter_et_label"))?>
            <?=CHtml::dropDownList("operation", '', array(
                '' => 'All',
                'd0' => '----------',
                'd1' => 'URL',
                'd2' => '----------',
                '20' => 'Insert',
                '21' => 'Delete',
                '22' => 'Update',
                '23' => 'Cleanup',
                '24' => 'Aging',
                '25' => 'Content',
                'd3' => '----------',
                'd4' => 'Status',
                'd5' => '----------',
                '1' => 'New',
                '2' => 'Selected to crawl',
                '3' => 'Crawling',
                '4' => 'Crawled',
                '5' => 'Selected to process',
                '6' => 'Processing',
                '7' => 'Processed',
            ),
                array(
                    'options' => array(
                        ''=> array(
                            'selected' => 'selected'
                        ),
                        'd0'=>array(
                            'disabled'=>true,
                        ),
                        'd1'=>array(
                            'disabled'=>true,
                        ),
                        'd2'=>array(
                            'disabled'=>true,
                        ),
                        'd3'=>array(
                            'disabled'=>true,
                        ),
                        'd4'=>array(
                            'disabled'=>true,
                        ),
                        'd5'=>array(
                            'disabled'=>true,
                        ),
                    ),
                    'id'=>'filter_et_list',
                    "class"=>"form-control wauto lefted ilblock"
                )
            )
            ?>
            <?=CHtml::label('Limit:', false, array("id"=>"filter_et_label"))?>
            <?=CHtml::dropDownList('limit','',
            array(
            '100'=>'100',
            '200'=>'200',
            '300'=>'300',
            '400'=>'400',
            '500'=>'500',
            '600'=>'600',
            '700'=>'700',
            '800'=>'800',
            '900'=>'900',
            '1000'=>'1000',
            ),
            array(
            "id"=>"filter_et_list",
            "class"=>"form-control wauto lefted ilblock"
            )
            )?>

        </td>
        <td rowspan = "1" class = "righted wauto">
            <?=CHtml::ajaxSubmitButton('Submit', '/SitesView/history', array(
                'type' => 'POST',
                'beforeSend' => 'js:function() {
                    if ($("#urlMd5").val().trim() == "") {
                        alert("URL MD5 is required !");
                        return false;
                    }
                    $("#historyContent").empty();
                    $("#historyContent").append("<div class=\'loader-overlay\'><div class=\'loader\'>Loading...</div></div>");
                }',

                'success'=>'js:function(data) {
                    $("#historyContent").empty();
                    $("#historyContent").html(data);
                    if ($("#nodes .empty").length == 0) {
                        $("#NextPageHisButton").removeClass("hidden");
                    } else {
                        $("#NextPageHisButton").addClass("hidden");
                    }
                    $("#PrevPageHisButton").addClass("hidden");
                    $("#pNp").val("1");
                    $("#pN").val("1");
                }',
                'update' => '#historyContent',
            ),
                array(
//                    'type' => 'submit',
                    'class' => 'btn btn-default',
                ))?>

        </td>
    </tr>
</table>
<table id = "hisMoreTable" class = "wauto hidden">
    <tr>
        <td class = "righted">
            <?=CHtml::label('oDate from: ', false, array("id"=>"filter_et_label"))?>
        </td>
        <td>
            <?=CHtml::dateField('oDateFrom', date('Y-m-d'), array('class' => 'filter_et fDate form-control wauto ilblock',))?>
            <?=CHtml::timeField('oTimeFrom', '00:00', array('class' => 'filter_et fTime form-control wauto ilblock'))?>
        </td>
    </tr>
    <tr>
        <td class = "righted">
            <?=CHtml::label('to: ', false, array("id"=>"filter_et_label"))?>
        </td>
        <td>
            <?=CHtml::dateField('oDateTo', date('Y-m-d'), array('class' => 'filter_et fDate form-control wauto ilblock',))?>
            <?=CHtml::timeField('oTimeTo', '23:59', array('class' => 'filter_et fTime form-control wauto ilblock'))?>
        </td>
    </tr>
    <tr>
        <td class = "righted">
            <?=CHtml::label('cDate from: ', false, array("id"=>"filter_et_label"))?>
        </td>
        <td>
            <?=CHtml::dateField('cDateFrom', '', array('class' => 'filter_et fDate form-control wauto ilblock',))?>
            <?=CHtml::timeField('cTimeFrom', '', array('class' => 'filter_et fTime form-control wauto ilblock'))?>
        </td>
    </tr>
    <tr>
        <td class = "righted">
            <?=CHtml::label('to: ', false, array("id"=>"filter_et_label"))?>
        </td>
        <td>
            <?=CHtml::dateField('cDateTo', '', array('class' => 'filter_et fDate form-control wauto ilblock',))?>
            <?=CHtml::timeField('cTimeTo', '', array('class' => 'filter_et fTime form-control wauto ilblock'))?>
        </td>
    </tr>
</table>
<?php
echo CHtml::hiddenField('siteid', $itemsProvider->rawData[0]['id']);
echo CHtml::hiddenField('pN', '1');
echo CHtml::hiddenField('pNp', '1');
echo CHtml::tag('div', array(
    'class' => 'prev_page hidden',
    'id' => 'PrevPageHisButton'
    ),
    CHtml::encode('<<BACK')
);
echo CHtml::tag('div', array(
        'class' => 'next_page hidden',
        'id' => 'NextPageHisButton'
    ),
    CHtml::encode('MORE>>')
);
$this->endWidget();
unset($form);
?>
<div id = "historyContent">
</div>


