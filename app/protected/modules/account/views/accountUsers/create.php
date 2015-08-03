<?php
/* @var $this AccountUsersController */
/* @var $model AccountUsers */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Users') => array('index'),
    Yii::t('app', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('app', 'List AccountUsers'), 'url' => array('index')),
    array('label' => Yii::t('app', 'Manage AccountUsers'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Create AccountUsers') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
