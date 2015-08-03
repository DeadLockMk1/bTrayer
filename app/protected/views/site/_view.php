<?php
/* @var $this SiteController */
/* @var $data Site */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('di')); ?>:</b>
	<?php echo CHtml::encode($data->di); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ii')); ?>:</b>
	<?php echo CHtml::encode($data->ii); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('did')); ?>:</b>
	<?php echo CHtml::encode($data->did); ?>
	<br />


</div>