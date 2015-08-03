<?php
$form=$this->beginWidget('CActiveForm',array(
                                 'id' => 'SearchFilter',
                                 'htmlOptions' => array('class' => ''),
                                 'action' => Yii::app()->createUrl('SiteUpdate'),
                                 'method'=>'post')
);
$this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels'=>array(
        'Status'=>$this->renderPartial('__statsAreaEdit',array(
            'itemsProvider'=>$itemsProvider,
            'descr'=>$descr,
        ),true),
        'Crawling'=>$this->renderPartial('__limitsAreaEdit',array(
            'itemsProvider'=>$itemsProvider,
            'limitsProvider'=>$limitsProvider,
            'descr'=>$descr,
        ),true),
        'Processing'=>$this->renderPartial('__urlsAreaEdit',array(
            'limitsProvider'=>$limitsProvider,
            'itemsProvider'=>$itemsProvider,
            'descr'=>$descr,
            'scrapingType'=>$scrapingType,
        ),true),
        'Filters area'=>$this->renderPartial('__filtersAreaEdit',array(
            'filtersProvider'=>$filtersProvider,
            'descr'=>$descr,
        ),true),
        'Properties area'=> $this->renderPartial('__propsAreaEdit',array(
            'propsProvider'=>$propsProvider,
            'descr'=>$descr,
        ),true),
    ),
    'options'=>array(
        'animated'=>'easeInOutQuint',
//        'autoHeight'=>false, //deprecated
        'heightStyle'=>'content',
        'active'=>0,
        'clearStyle'=>true,
        'collapsible'=>true,
    ),
));
echo CHtml::submitButton('!', array('class'=>'submit-right'));
$this->endWidget();
unset($form);
echo CHtml::tag('button', array('id'=>'update-form', 'class'=>'btn btn-default'), 'Update');
?>