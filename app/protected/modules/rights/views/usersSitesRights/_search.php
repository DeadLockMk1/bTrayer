<?php
$this->breadcrumbs = array(
    UserModule::t('Rights') => array('//rights'),
    'Sites',
);
?>
<p>
    <?php echo CHtml::link(
        Rights::t('core', 'Edit operations fields'),
        array('//rights/UsersSitesRights/editOperationsFields')
    );
    ?>
</p>
<?php
$form = $this->beginWidget('CActiveForm',
    array(
        'id' => 'SearchFilter',
        'htmlOptions' => array('class' => 'filter_form'),
        'action' => Yii::app()->createUrl('//rights/UsersSitesRights/search'),
        'method' => 'get',
    )
);
echo CHtml::submitButton('Refresh', array(
        "id" => "filter_et_submit",
    )
);
echo CHtml::dropDownList('pageSize', '10',
    array(
        '10' => '10',
        '20' => '20',
        '30' => '30',
        '40' => '40',
        '50' => '50',
        '60' => '60',
        '70' => '70',
        '80' => '80',
        '90' => '90',
        '100' => '100',
    ),
    array("id" => "filter_et_list")
);
//echo CHtml::label('Page size', false, array("id" => "filter_et_label"));

echo CHtml::textField('rights', '', array(
        'class' => 'filter_et',
        'placeholder' => 'view, change, ...',
    )
);
echo CHtml::textField('siteId', '', array(
        'class' => 'filter_et',
        'placeholder' => 'Site ID...', /*,
        'required'=>'true'*/
    )
);
echo CHtml::textField('pattern', '', array(
        'class' => 'filter_et',
        'placeholder' => 'URL pattern...', /*,
        'required'=>'true'*/
    )
);
echo CHtml::textField('searchUserId', '', array(
        'class' => 'filter_et',
        'placeholder' => 'User ID...', /*,
        'required'=>'true'*/
    )
);
$this->endWidget();
unset($form);
