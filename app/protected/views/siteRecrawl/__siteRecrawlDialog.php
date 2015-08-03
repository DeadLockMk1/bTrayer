<div class = "dialog-overlay">
    <div id = "recrawl-dialog">
    <h3>Re-crawl</h3>
    <form action = "/SiteRecrawl/recrawl" method = "post">
        <table>
            <tr>
                <td>Site ID</td>
                <td><?=$id?></td>
            </tr>
            <tr>
                <td>Cleanup site before re-crawl</td>
                <td><input type = "checkbox" name = "cleanup"/></td>
            </tr>
            <tr>
                <td>Timeout</td>
                <td><input name = "delay" type = "text" class = "righted"/></td>
            </tr>
            <tr>
                <td><input type = "submit" value = "Re-crawl"/></td>
                <td><input type = "button" value = "Cancel" onclick = "cancelRecrawl()"/></td>
            </tr>
        </table>
        <input type = "hidden" name = "iterations" value = "<?=$iterations?>"/>
        <input type = "hidden" name = "id" value = "<?=$id?>"/>
    </form>
</div>
</div>