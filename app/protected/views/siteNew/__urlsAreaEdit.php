<!--Processing-->

<table>
 	<tr>
        <td>Max resources</td>
        <td><?=CHtml::textField('maxResources', $defaults['maxResources'], array('class'=>'input-small righted', 'placeholder'=>$defaults['maxResources']))?></td>
        <td class="lefted hint"><?=$descr['maxResources']?></td>
    </tr>
    <tr>
        <td>Processing delay</td>
        <td><?=CHtml::textField('processingDelay', $defaults['processingDelay'], array('class'=>'input-small righted', 'placeholder'=>$defaults['processingDelay']))?></td>
        <td class="lefted hint"><?=$descr['processingDelay']?></td>
    </tr>
    <tr>
        <td>Scraping options set</td>
        <td id = "scraping-type" class = "hint wauto">NOT SET</td>
        <td>
            <?=CHtml::ajaxButton('Set scrapping options', '/SiteNew/toolPicker', array(
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
                    var t = propExists(\"template\");
                    if (!t) {
                        return false;
                    }
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
