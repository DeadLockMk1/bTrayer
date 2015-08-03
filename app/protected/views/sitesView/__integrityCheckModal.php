<div class = "dialog-overlay">
<div id = "integrityCheck-dialog" class = "basic-modal">
    <h3>Root URLs integrity check</h3>
    <div>
        <p>
            This operation will start the process of comparing lists of site root URLs
            <br> from tables: "dc_sites.sites_urls" and "dc_urls.urls_SITE_ID".
        </p>
    </div>
    <form action = "/SitesView/integrityCheckRequest" method = "post" id = "integrityCheckForm">
        <table>
            <tr>
                <td>
                    <input type="button" value="Confirm" onclick = "integrityCheckSubmit()"/>
                </td>
                <td>
                    <input type = "button" value = "Cancel" onclick = "cancelIntegrityCheck()"/>
                </td>
                <td>
                    <input type = "button" value = "Help" onclick = "showHelp()" disabled/>
                </td>
            </tr>
        </table>
        <?php
        echo CHtml::hiddenField('id', $id);
        ?>
    </form>
</div>
</div>