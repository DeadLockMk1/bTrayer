<table>
    <tr>
        <td>State</td>
        <td><?=CHtml::textField('state', $itemsProvider->rawData[0]["state"], array('class'=>'input-small', 'placeholder'=>''))?></td>
    </tr>
    <tr>
        <td>Recrawl period</td>
        <td><?=CHtml::textField('recrawlPeriod', $itemsProvider->rawData[0]["recrawlPeriod"], array('class'=>'input-small', 'placeholder'=>''))?></td>
    </tr>
     <tr>
        <td>Description</td>
        <td><?=CHtml::textField('description', $itemsProvider->rawData[0]["description"], array('class'=>'input-big', 'placeholder'=>'65 chars max', 'maxlength'=>'65'))?></td>
    </tr>
     <?php echo CHtml::textField('id', $itemsProvider->rawData[0]["id"], array('hidden'=>'true'));?>
</table>
