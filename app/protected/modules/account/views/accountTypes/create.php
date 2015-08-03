<?php
/* @var $this AccountTypesController */
/* @var $model AccountTypes */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Types') => array('index'),
    Yii::t('app', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('app', 'List AccountTypes'), 'url' => array('index')),
    array('label' => Yii::t('app', 'Manage AccountTypes'), 'url' => array('admin')),
);
?>

<h1>Create AccountTypes</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
