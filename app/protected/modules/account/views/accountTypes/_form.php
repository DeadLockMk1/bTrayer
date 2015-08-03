<?php
/* @var $this AccountTypesController */
/* @var $model AccountTypes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'account-types-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with') ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required.') ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'Type'); ?>
		<?php echo $form->textField($model, 'Type', array('size' => 60, 'maxlength' => 150)); ?>
		<?php echo $form->error($model, 'Type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
