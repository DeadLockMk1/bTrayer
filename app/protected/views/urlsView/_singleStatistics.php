<?php
$tabs = array();
if (!$single){
    $view = '//urlsView/__statsTab';
} else {
    $view = '//urlsView/__statsSingleTab';
}
foreach ($historyData as $node => $hostData) {
    $tabs['Node: '.$node] = array(
        'id'=>'freq_'.$node,
        'content'=>$this->renderPartial($view, array(
            'dataProvider'=>$hostData
            ), true
        )
    );
}

$this->widget('zii.widgets.jui.CJuiTabs',array(
    'options'=>array(
        'collapsible'=>false,
    ),
    'id'=>'rfeq_nodes',
    'tabs'=>$tabs,
    )
);
?>
