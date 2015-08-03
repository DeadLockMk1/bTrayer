<table>
    <tr>
        <td>State</td>
        <td><?= CHtml::dropDownList('state', '', array(
            '0' => 'Enabled',
            '1' => 'Disabled',
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
        <td>Status</td>
        <td><?= CHtml::dropDownList('status', '', array(
            '0' => 'Undefined',
            '1' => 'New',
            '2' => 'Selected for crawling',
            '3' => 'Crawling',
            '4' => 'Crawled',
            '5' => 'Selected to process',
            '6' => 'Processing',
            '7' => 'Processed',
            '8' => 'Selected for crawling (for incremental)'
        ), 
        array(
            'options' => array(
                $itemsProvider->rawData[0]["status"] => Array(
                    'selected' => 'selected'
                    )
                )
            )
        )?>
        </td>
        <td class="lefted hint"><?=$descr['status']?></td>
    </tr>
    <tr>
        <td>Type</td>
        <td><?= CHtml::dropDownList('type', '', array(
            '0' => 'Regular',
            '1' => 'Single'
        ), 
        array(
            'options' => array(
                $itemsProvider->rawData[0]["type"] => Array(
                    'selected' => 'selected'
                    )
                )
            )
        )?>
        </td>
        <td class="lefted hint"><?=$descr['type']?></td>
    </tr>
    <tr>
        <td>Charset</td>
        <td><?= CHtml::textField('charset', $itemsProvider->rawData[0]["charset"], array(
                    'class' => 'input-small',
                    'placeholder' => ''
                    )
                ) 
            ?>
        </td>
        <td class="lefted hint"><?=$descr['charset']?></td>
    </tr>
    <tr>
        <td>HTTP Method</td>
        <td><?= CHtml::textField('httpMethod', $itemsProvider->rawData[0]["httpMethod"], array(
                    'class' => 'input-small',
                    'placeholder' => ''
                    )
                ) 
            ?>
        </td>
        <td class="lefted hint"><?=$descr['httpMethod']?></td>
    </tr>
     <tr>
        <td>Content type</td>
        <td><?= CHtml::textField('contentType', $itemsProvider->rawData[0]["contentType"], array(
                    'class' => 'input-big',
                    'placeholder' => ''
                    )
                ) 
            ?>
        </td><td class="lefted hint"><?=$descr['contentType']?></td>
    </tr>
</table>

<?php
echo CHtml::hiddenField('siteId', $itemsProvider->rawData[0]["siteId"]);
echo CHtml::hiddenField('urlMd5', $itemsProvider->rawData[0]["urlMd5"]);
?>
