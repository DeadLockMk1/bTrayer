<?php
$form = $form=$this->beginWidget('CActiveForm',
    array(
        'id' => 'SearchFilter',
        'htmlOptions' => array('class' => 'filter_form', 'id' => 'SiteFindForm'),
        'action' => Yii::app()->createUrl('SitesView/find'),
        'method'=>'get'
    )
);
if (Yii::app()->user->name != 'viewer'){
    echo CHtml::link('Add new site', '/SiteNew/index', array(
            'class'=>'filter_et_new_link filter_et_new btn btn-default'
        ));
}
if (UserModule::isAdmin()) {
    $tHFieldName = 'textField';
    $tHFieldVal = $uid;
} else {
    $tHFieldName = 'hiddenField';
    $tHFieldVal = Yii::app()->user->id;
}
echo CHtml::$tHFieldName('uid', $tHFieldVal, array(
        'class' => 'filter_et form-control wauto lefted ilblock',
        'placeholder'=>'UserID/Username/eMail', 
        'required'=>'true'
    )
);
echo CHtml::textField('pattern', $pattern, array(
        'class' => 'filter_et form-control wauto lefted ilblock',
        'placeholder'=>'URL pattern', 
        'required'=>'true'
    )
);
echo CHtml::label('State', false, array("id"=>"filter_et_label"));
echo  CHtml::dropDownList('state', $state, array(
    'all' => 'Any',
    '1' => 'Active',
    '2' => 'Disabled',
    '3' => 'Suspended'
),
    array(
        "id"=>"filter_et_list",
        "class"=>"form-control wauto lefted ilblock"
        )
);
echo CHtml::label('Sort by:', false, array("id"=>"filter_et_label"));
echo CHtml::dropDownList("sortBy", '', array(
    'CDate' => 'Creation date',
    'UDate' => 'Update date',
    'TcDate' => 'Touch date',
    'Resources' => 'Resources',
    'Contents' => 'Contents',
    'CollectedURLs' => 'Collected URLs',
    'NewURLs' => 'New URLs',
    'DeletedURLs' => 'Deleted URLs',
    'Iterations' => 'Iterations',
    'Errors' => 'Errors',
    'LastModified' => 'Last modified',
    'Size' => 'Size',
    'AVGSpeed' => 'Average speed',
    'RecrawlPeriod' => 'Re-crawl period',
    'RecrawlDate' => 'Re-crawl date',
),
    array(
        'options' => array(
            $sortBy=> array(
                'selected' => 'selected'
            )
        ),
        'id'=>'filter_et_list',
        "class"=>"form-control wauto lefted ilblock"
    )
);
echo CHtml::dropDownList("sortDirection", '', array(
    'ASC' => 'ASC',
    'DESC' => 'DESC',
),
    array(
        'options' => array(
            $sortDirection=> Array(
                'selected' => 'selected'
            ),
        ),
        'id'=>'filter_et_list',
        "class"=>"form-control wauto lefted ilblock"
    )
);

echo CHtml::label('Limit', false, array("id"=>"filter_et_label"));
echo CHtml::dropDownList('limit',$limit,
    array(
        '10'=>'10',
        '20'=>'20',
        '30'=>'30',
        '40'=>'40',
        '50'=>'50',
        '60'=>'60',
        '70'=>'70',
        '80'=>'80',
        '90'=>'90',
        '100'=>'100',
    ),
    array(
        "id"=>"filter_et_list",
        "class"=>"form-control wauto lefted ilblock"
    )
);
echo CHtml::submitButton('Submit', array(
        "id"=>"filter_et_submit",
        "class"=>"btn btn-default"
    )
);
if ($page != '0') {
    echo CHtml::tag('div', array(
        'class' => 'filter_form_pagination',
    ));
    if ($isResult) {
        echo CHtml::tag('div', array(
            'class' => 'next_page',
            'id' => 'NextPageSitesButton'
        ),
            CHtml::encode('MORE>>')
        );
    }

    if ($page != '1') {
        echo CHtml::tag('div', array(
            'class' => 'prev_page',
            'id' => 'PrevPageSitesButton'
            ),
            CHtml::encode('<<BACK')
        );
    }

    echo CHtml::closeTag('div');
    echo CHtml::hiddenField('pN', $page);
} else {
    echo CHtml::hiddenField('pN', '1');
}

$this->endWidget();
unset($form);
