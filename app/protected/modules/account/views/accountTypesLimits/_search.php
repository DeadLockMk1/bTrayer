<?php
/* @var $this AccountTypesLimitsController */
/* @var $model AccountTypesLimits */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'AccountTypeId'); ?>
		<?php echo $form->textField($model, 'AccountTypeId', array('size' => 20, 'maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'LimitsKey'); ?>
		<?php echo $form->textField($model, 'LimitsKey', array('size' => 32, 'maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'LimitsList'); ?>
		<?php echo $form->textArea($model, 'LimitsList', array('rows' => 6, 'cols' => 50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
