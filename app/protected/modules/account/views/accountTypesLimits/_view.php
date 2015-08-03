<?php
/* @var $this AccountTypesLimitsController */
/* @var $data AccountTypesLimits */
?>

<div class="view">
    <b><?php echo CHtml::encode($data->getAttributeLabel('AccountTypeId')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->AccountTypes->Type), array('view', 'id' => $data->AccountTypeId)); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LimitsKey')); ?>:</b>
	<?php echo CHtml::encode($data->LimitsKey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LimitsList')); ?>:</b>
	<?php echo CHtml::encode($data->LimitsList); ?>
	<br />
</div>
