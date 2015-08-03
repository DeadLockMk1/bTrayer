<?php
/* @var $this SitesViewController */
$form = $form=$this->beginWidget('CActiveForm',
    array(
        'htmlOptions' => array('class' => 'filter_form centred', 'id' => 'StatisticsForm'),
        'action' => Yii::app()->createUrl('SitesView/statistics'),
        'method'=>'GET'
    )
);
?>
<table class = "w100">
    <tr>
        <td rowspan = "1" class = "lefted">
            <span  class = "btn btn-default" id = "statsMore" style="margin-left: 10px; margin-top: -1px;">More</span>
            <?=CHtml::textField('urlMd5', '', array(
                    'class' => 'filter_et form-control ilblock lefted md5',
                    'placeholder'=>'URL Md5',
                    'length'=>'32',
                    'required'=>'true'
                )
            )?>
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
            <?=CHtml::ajaxSubmitButton('Submit', '/SitesView/statistics', array(
                'type' => 'POST',
                'beforeSend' => 'js:function() {
                    $("#statsContent").empty();
                    $("#statsContent").append("<div class=\'loader-overlay\'><div class=\'loader\'>Loading...</div></div>");
                }',

                'success'=>'js:function(data) {
                    $("#statsContent").empty();
                    $("#statsContent").html(data);
                    if ($("#nodes .empty").length == 0) {
                        $("#NextPageHisButton").removeClass("hidden");
                    } else {
                        $("#NextPageHisButton").addClass("hidden");
                    }
                    $("#PrevPageHisButton").addClass("hidden");
                    $("#pNp").val("1");
                    $("#pN").val("1");
                }',
                'update' => '#statsContent',
            ),
                array(
//                    'type' => 'submit',
                    'class' => 'btn btn-default',
                ))?>
        </td>
    </tr>
</table>
<table id = "statsMoreTable" class = "wauto hidden">
    <tr>
        <td class = "righted">
            <?=CHtml::label('MDate from: ', false, array("id"=>"filter_et_label"))?>
        </td>
        <td>
            <?=CHtml::dateField('MDateFrom', date('Y-m-d'), array('class' => 'filter_et fDate form-control wauto ilblock',))?>
            <?=CHtml::timeField('MTimeFrom', '00:00', array('class' => 'filter_et fTime form-control wauto ilblock'))?>
        </td>
    </tr>
    <tr>
        <td class = "righted">
            <?=CHtml::label('to: ', false, array("id"=>"filter_et_label"))?>
        </td>
        <td>
            <?=CHtml::dateField('MDateTo', date('Y-m-d'), array('class' => 'filter_et fDate form-control wauto ilblock',))?>
            <?=CHtml::timeField('MTimeTo', '23:59', array('class' => 'filter_et fTime form-control wauto ilblock'))?>
        </td>
    </tr>
    <tr>
        <td class = "righted">
            <?=CHtml::label('CDate from: ', false, array("id"=>"filter_et_label"))?>
        </td>
        <td>
            <?=CHtml::dateField('CDateFrom', '', array('class' => 'filter_et fDate form-control wauto ilblock',))?>
            <?=CHtml::timeField('CTimeFrom', '', array('class' => 'filter_et fTime form-control wauto ilblock'))?>
        </td>
    </tr>
    <tr>
        <td class = "righted">
            <?=CHtml::label('to: ', false, array("id"=>"filter_et_label"))?>
        </td>
        <td>
            <?=CHtml::dateField('CDateTo', '', array('class' => 'filter_et fDate form-control wauto ilblock',))?>
            <?=CHtml::timeField('CTimeTo', '', array('class' => 'filter_et fTime form-control wauto ilblock'))?>
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
<div id = "statsContent">
</div>


