<?php echo $this->renderPartial('//app/_errorsFields', 
    array(
        'model' => $model,
        'header' => Yii::t('app', 
            'Your account type limited, please fix the following input limits:'
        ),
    )); 
?>

<?php
$this->breadcrumbs=array(
    'Add new site',
);

$form=$this->beginWidget('CActiveForm',array(
                                 'id' => 'SearchFilter',
                                 'htmlOptions' => array('class' => ''),
                                 'action' => Yii::app()->createUrl('SiteNew/new'),
                                 'method'=>'post')
);
$this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels'=>array(
        'Crawling'=>$this->renderPartial('__limitsAreaEdit',array(
            'defaults'=>$defaults,
            'descr'=>$descr,
            ),true),
        'Processing'=>$this->renderPartial('__urlsAreaEdit',array(
            'defaults'=>$defaults,
            'descr'=>$descr,
            ),true),
        'Filters area'=>$this->renderPartial('__filtersAreaEdit',array(
            'descr'=>$descr,
        ),true),
        'Properties area'=> $this->renderPartial('__propsAreaEdit',array(
            'descr'=>$descr,
            'props'=>$props,
        ),true),
    ),
    'options'=>array(
        'animated'=>'easeInOutQuint',
//        'autoHeight'=>false, //deprecated
        'heightStyle'=>'content',
        'active'=>0,
        'clearStyle'=>true,
        'collapsible'=>true,
        'hidden'=>true,
    ),
));
echo CHtml::submitButton('Create', array('class'=>'submit-right'));
$this->endWidget();
unset($form);
echo CHtml::tag('button', array('id'=>'site-new-form', 'class'=>'btn btn-default'), 'Create');
?>