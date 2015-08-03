<?php
/* @var $this AccountTypesLimitsController */
/* @var $model AccountTypesLimits */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'account-types-limits-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with') ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required.') ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'AccountTypeId'); ?>
		<?php
            //$accountTypes = (isset($create) ? AccountTypes::getAvailableTypes() : AccountTypes::model()->findAll());

            //echo $form->textField($model,'AccountTypeId',array('size'=>20,'maxlength'=>20));
            echo $form->dropDownList($model, 'AccountTypeId',
                CHtml::listData(AccountTypes::model()->findAll(), 'Id', 'Type'),
                array('disabled' => isset($update))
            );
        ?>
		<?php echo $form->error($model, 'AccountTypeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'LimitsKey'); ?>
		<?php
            echo $form->textField($model, 'LimitsKey', array(
                'size' => 32,
                'maxlength' => 32,
                'disabled' => isset($update),
            )); ?>
		<?php echo $form->error($model, 'LimitsKey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'LimitsList'); ?>
		<?php echo $form->textArea($model, 'LimitsList', array('rows' => 8, 'cols' => 60)); ?>
		<?php echo $form->error($model, 'LimitsList'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
