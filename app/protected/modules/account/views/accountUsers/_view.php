<?php
/* @var $this AccountUsersController */
/* @var $data AccountUsers */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->User->username), array('view', 'id' => $data->UserId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AccountTypeId')); ?>:</b>
	<?php echo CHtml::encode($data->AccountTypes->Type); ?>
	<br />


</div>
