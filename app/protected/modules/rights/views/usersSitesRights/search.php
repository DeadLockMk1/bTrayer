<?php
$this->renderPartial('_search');

$this->beginWidget('CActiveForm',
    array(
        'id' => 'UpdateFilter',
        'htmlOptions' => array('class' => 'filter_form'),
        'action' => Yii::app()->createUrl('//rights/UsersSitesRights/update'),
        'method' => 'post',
    )
);

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'itemGrid',
    'summaryText' => '',
    'dataProvider' => $itemsProvider,
    'enablePagination' => false,
    'htmlOptions' => array('class' => 'gr-s-sl-main'),
    'columns' => array(
        array(
            'name' => '#',
            'value' => 'GRI::getIndexManual($row, '.$currentPage.')',
            'htmlOptions' => array('class' => 'centred'),
        ),
        array(
            'name' => 'Site Id',
            'value' => '$data["id"]',
            'sortable' => true,
            'filter' => false,
            'htmlOptions' => array('class' => 'centred'),
        ),
        array(
            'name' => 'User Id',
            'value' => '$data["userId"]',
            'sortable' => true,
            'filter' => false,
            'htmlOptions' => array('class' => 'centred'),
        ),
        array(
            'name' => 'Description',
            'value' => 'YFormatter::formatShortText($data["description"], 64)',
            'htmlOptions' => array('class' => 'centred'),
        ),
        array(
            'name' => 'Root URLs',
            'type' => 'raw',
            'value' => '"<div class=\"scrollable\">".$data["urls"]."</div>"',
            'htmlOptions' => array(/*'class' => 'hide-switch'*/'class' => 'centred'),
        ),
        array(
            'name' => 'Operations',
            'value' => function ($data) use ($model) {
                return CHtml::checkBoxList(
                    'Rights['.$data['id'].'][]',
                    $data['Rights'],
                    $model->statesData,
                    array('separator' => '&nbsp;')
                );
            },
            'type' => 'raw',
            'htmlOptions' => array('class' => 'centred'),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '<div class = "bttn-block">{Edit}</div>',
            'htmlOptions' => array('class' => 'bttn-clmn'),
            'buttons' => array(
                'Edit' => array(
                    'label' => 'Edit',
                    'url' => 'Yii::app()->createUrl("//rights/usersSitesRights/edit", array(
                        "siteId" => $data["id"],
                        "userId" => $data["userId"])
                    )',
                    'options' => array("target" => "_blank"),
                ),
            ),
        ),
    ),
));
$this->widget('CLinkPager', array(
    'header' => '',
    'pages' => $pages,
    'maxButtonCount' => 0,
  /*  'htmlOptions' => array('class' => 'next')*/
));
echo CHtml::submitButton('Update', array(
        "id" => "filter_et_submit",
    )
);
echo CHtml::hiddenField('sites', $sites);
$this->endWidget();
