<?php
/* @var $this AccountTypesLimitsController */
/* @var $model AccountTypesLimits */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Types Limits') => array('index'),
    Yii::t('app', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('app', 'List AccountTypesLimits'), 'url' => array('index')),
    array('label' => Yii::t('app', 'Manage AccountTypesLimits'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Create AccountTypesLimits') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model, 'create' => true)); ?>
