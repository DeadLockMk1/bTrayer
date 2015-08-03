<div class = "dialog-overlay">
<div id = "dw-dialog">
    <h3>DOWNLOAD</h3>
    <form action = "/ResourceDownload/dw" method = "post">
        <table>
            <tr>
                <td class = "righted">
                    <input name = "options[10]" type="checkbox" value="1"/>
                </td>
                <td class = "lefted">
                    Raw content
                </td>
                <td class = "righted">
                    <input name = "options[4]" type="checkbox" value="1"/>
                </td>
                <td class = "lefted">
                    HTTP headers
                </td>
            </tr>
            <tr>
                <td class = "righted">
                    <input name = "options[0]" type="checkbox" value="1" checked/>
                </td>
                <td class = "lefted">
                    Processed content
                </td>
                <td class = "righted">
                    <input name = "options[7]" type="checkbox" value="1"/>
                </td>
                <td class = "lefted">
                    HTTP cookies
                </td>
            </tr>
            <tr>
                <td class = "righted">
                    <input name = "options[5]" type="checkbox" value="1"/>
                </td>
                <td class = "lefted">
                    HTTP request
                </td>
                <td class = "righted">
                    <input name = "options[6]" type="checkbox" value="1"/>
                </td>
                <td class = "lefted">
                    HTTP meta data
                </td>
            </tr>
            <tr>
                <td class = "righted">
                    <input name = "options[8]" type="checkbox" value="1"/>
                </td>
                <td class = "lefted">
                    Fixed by tidy lib
                </td>
                <td class = "righted">
                    <input name = "options[9]" type="checkbox" value="1"/>
                </td>
                <td class = "lefted">
                    Dynamic
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class = "centred">
                    Crawled:
                </td>
                <td class = "lefted">
                    <select name = "options[crawled]">
                        <option value = "1" selected>Last</option>
                        <option value = "2">First</option>
                        <option value = "3">All</option>
                    </select>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class = "centred">
                    <input type="submit" value="Download"/>
                </td>
                <td  class = "centred">
                    <input type = "button" value = "Cancel" onclick = "cancelDw()"/>
                </td>
                <td  class = "centred">
                    <input type = "button" value = "Help" onclick = "showHelp()" disabled/>
                </td>
            </tr>
        </table>
        <?php
            echo CHtml::hiddenField('options[siteId]', $siteId);
            echo CHtml::hiddenField('options[url]', $url);
            echo CHtml::hiddenField('options[urlMd5]', $urlMd5);
        ?>
</form>
</div>
</div>