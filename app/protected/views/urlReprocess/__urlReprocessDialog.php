<div class = "dialog-overlay">
<div id = "recrawl-dialog">
    <h3>WARNING!</h3>
    <div>
        <p>
            After re-process resource’s 
            processed content will be updated. Real time when re-process will be started depends on many
            factors.
        </p>
    </div>
    <form action = "/UrlReprocess/reprocess" method = "post">
    <table>
        <tr>
            <td>
                <input type="submit" value="Re-process"/>
            </td>
            <td>
                <input type = "button" value = "Cancel" onclick = "cancelRecrawl()"/>
            </td>
            <td>
                <input type = "button" value = "Help" onclick = "showHelp()" disabled/>
            </td>
        </tr>
    </table>
    <?php
        echo CHtml::hiddenField('siteId', $siteId);
        echo CHtml::hiddenField('urlMd5', $urlMd5);
    ?>
    </form>
</div>
</div>