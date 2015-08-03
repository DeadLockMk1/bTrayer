<?php
$this->breadcrumbs = array(
    UserModule::t('Rights') => array('//rights'),
    'Sites',
);
$form = $this->beginWidget('CActiveForm',
    array(
        'id' => 'SearchFilter',
        //'htmlOptions' => array('class' => 'filter_form'),
        'action' => Yii::app()->createUrl('//rights/UsersSitesRights/update'),
        'method' => 'post',
    )
);
?>
<div>

    <h2>Edit Site</h2>

    <div>
        User ID: <?php echo $form->labelEx($model, $userId);?>
    </div>
    <div>
        Site ID: <?php echo $form->labelEx($model, $siteId);?>
    </div>
    <div>
        Operations:
        <?php
        echo CHtml::checkBoxList(
            'Rights['.$siteId.'][]',
            $site->Rights,
            $model->statesData,
            array('separator' => '&nbsp;')
        );
        echo CHtml::hiddenField('sites', $sites);
        ?>
    </div>
    <div>
        <?php echo CHtml::submitButton('Save'); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
