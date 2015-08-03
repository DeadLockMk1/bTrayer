<?php
/* @var $this AccountUsersController */

$this->breadcrumbs = array(
    'Accounts',
);

$this->menu = array(
    array('label' => Yii::t('app', 'Account users'), 'url' => array('//account/accountUsers')),
    array('label' => Yii::t('app', 'Account types'), 'url' => array('//account/AccountTypes')),
    array('label' => Yii::t('app', 'Account types limits'), 'url' => array('//account/AccountTypesLimits')),
);
?>

<h1><?php echo Yii::t('app', 'Accounts') ?></h1>
