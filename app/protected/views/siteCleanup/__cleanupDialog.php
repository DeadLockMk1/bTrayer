<div class = "dialog-overlay">
    <div id = "cleanup-dialog">
    <h3>Cleanup</h3>
    <form action = "/SiteCleanup/cleanup?siteId=<?=$id?>" method = "post">
        <table>
            <tr>
                <td>Site ID</td>
                <td><?=$id?></td>
            </tr>
            <tr>
                <td>Suspend site before cleanup</td>
                <td><input type = "checkbox" name = "suspend"/></td>
            </tr>
            <tr>
                <td>History cleanup</td>
                <td><input type = "checkbox" name = "history"/></td>
            </tr>
            <tr>
                <td>State after cleanup</td>
                <td>
                    <?php
                    echo  CHtml::dropDownList('state', '1', array(
                            '1' => 'Active',
                            '2' => 'Disabled',
                            '3' => 'Suspended'
                        ),
                        array(
                        'class'=> 'wauto'
                        )
                    );
                    ?>
                </td>
            </tr>
            <tr>
                <td>Timeout</td>
                <td><input name = "delay" type = "text" class = "righted"/></td>
            </tr>
            <tr>
                <td><input type = "submit" value = "CleanUp"/></td>
                <td><input type = "button" value = "Cancel" onclick = "cancelCleanup()"/></td>
            </tr>
        </table>
    </form>
</div>
</div>