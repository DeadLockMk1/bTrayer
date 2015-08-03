<?php
/* @var $this AccountTypesLimitsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Types Limits'),
);

$this->menu = array(
    array('label' => Yii::t('app', 'Create AccountTypesLimits'), 'url' => array('create')),
    array('label' => Yii::t('app', 'Manage AccountTypesLimits'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Account Types Limits') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
