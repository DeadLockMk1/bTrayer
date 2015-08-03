<div id = "props-hint" class = "phint">
    <p>
        <?=$descr['properties']?>
    </p>
</div>
<table>
    <tr>
        <td colspan="3"><a href="#" id = "add-prop" class = "btn btn-default" onclick="addNewProperty()">Add new property</a></td>
    </tr>
    <tr>
        <th id = "gr-s-sn-prop-name">Property name</th>
        <th id = "gr-s-sn-prop-value">Value</th>
        <th></th>
    </tr>
</table>
<table id = "props-wrapper">
<?php foreach ($propsProvider->rawData as $k => $val):?>
    <tr>
        <td width='20%'><?=CHtml::textfield($val["name"], $val['name'], array('class'=>'gr-s-fe-prop-name'))?></td>
        <td><?=CHtml::textArea($val["name"], $val['value'], array('class'=>'edit textarea-big gr-s-fe-prop-val'))?></td>
        <td width = "10em" class = "remove-column"><a href = "#" class = "removeclassp act-btn">Remove</a></td>
    </tr>
<?php endforeach;?>
</table>