<?php
/* @var $this SitesViewController */

$this->breadcrumbs=array(
    'Sites View',
);
?>

<?php
$form = $form=$this->beginWidget('CActiveForm',array(
                                 'id' => 'SearchFilter',
                                 'htmlOptions' => array('class' => 'well'),
                                 'action' => Yii::app()->createUrl('SitesView/find'),
                                 'method'=>'get')
);
?>
Limit
<?php echo CHtml::dropDownList('limit','10',array('10'=>'10',
                                                  '20'=>'20',
                                                  '30'=>'30',
                                                  '40'=>'40',
                                                  '50'=>'50',
                                                  '60'=>'60',
                                                  '70'=>'70',
                                                  '80'=>'80',
                                                  '90'=>'90',
                                                  '100'=>'100',
                                                  ));?>
Pattern
<?php echo CHtml::textField('pattern');?>
UID
<?php echo CHtml::textField('uid');?>
<?php echo CHtml::submitButton('Submit');?>

<?php 
$this->endWidget();
unset($form);
?>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',  
    'dataProvider' => $itemsProvider,  
    'enablePagination' => true,  
    'columns' => array( 
        array(  
            'name' => 'ID',  
            'value' => '$data["id"]',  
            'sortable' => true,  
            'filter' => false,  
        ),  
        array(  
            'name' => 'URLs',  
            'type' => 'raw',
            'value' => '$data["urls"]'  
        ),  
        array(  
            'name' => 'Resources',  
            'value' => '$data["resources"]'  
        ), 
        array(  
            'name' => 'Contents',  
            'value' => '$data["contents"]'  
        ),  
    )  
));
?> 