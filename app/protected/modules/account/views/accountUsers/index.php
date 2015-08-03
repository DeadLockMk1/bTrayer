<?php
/* @var $this AccountUsersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Users'),
);

$this->menu = array(
    //array('label'=>'Create AccountUsers', 'url'=>array('create')),
    array('label' => Yii::t('app', 'Manage AccountUsers'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Account Users') ?></h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
