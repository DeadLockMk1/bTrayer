<?php
/* @var $this AccountTypesLimitsController */
/* @var $model AccountTypesLimits */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Types Limits') => array('index'),
    $model->AccountTypes->Type => array('view','id' => $model->AccountTypeId),
    Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => Yii::t('app', 'List AccountTypesLimits'), 'url' => array('index')),
    array('label' => Yii::t('app', 'Create AccountTypesLimits'), 'url' => array('create')),
    array('label' => Yii::t('app', 'View AccountTypesLimits'), 'url' => array('view', 'id' => $model->AccountTypeId)),
    array('label' => Yii::t('app', 'Manage AccountTypesLimits'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Update AccountTypesLimits') ?> <?php echo $model->AccountTypes->Type; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model, 'update' => true)); ?>
