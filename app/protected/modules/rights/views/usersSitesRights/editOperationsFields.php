<?php
$this->breadcrumbs = array(
    UserModule::t('Rights') => array('//rights'),
    UserModule::t('Sites') => array('//rights/usersSitesRights/index'),
    'Edit operations fields',
);
$this->beginWidget('CActiveForm',
    array(
        'id' => 'SearchFilter',
        'action' => Yii::app()->createUrl('//rights/UsersSitesRights/editOperationsFields'),
        'method' => 'post',
    )
);
?>
<div>
    <h2>Edit operations fields</h2>
    <div>
        <div>
        <?php
            $dynamicField = '<input type=checkbox name=RightsList[] value=__ checked=checked>&nbsp;__';
            echo CHtml::textField('new_dynamic_field').
                CHtml::button('Add', array(
                    'id' => 'add_dynamic_field',
                    'onclick' => 'dynamicField.add("'.$dynamicField.'")',
                ));
        ?>
        </div>
        <div id="dynamic_fields_list">
            <?php
            if (!empty($rightsList)) {
                foreach ($rightsList as $right) {
                    echo '<div>'.CHtml::checkBox('RightsList[]', true, array(
                        'value' => $right,
                    )).
                    '&nbsp;'.$right.'&nbsp;'.
                    '<span id="remove_dynamic_field" class="link" onclick="dynamicField.remove(this)">x</span></div>';
                }
            }
            ?>
        </div>
    </div>
    <div>
        <?php echo CHtml::submitButton('Save'); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
