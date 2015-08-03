<div class = "dialog-overlay">
<div id = "recrawl-dialog">
    <h3>WARNING!</h3>
    <div>
        <p>
            After re-crawl process resource content will be fetched 
            from web-server and processed by processor according the site configuration. Content will be updated. 
            Real time when re-crawl process will be started depends on many factors.
        </p>
    </div>
    <form action = "/UrlRecrawl/recrawl" method = "post">
    <table>
        <tr>
            <td>
                <input type="submit" value="Re-crawl"/>
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
        echo CHtml::hiddenField('url', $url);
        echo CHtml::hiddenField('urlType', $urlType);
        echo CHtml::hiddenField('siteId', $siteId);
    ?>
    </form>
</div>
</div>