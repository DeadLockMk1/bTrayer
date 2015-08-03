<table>
<?php 
    foreach ($limitsProvider->rawData as $item){
    	if (($item["limit_name_f"]==='processingDelay') || ($item["limit_name_f"]==='maxResources')){
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
    <tr>
        <td>Scraping options set</td>
        <td id = "scraping-type" class = "hint wauto"><?=$scrapingType?></td>
        <td>
            <?php echo
                CHtml::ajaxButton('Set scrapping options', '/SiteNew/toolPicker', array(
                'type'=>'POST',
//                'async'=>false,
                'beforeSend'=>'function() {
                    $("body").prepend("<div class=\'loader-overlay\'><div class=\'loader\'>Loading...</div></div>");
                }',
                'success'=>"function(data) {
                    $('.loader-overlay').remove();
                    $('#page').append(data);
                    $(\"#Demo1\").append('<input type = \"button\" id = \"scrap-options-close\" value = \"Cancel\" class = \"btn btn-default\" onclick=\"tpModalClose()\">');
                    $(\"#Demo1\").append('<input type = \"button\" id = \"scrap-options-submit\" value = \"Apply\" class = \"btn btn-default\" onclick=\"tpModalApply()\">');
                    $(\"#Demo1\").children(\"ul\").first().remove();

                    $.ajax({
                        type: 'POST',
                        async: true,
                        url: '/SiteNew/getJsonData',
                        data: {
                                data: collectProps(),
                                url: getFirstRootUrl()
                              },
                        complete: function(data) {
                            try {
                                var data = JSON.parse(data.responseJSON);
                                console.info(data);
                                formFieldsObserver.init({container: '#Demo1_form'}).restoreFromStorage(data);
                            } catch(e) {}
                        }
                    });
                }",
            ),
                array(
                    'id' => 'picker-open',
                    'class' => 'btn btn-default',
                )
            )
            ?>
        </td>
    </tr>
</table>