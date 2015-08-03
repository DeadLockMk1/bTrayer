<?php
$data = Yii::app()->getRequest();
?>
<div id = "f_item_<?=$data->getPost('fcount')?>">
    <table class="filter-item">
        <tr>
            <td>State</td>
            <td><?= CHtml::dropDownList('fstate[]', '', array(
                    '0' => 'Disabled',
                    '1' => 'Enabled',
                ),
                    array(
                        'options' => array(
                            $data->getPost('st') => Array(
                                'selected' => 'selected'
                            )
                        )
                    )
                )?>
            </td>
            <td rowspan = "8" class = "remove-column"><a href = "#" class = "act-btn removeclassf">Remove</a></td>
        </tr>
        <tr>
            <td>Action</td>
            <td><?= CHtml::dropDownList('faction[]', '', array(
                    '-1' => 'Exclude',
                    '1' => 'Include',
                ),
                    array(
                        'options' => array(
                            $data->getPost('at') => Array(
                                'selected' => 'selected'
                            )
                        )
                    )
                )?>
            </td>
        </tr>
        <tr>
            <td>Stage</td>
            <td><?= CHtml::dropDownList('fstage[]', '', array(
                    '0' => 'Collect URLs',
                    '1' => 'Before DOM pre',
                    '2' => 'After DOM pre',
                    '3' => 'After DOM',
                    '4' => 'After processor',
                    '5' => 'All stages',
                ),
                    array(
                        'options' => array(
                            $data->getPost('sg') => Array(
                                'selected' => 'selected'
                            )
                        )
                    )
                )?>
            </td>
        </tr>
        <tr>
            <td>Operation code</td>
            <td><?= CHtml::dropDownList('fopCode[]', '', array(
                    '0' => 'Regular expression',
                    '1' => 'Equal',
                    '2' => 'Not equal',
                    '3' => 'Equal or less',
                    '4' => 'Equal or more',
                    '5' => 'Less',
                    '6' => 'More',
                ),
                    array(
                        'options' => array(
                            $data->getPost('oc') => Array(
                                'selected' => 'selected'
                            )
                        )
                    )
                )?>
            </td>
        </tr>
        <tr>
            <td>Subject</td>
            <td><?=CHtml::textField('fsubject[]', $data->getPost('sj'), array('class'=>'input-small'))?></td>
        </tr>
        <tr>
            <td>Group ID</td>
            <td><?=CHtml::textField('fgroupId[]', $data->getPost('gr'), array('class'=>'input-mid righted'))?></td>
        </tr>
        <tr>
            <td>Mode</td>
            <td><?= CHtml::dropDownList('fmode[]', '', array(
                    '0' => 'URLs of the site',
                    '1' => 'URLs of the media content',
                ),
                    array(
                        'options' => array(
                            $data->getPost('m') => Array(
                                'selected' => 'selected'
                            )
                        )
                    )
                )?>
            </td>
        </tr>
        <tr>
            <td>Pattern</td>
            <td><?=CHtml::textArea('fpattern[]', $data->getPost('u'), array('class'=>'edit textarea-big'))?></td>
        </tr>
    </table>
