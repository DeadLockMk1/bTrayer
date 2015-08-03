<?php
/* @var $this AccountTypesController */
/* @var $model AccountTypes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'Id'); ?>
		<?php echo $form->textField($model, 'Id', array('size' => 20, 'maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Type'); ?>
		<?php echo $form->textField($model, 'Type', array('size' => 60, 'maxlength' => 150)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
