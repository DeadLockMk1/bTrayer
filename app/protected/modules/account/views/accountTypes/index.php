<?php
/* @var $this AccountTypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Types'),
);

$this->menu = array(
    array('label' => Yii::t('app', 'Create AccountTypes'), 'url' => array('create')),
    array('label' => Yii::t('app', 'Manage AccountTypes'), 'url' => array('admin')),
);
?>

<h1>Account Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
