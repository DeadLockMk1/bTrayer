<table>
    <tr>
        <td>State</td>
        <td><?= CHtml::dropDownList('state', '', array(
            '1' => 'Active',
            '2' => 'Disabled',
            '3' => 'Suspended'
        ), 
        array(
            'options' => array(
                $itemsProvider->rawData[0]["state"] => Array(
                    'selected' => 'selected'
                    )
                )
            )
        )?>
        </td>
        <td class="lefted hint"><?=$descr['state']?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?= CHtml::textField('description', $itemsProvider->rawData[0]["description"], array(
            'class' => 'input-big',
            'placeholder' => '65 chars max',
            'maxlength' => '65'
            )) ?>
        </td>
        <td class="lefted hint"><?=$descr['description']?></td>
    </tr>
</table>
<?php
echo CHtml::hiddenField('siteId', $itemsProvider->rawData[0]["id"]);
?>

