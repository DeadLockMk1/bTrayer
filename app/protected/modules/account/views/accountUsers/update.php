<?php
/* @var $this AccountUsersController */
/* @var $model AccountUsers */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Users') => array('index'),
    $model->User->username => array('view','id' => $model->UserId),
    Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => Yii::t('app', 'List AccountUsers'), 'url' => array('index')),
    //array('label'=>'Create AccountUsers', 'url'=>array('create')),
    array('label' => Yii::t('app', 'View AccountUsers'), 'url' => array('view', 'id' => $model->UserId)),
    array('label' => Yii::t('app', 'Manage AccountUsers'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Update AccountUsers') ?> <?php echo $model->User->username; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
