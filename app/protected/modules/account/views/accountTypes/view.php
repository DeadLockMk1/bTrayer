<?php
/* @var $this AccountTypesController */
/* @var $model AccountTypes */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Types') => array('index'),
    $model->Type,
);

$this->menu = array(
    array('label' => Yii::t('app', 'List AccountTypes'), 'url' => array('index')),
    array('label' => Yii::t('app', 'Create AccountTypes'), 'url' => array('create')),
    array('label' => Yii::t('app', 'Update AccountTypes'), 'url' => array('update', 'id' => $model->Id)),
    array('label' => Yii::t('app', 'Delete AccountTypes'), 'url' => '#', 'linkOptions' => array('submit' => array('delete','id' => $model->Id),'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('app', 'Manage AccountTypes'), 'url' => array('admin')),
);
?>

<h1>View AccountTypes #<?php echo $model->Type; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'Id',
        'Type',
    ),
)); ?>
