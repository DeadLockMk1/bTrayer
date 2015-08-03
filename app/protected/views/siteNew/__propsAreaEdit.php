<div id = "props-hint" class = "hint">
    <p>
        <?=$descr['properties']?>
    </p>
</div>
<table>
    <tr>
        <td class = "lefted" colspan="3"><a href="#" id = "add-prop" class = "btn btn-default" onclick="addNewProperty()">Add new property</a></td>

    </tr>
    <tr>
        <th id = "gr-s-sn-prop-name">Property name</th>
        <th id = "gr-s-sn-prop-value">Value</th>
        <th></th>
    </tr>
</table>
<table id = "props-wrapper">
    <?php foreach ($props as $name => $value):?>
    <tr>
        <td width='20%'><?=CHtml::textfield('', $name, array('class'=>'gr-s-fe-prop-name'))?></td>
        <td><?=CHtml::textArea('', $value, array('class'=>'edit textarea-big gr-s-fe-prop-val'))?></td>
        <td width = "10em" class = "remove-column"><a href = "#" class = "removeclassp act-btn">Remove</a></td>
    </tr>
    <?php endforeach;?>
</table>
<script type="text/javascript">
    $("#rootUrls").change(function () {
//        if(!checkUrls()){
//            return false;
//        }
        $(".gr-s-fe-prop-name").each(function(e) {
            if ( $(this).val() == 'SITE_ID_MD5_SOURCE' ) {
                $(this).parent().parent().remove();
            }
        });
        var urlsArr = $('#rootUrls').val().split("\n");
        var result = $('#userId').val()+'-'+urlsArr[0];
        addProperty('SITE_ID_MD5_SOURCE', result);
    });
</script>