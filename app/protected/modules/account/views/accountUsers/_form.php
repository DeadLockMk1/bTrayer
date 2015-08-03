<?php
/* @var $this AccountUsersController */
/* @var $model AccountUsers */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'account-users-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with') ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required.') ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php /*echo $form->labelEx($model,'UserId'); ?>
        <?php echo $form->textField($model,'UserId',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($model,'UserId');*/ ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'AccountTypeId'); ?>
		<?php
            //echo $form->textField($model,'AccountTypeId',array('size'=>20,'maxlength'=>20));
            echo $form->dropDownList($model, 'AccountTypeId',
                CHtml::listData(AccountTypes::model()->findAll(), 'Id', 'Type'
            ));
        ?>
		<?php echo $form->error($model, 'AccountTypeId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
