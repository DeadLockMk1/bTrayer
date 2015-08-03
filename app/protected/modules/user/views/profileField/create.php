<?php
$this->breadcrumbs = array(
    UserModule::t('Users') => array('//user/admin/admin'),
    UserModule::t('Create'),
);
$this->menu = array(
    array('label' => UserModule::t('Manage Profile Field'), 'url' => array('admin')),
);
?>
<h1><?php echo UserModule::t('Create Profile Field'); ?></h1>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
