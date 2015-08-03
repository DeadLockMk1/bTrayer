<?php
/* @var $this SiteController */
/* @var $model Site */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'di'); ?>
		<?php echo $form->textField($model,'di'); ?>
		<?php echo $form->error($model,'di'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ii'); ?>
		<?php echo $form->textField($model,'ii'); ?>
		<?php echo $form->error($model,'ii'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'did'); ?>
		<?php echo $form->textField($model,'did'); ?>
		<?php echo $form->error($model,'did'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->