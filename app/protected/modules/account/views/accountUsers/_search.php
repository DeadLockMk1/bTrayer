<?php
/* @var $this AccountUsersController */
/* @var $model AccountUsers */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'UserId'); ?>
		<?php echo $form->textField($model, 'UserId', array('size' => 20, 'maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'AccountTypeId'); ?>
		<?php echo $form->textField($model, 'AccountTypeId', array('size' => 20, 'maxlength' => 20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
