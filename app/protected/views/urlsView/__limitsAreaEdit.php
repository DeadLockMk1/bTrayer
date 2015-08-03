<table>
    <?php foreach ($limitsProvider->rawData as $item): ?>
        <tr>
            <td><?php echo $item["limit_name"];?></td>
            <td><?=CHtml::textField($item["limit_name_f"], $item["limit_value"], array('class'=>'input-small righted', 'placeholder'=>''))?></td>
            <td class="lefted hint"><?=$descr[$item["limit_name_f"]]?></td>
        </tr>
    <?php endforeach;?>
</table>