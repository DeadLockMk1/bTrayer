<?php
/* @var $this AccountUsersController */
/* @var $model AccountUsers */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Users') => array('index'),
    $model->UserId,
);

$this->menu = array(
    array('label' => Yii::t('app', 'List AccountUsers'), 'url' => array('index')),
    //array('label'=>'Create AccountUsers', 'url'=>array('create')),
    array('label' => Yii::t('app', 'Update AccountUsers'), 'url' => array('update', 'id' => $model->UserId)),
    array('label' => Yii::t('app', 'Delete AccountUsers'), 'url' => '#', 'linkOptions' => array('submit' => array('delete','id' => $model->UserId),'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('app', 'Manage AccountUsers'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View AccountUsers') ?> #<?php echo $model->UserId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'UserId',
        'AccountTypeId',
    ),
)); ?>
