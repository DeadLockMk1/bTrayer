<table>
    <tr>
        <td>Creation date</td>
        <td><?=CHtml::textField('cDate', '', array('class'=>'input-big', 'placeholder'=>''))?></td>
    </tr>
    <tr>
        <td>Update date</td>
        <td><?=CHtml::textField('uDate', 'NOW()', array('class'=>'input-big', 'placeholder'=>''))?></td>
    </tr>
    <tr>
        <td>Touch date</td>
        <td><?=CHtml::textField('tcDate', 'NOW()', array('class'=>'input-big', 'placeholder'=>''))?></td>
    </tr>
    <tr>
        <td>Re-crawl date</td>
        <td><?=CHtml::textField('recrawlDate', '', array('class'=>'input-big', 'placeholder'=>''))?></td>
    </tr>
</table>