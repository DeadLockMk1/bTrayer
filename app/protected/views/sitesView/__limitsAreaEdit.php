<?php $urls = str_replace('<br>', "\n", $itemsProvider->rawData[0]["urls"]);?>
<table>
    <tr>
        <td>URL type</td>
        <td><?= CHtml::dropDownList('urlType', '', array(
            '0' => 'Regular',
            '1' => 'Single'
        ), 
        array(
            'options' => array(
                $itemsProvider->rawData[0]["urlType"] => Array(
                    'selected' => 'selected'
                    )
                )
            )
        )?>
        </td>
        <td class="lefted hint"><?=$descr['urlType']?></td>
    </tr>
    <tr>
        <td>Fetch type</td>
        <td><?= CHtml::dropDownList('fetchType', '', array(
            '1' => 'Static',
            '2' => 'Dynamic',
            '3' => 'External'
        ), 
        array(
            'options' => array(
                $itemsProvider->rawData[0]["fetchType"] => Array(
                    'selected' => 'selected'
                    )
                )
            )
        )?>
        </td>
        <td class="lefted hint"><?=$descr['fetchType']?></td>
        <?php
    foreach ($limitsProvider->rawData as $item){
    	if (($item["limit_name_f"]!=='processingDelay') && ($item["limit_name_f"]!=='maxResources')){
	        echo '<tr><td>';
	    	echo $item["limit_name"];
	    	echo '</td><td>';
            echo CHtml::textField($item["limit_name_f"], $item["limit_value"], array('class'=>'input-small righted', 'placeholder'=>''));
            echo "</td><td class='lefted hint'>";
            echo $descr[$item["limit_name_f"]];
            echo '</td></tr>';
        }
    }
    ?>
    </tr>
    <tr>
        <td>Re-crawl period</td>
        <td><?= CHtml::textField('recrawlPeriod', $itemsProvider->rawData[0]["recrawlPeriod"], array(
            'class' => 'input-small righted',
            'placeholder' => ''
            )) ?>
        </td>
        <td class="lefted hint"><?=$descr['recrawlPeriod']?></td>
    </tr>
    <tr>
        <td>Re-crawl date</td>
        <!--td><?=CHtml::textField('recrawlDate', '', array('class'=>'input-big', 'placeholder'=>''))?></td-->
        <td><input type = "date" class = 'input-mid' name = 'recrawlDate[date]'>  <input type = "time" class = 'input-mid' name = 'recrawlDate[time]' placeholder = '00:00:00'></td>
        <td class="lefted hint"><?=$descr['recrawlDate']?></td>
    </tr>
    <tr>
        <td>
            Root URLs

        </td>
        <td>
            <?=CHtml::ajaxButton('Root URLs integrity check', '/SitesView/integrityCheck', array(
                'type'=>'POST',
                'data'=>'id='.$itemsProvider->rawData[0]["id"],
                'success'=>"function(data) {
            $('.loader').remove();
            $('#page').append(data);
        }"
            ),
                array(
                    'class' => 'btn btn-default'
                )
            );?>
            <br><?=CHtml::textArea('rootUrls', $urls, array('class'=>'edit textarea-url'))?>
        </td>
        <td class="lefted hint"><?=$descr['rootUrls']?></td>
    </tr>
</table>