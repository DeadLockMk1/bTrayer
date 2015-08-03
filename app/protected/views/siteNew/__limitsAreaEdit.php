<!--Crawling-->
<table>
    <tr>
        <td>Description</td>
        <td><?= CHtml::textField('description', '', array(
                'class' => 'input-big',
                'placeholder' => '65 chars maximum',
                'maxlength' => '65'
            )) ?></td>
        <td class="lefted hint"><?=$descr['description']?></td>
    </tr>
    <tr>
        <td>Root URLs</td>
        <td><?=CHtml::textArea('rootUrls', '', array('class'=>'edit textarea-url'))?></td>
        <td class="lefted hint"><?=$descr['rootUrls']?></td>
    </tr>
    <tr>
        <td>State</td>
        <td><?= CHtml::dropDownList('state', '', array(
                '1' => 'Active',
                '2' => 'Disabled',
                '3' => 'Suspended'
            ),
                array(
                    'options' => array(
                        '3' => Array(
                            'selected' => 'selected'
                        )
                    )
                )
            )?>
        </td>
        <td class="lefted hint"><?=$descr['state']?></td>
    </tr>
    <tr>
        <td>URL type</td>
        <td><?= CHtml::dropDownList('urlType', '', array(
            '0' => 'Regular',
            '1' => 'Single',
        ),
        array(
            'options' => array(
                '0' => Array(
                    'selected' => 'selected'
                    )
                )
            )
        )?>
        </td>
        <td class="lefted hint"><?=$descr['urlType']?></td>
    </tr>
    <tr>
        <td>Fetch type</td>
        <td><?= CHtml::dropDownList('fetchType', '', array(
            '1' => 'Static',
            '2' => 'Dynamic',
            '3' => 'External'
        ),
        array(
            'options' => array(
               '1' => Array(
                    'selected' => 'selected'
                    )
                )
            )
        )?>
        </td>
        <td class="lefted hint"><?=$descr['fetchType']?></td>
    </tr>
    <tr>
        <td>Priority</td>
        <td><?=CHtml::textField('priority', $defaults['priority'], array('class'=>'input-small righted', 'placeholder'=>$defaults['priority']))?></td>
        <td class="lefted hint"><?=$descr['priority']?></td>
    </tr>
    <tr>
        <td>Max URLs</td>
        <td><?=CHtml::textField('maxURLs', $defaults['maxURLs'], array('class'=>'input-small righted', 'placeholder'=>$defaults['maxURLs']))?></td>
        <td class="lefted hint"><?=$descr['maxURLs']?></td>
    </tr>
    <tr>
        <td>Max errors</td>
        <td><?=CHtml::textField('maxErrors', $defaults['maxErrors'], array('class'=>'input-small righted', 'placeholder'=>$defaults['maxErrors']))?></td>
        <td class="lefted hint"><?=$descr['maxErrors']?></td>
    </tr>
    <tr>
        <td>Max resource size</td>
        <td><?=CHtml::textField('maxResourceSize', $defaults['maxResourceSize'], array('class'=>'input-small righted', 'placeholder'=>$defaults['maxResourceSize']))?></td>
        <td class="lefted hint"><?=$descr['maxResourceSize']?></td>
    </tr>
    <tr>
        <td>Max URLs from page</td>
        <td><?=CHtml::textField('maxURLsFromPage', $defaults['maxURLsFromPage'], array('class'=>'input-small righted', 'placeholder'=>$defaults['maxURLsFromPage']))?></td>
        <td class="lefted hint"><?=$descr['maxURLsFromPage']?></td>
    </tr>
    <tr>
        <td>Request delay</td>
        <td><?=CHtml::textField('requestDelay', $defaults['requestDelay'], array('class'=>'input-small righted', 'placeholder'=>$defaults['requestDelay']))?></td>
        <td class="lefted hint"><?=$descr['requestDelay']?></td>
    </tr>
    <tr>
        <td>HTTP timeout</td>
        <td><?=CHtml::textField('httpTimeout', $defaults['httpTimeout'], array('class'=>'input-small righted', 'placeholder'=>$defaults['httpTimeout']))?></td>
        <td class="lefted hint"><?=$descr['httpTimeout']?></td>
    </tr>
    <tr>
        <td>Re-crawl period</td>
        <td><?= CHtml::textField('recrawlPeriod', '360', array('class' => 'input-small righted', 'placeholder' => '')) ?></td>
        <td class="lefted hint"><?=$descr['recrawlPeriod']?></td>
    </tr>
</table>
<?=CHtml::hiddenField('iterations', '0')?>
<?=CHtml::hiddenField('recrawlDate', 'DATE_ADD(DATE_FORMAT(NOW(),"%Y-%m-%d 00:00:00"), INTERVAL ( CEIL( ( ( HOUR(NOW())*60 + MINUTE(NOW()) + SECOND(NOW())/60) / `RecrawlPeriod` )*`RecrawlPeriod` ) + `RecrawlPeriod` ) MINUTE)')?>
<?=CHtml::hiddenField('resources', '0')?>
<?=CHtml::hiddenField('contents', '0')?>
<?=CHtml::hiddenField('errors', '0')?>
<?=CHtml::hiddenField('errorMask', '0')?>
<?=CHtml::hiddenField('avgSpeed', '0')?>
<?=CHtml::hiddenField('avgSpeedCounter', '0')?>
<?=CHtml::hiddenField('collectedURLs', '0')?>
<?=CHtml::hiddenField('newURLs', '0')?>
<?=CHtml::hiddenField('deletedURLs', '0')?>
<?=CHtml::hiddenField('size', '0')?>
<?=CHtml::hiddenField('userId', Yii::app()->user->id)?>