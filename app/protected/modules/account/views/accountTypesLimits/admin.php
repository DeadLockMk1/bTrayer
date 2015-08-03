<?php
/* @var $this AccountTypesLimitsController */
/* @var $model AccountTypesLimits */

$this->breadcrumbs = array(
    Yii::t('app', 'Accounts') => array('//account/account'),
    Yii::t('app', 'Account Types Limits') => array('index'),
    Yii::t('app', 'Manage'),
);

$this->menu = array(
    array('label' => Yii::t('app', 'List AccountTypesLimits'), 'url' => array('index')),
    array('label' => Yii::t('app', 'Create AccountTypesLimits'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#account-types-limits-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage Account Types Limits') ?></h1>

<p>
<?php echo Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.') ?>
</p>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array(
    'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'account-types-limits-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'AccountTypeId',
        array(
            'name' => 'AccountTypeId',
            'value' => '$data->AccountTypes->Type',
        ),
        'LimitsKey',
        'LimitsList',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'visible' => 'GRI::buttonByType($data->AccountTypes->Type)',
                ),
            ),
        ),
    ),
)); ?>
