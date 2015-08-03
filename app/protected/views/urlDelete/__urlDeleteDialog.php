<div class = "dialog-overlay">
<div id = "delete-dialog">
    <h3>WARNING!</h3>
    <div>
        <p>
            After this operation all resource-related data including
            contents and URLs will be deleted!
        </p>
    </div>
    <form action = "/UrlDelete/delete" method = "post">
        <table>
            <tr>
                <td>
                    <input type="submit" value="Delete"/>
                </td>
                <td>
                    <input type = "button" value = "Cancel" onclick = "cancelDelete()"/>
                </td>
                <td>
                    <input type = "button" value = "Help" onclick = "showHelp()" disabled/>
                </td>
            </tr>
        </table>
        <?php
        echo CHtml::hiddenField('siteId', $siteId);
        echo CHtml::hiddenField('urlMd5', $urlMd5);
        echo CHtml::hiddenField('url', $urlType);
        ?>
    </form>
</div>
</div>