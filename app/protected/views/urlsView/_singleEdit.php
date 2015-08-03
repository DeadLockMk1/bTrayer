<?php
$form=$this->beginWidget('CActiveForm',array(
                                 'id' => 'updateForm',
                                 'htmlOptions' => array('class' => ''),
                                 'action' => Yii::app()->createUrl('UrlUpdate'),
                                 'method'=>'post')
);
$this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels'=>array(
        'Status area'=>$this->renderPartial('__statusAreaEdit',array(
            'itemsProvider'=>$itemsProvider,
            'descr'=>$descr,
),true),
        'Limits area'=>$this->renderPartial('__limitsAreaEdit',array(
            'limitsProvider'=>$limitsProvider,
            'descr'=>$descr,
                ),true),
    ),
    'options'=>array(
        'animated'=>'easeInOutQuint',
//        'autoHeight'=>false, //deprecated
        'heightStyle'=>'content',
        'active'=>0,
        'clearStyle'=>true,
    ),
));
echo CHtml::submitButton('!', array('class'=>'submit-right'));
$this->endWidget();
unset($form);
echo CHtml::tag('button', array('id'=>'update-form-urls', 'class'=>'btn btn-default'), 'Update');
?>