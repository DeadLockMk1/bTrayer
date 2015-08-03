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
                'name' => 'Opertion',
                'value' => '$data["OpText"]',
                'htmlOptions'=>array('class'=>'lefted word-wrp'),
            ),
            array(
                'name' => 'CDate',
                'value' => '$data["CDate"]',
                'htmlOptions'=>array('class'=>'lefted word-wrp'),
            ),
            array(
                'name' => 'ODate',
                'value' => '$data["ODate"]',
                'htmlOptions'=>array('class'=>'lefted word-wrp'),
            ),
            array(
                'name' => 'Reason (delete only)',
                'value' => '$data["Reason"]',
                'htmlOptions'=>array('class'=>'lefted word-wrp'),
            ),
            array(
                'name' => 'Object',
                'value' => '"<div class = \"drop-arrow-his\">Show</div><div class=\"slideList w100\"><textarea class=\"w100 textarea-transparent h25em\" readonly>".$data["Object"]."</textarea></div>"',
                'type' => 'raw',
                'htmlOptions'=>array('class'=>'lefted word-wrp hide-switch'),
            ),

        ),
    ));
?>
<script type="text/javascript">
    $("#nodes .textarea-transparent").css({"overflow": "hidden"}).prop("disabled", true);
    $(".slideList").css({"max-height": "0em"});
    $(".drop-arrow-his").click(function() {
        if (!$(this).parent().hasClass('exp-list')) {
            $(this).html('Hide');
            $(this).parent().children(".slideList").animate({"max-height": "50em"}, 1000).css({"overflow": "hidden"});
            $(this).parent().addClass('exp-list');
            $(this).parent().children(".slideList").children("#nodes .textarea-transparent").css({"overflow": "auto"}).prop("disabled", false);
        } else {
            $(this).html('Show');

//            $(".textarea-transparent").click( function () {
//                    return false;
//                }
//            );
            $(this).parent().children(".slideList").animate({"max-height": "0em", scrollTop: 0}).css({"overflow": "hidden"});
            $(this).parent().removeClass('exp-list');
            $("#nodes .textarea-transparent").css({"overflow": "hidden"}).prop("disabled", true);
        }

    });
</script>
<?php
$assetsManager = Yii::app()->clientScript;
$assetsManager->registerCoreScript('jquery');
$assetsManager->registerCoreScript('jquery.ui');

// Disable jquery-ui default theme
$assetsManager->scriptMap=array(
    'jquery-ui-bootstrap.css'=>false,
    'jquery-ui.css'=>false,
    'jquery-ui.min.js'=>false,
    'jquery.js'=>false,
    'jquery.ba-bbq.js'=>false,
);
?>
