<?php
/* @var $this AccountTypesLimitsController */
/* @var $model AccountTypesLimits */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Types Limits') => array('index'),
    $model->AccountTypes->Type,
);

$this->menu = array(
    array('label' => Yii::t('app', 'List AccountTypesLimits'), 'url' => array('index')),
    array('label' => Yii::t('app', 'Create AccountTypesLimits'), 'url' => array('create')),
    array('label' => Yii::t('app', 'Update AccountTypesLimits'), 'url' => array('update', 'id' => $model->AccountTypeId)),
    array('label' => Yii::t('app', 'Delete AccountTypesLimits'), 'url' => '#', 'linkOptions' => array('submit' => array('delete','id' => $model->LimitsKey),'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('app', 'Manage AccountTypesLimits'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View AccountTypesLimits') ?> #<?php echo $model->AccountTypes->Type; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'LimitsKey',
        'LimitsList',
        'AccountTypeId',
    ),
)); ?>
