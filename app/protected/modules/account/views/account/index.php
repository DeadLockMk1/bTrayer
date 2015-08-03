<?php
/* @var $this AccountController */

$this->breadcrumbs = array(
    'Accounts',
);

$this->menu = array(
    array('label' => Yii::t('app', 'Account users'), 'url' => array('//account/accountUsers')),
    array('label' => Yii::t('app', 'Account types'), 'url' => array('//account/AccountTypes')),
    array('label' => Yii::t('app', 'Account types limits'), 'url' => array('//account/AccountTypesLimits')),
);
?>

<h1>Accounts</h1>
