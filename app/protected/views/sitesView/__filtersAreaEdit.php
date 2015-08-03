<div id = "filters-hint" class = "fhint">
<p>
    <ul>
        <li><b>State</b> - <?=$descr['fState']?></li>
        <li><b>Action</b> - <?=$descr['fAction']?></li>
        <li><b>Stage</b> - <?=$descr['fStage']?></li>
        <li><b>Operation code</b> - <?=$descr['fOperationCode']?></li>
        <li><b>Subject</b> - <?=$descr['fSubject']?></li>
        <li><b>Group ID</b> - <?=$descr['fGroupId']?></li>
        <li><b>Mode</b> - <?=$descr['fMode']?></li>
        <li><b>Pattern</b> - <?=$descr['fPattern']?></li>
    </ul>
</p>
</div>
<div>
    <a href="#" id = "add-new-filter" class = "btn btn-default">Add new filter item</a>
</div>
<div id = "filters-wrapper">
<?php foreach ($filtersProvider->rawData as $k => $val):?>
<div id = "f_item_<?=$k?>">
    <table class="filter-item">
        <tr>
            <td>State</td>
            <td><?= CHtml::dropDownList('fstate[]', '', array(
                    '0' => 'Disabled',
                    '1' => 'Enabled',
                ),
                    array(
                        'options' => array(
                            $filtersProvider->rawData[$k]["state"] => Array(
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
                            $filtersProvider->rawData[$k]["action"] => Array(
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
                            $filtersProvider->rawData[$k]["stage"] => Array(
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
                            $filtersProvider->rawData[$k]["opCode"] => Array(
                                'selected' => 'selected'
                            )
                        )
                    )
                )?>
            </td>
        </tr>
        <tr>
            <td>Subject</td>
            <td><?=CHtml::textField('fsubject[]', $filtersProvider->rawData[$k]["subject"], array('class'=>'input-small'))?></td>
        </tr>
        <tr>
            <td>Group ID</td>
            <td><?=CHtml::textField('fgroupId[]', $filtersProvider->rawData[$k]["groupId"], array('class'=>'input-mid righted'))?></td>
        </tr>
        <tr>
            <td>Mode</td>
            <td><?= CHtml::dropDownList('fmode[]', '', array(
                    '0' => 'URLs of the site',
                    '1' => 'URLs of the media content',
                ),
                    array(
                        'options' => array(
                            $filtersProvider->rawData[$k]["mode"] => Array(
                                'selected' => 'selected'
                            )
                        )
                    )
                )?>
            </td>
        </tr>
        <tr>
            <td>Pattern</td>
            <td><?=CHtml::textArea('fpattern[]', $filtersProvider->rawData[$k]["pattern"], array('class'=>'edit textarea-big'))?></td>
        </tr>
    </table>
</div>    
<?php endforeach;?>
</div>