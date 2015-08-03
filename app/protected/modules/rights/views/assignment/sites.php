<?php $this->breadcrumbs = array(
    'Rights' => Rights::getBaseUrl(),
    Rights::t('core', 'Assignments'),
); ?>

<div id="assignments">

	<h2><?php echo Rights::t('core', 'Assignments'); ?></h2>

	<p>
		<?php echo Rights::t('core', 'Here you can view which permissions has been assigned to each user.'); ?>
	</p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        /*array(
            'name' => 'username',
            'type'=>'raw',
            'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
        ),*/
        'Site_Id',
        'User_Id',
        'Auth_Item_Name',
    ),
    )); ?>

</div>
