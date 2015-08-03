<div class = "dialog-overlay">
    <div id = "integrityCheck-dialog" class = "basic-modal">
        <div>
            <p>
                <h4>Root URLs integrity check</h4>
            </p>
            <?
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'itemGrid',
                    'summaryText' => '',
                    'dataProvider' => $itemsProvider,
                    'htmlOptions'=>array('class'=>'integrity-diff'),
                    'columns' => array(
                        array(
                            'name' => 'dc_sites.sites_urls',
                            'type' => 'raw',
                            'value' => '$data["Sites"]',
                            'htmlOptions'=>array(
                                'class'=>'lefted',
                            ),
                        ),
                        array(
                            'name' => '',
                            'type' => 'html',
                            'value' => '$data["arrow"]',
                            'htmlOptions'=>array('class'=>'centred'),
                        ),
                        array(
                            'name' => 'dc_urls.urls',
                            'type' => 'raw',
                            'value' => '$data["URLs"]',
                            'htmlOptions'=>array('class'=>'righted'),
                        ),
                    )
                ));
            ?>
        </div>
        <form action = "/SitesView/integrityCheckRequest" method = "post" id = "integrityCheckForm">
            <table>
                <tr>
                    <td>
                        <input type="button" value="Fix from site's options" onclick = "integrityFixSubmit()"/>
                    </td>
                    <td>
                        <input type = "button" value = "Cancel" onclick = "cancelIntegrityCheck()"/>
                    </td>
                </tr>
            </table>
            <?php
            echo CHtml::hiddenField('id', $id);
            ?>
        </form>
    </div>
</div>