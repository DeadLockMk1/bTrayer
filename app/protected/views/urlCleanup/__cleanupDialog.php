<div class = "dialog-overlay">
    <div id = "cleanup-dialog">
    <h3>Cleanup</h3>
    <form action = "/UrlCleanup/cleanup" method = "post">
        <table>
            <tr>
                <td>Url</td>
                <td><?=$url?></td>
            </tr>
            <tr>
                <td>State</td>
                <td>
                    <?=CHtml::dropDownList('state', '', array(
                        '0' => 'Enabled',
                        '1' => 'Disabled',
                        '2' => 'Error',
                        ), 
                        array(
                            'options' => array(
                                '0' => Array(
                                    'selected' => 'selected'
                                    )
                                )
                            )
                    )?>
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <?=CHtml::dropDownList("status", '', array(
                        '0' => 'Undefined',
                        '1' => 'New',
                            ), 
                            array(
                                'options' => array(
                                    '1' => Array(
                                        'selected' => 'selected'
                                        )
                                    ),
                                'id'=>'status'
                            )
                    )?>
                </td>
            </tr>
        </table>
        <table>
            <tr colspan = 2>
                <td><input type = "submit" value = "CleanUp"/></td>
                <td><input type = "button" value = "Cancel" onclick = "cancelCleanup()"/></td>
                <td><input type = "button" value = "Help" disabled/></td>
            </tr>
        </table>
        <?php
            echo CHtml::hiddenField('siteId', $siteId);
            echo CHtml::hiddenField('url', $url);
            echo CHtml::hiddenField('urlType', $urlType);
        ?>
    </form>
</div>
</div>