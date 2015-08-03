<?php
/* @var $this AccountTypesController */
/* @var $model AccountTypes */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Types') => array('index'),
    $model->Type => array('view','id' => $model->Id),
    Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => Yii::t('app', 'List AccountTypes'), 'url' => array('index')),
    array('label' => Yii::t('app', 'Create AccountTypes'), 'url' => array('create')),
    array('label' => Yii::t('app', 'View AccountTypes'), 'url' => array('view', 'id' => $model->Id)),
    array('label' => Yii::t('app', 'Manage AccountTypes'), 'url' => array('admin')),
);
?>

<h1>Update AccountTypes <?php echo $model->Type; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
