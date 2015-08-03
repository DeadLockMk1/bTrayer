<?php
/* @var $this SiteController */
/* @var $model Site */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'di'); ?>
		<?php echo $form->textField($model,'di'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ii'); ?>
		<?php echo $form->textField($model,'ii'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'did'); ?>
		<?php echo $form->textField($model,'did'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->