<div class = "dialog-overlay">
    <div id = "delete-dialog">
    <form action = "/SiteDelete/delete?siteId=<?=$id?>&state=<?=$state?>" method = "post">
        <h3>Delete Site</h3>
        <table>
            <tr>
                <td>Site ID</td>
                <td><?=$id?></td>
            </tr>
            <tr>
                <td>Delete task type</td>
                <td width = "100">
                    <select name = "type">
                        <option value = "1" selected>Synchronous</option>
                        <option value = "2">Asynchronous</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Timeout</td>
                <td><input type = "text" name = "timeout" class = "righted"></td>
            </tr>
            <tr>
                <td><input type = "submit" id = "delete-confirm"></td>
                 <td><input type = "button" value = "Cancel" onclick = "cancelDelete()"/></td>
            </tr>
        </table>
    </form>
</div>
</div>
