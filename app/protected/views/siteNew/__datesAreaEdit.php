<table>
    <tr>
        <td>Re-crawl date</td>
        <td><?=CHtml::textField('recrawlDate', '', array('class'=>'input-big', 'placeholder'=>''));?></td>
    </tr>
</table>
<?=CHtml::hiddenField('cDate', 'now()');?>
<?=CHtml::hiddenField('tcDate', 'now()');?>