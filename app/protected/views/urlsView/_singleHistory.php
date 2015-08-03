<?php
$tabs = array();
foreach ($historyData as $node => $hostData) {
    $tabs['Node: '.$node] = array(
        'id'=>$node,
        'content'=>$this->renderPartial('//urlsView/__historyTab', array(
            'dataProvider'=>$hostData
            ), TRUE
        )
    );
}

$this->widget('zii.widgets.jui.CJuiTabs',array(
    'options'=>array(
        'collapsible'=>false,
    ),
    'id'=>'nodes',
    'tabs'=>$tabs,
    )
);
?>
