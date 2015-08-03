<form action = "/UrlsView/find" method = "get" class = "filter_form_res_TEST <?=$position?>" id = "urls-form" <?=$hidden?> >

    <div class="md-content" >
        <h3>Extended resources search <input type="button" class="md-close-button" onclick="toggleUrlsForm()" value="×" <?=$btn?>></h3>
    <table>
        <tr>
            <td class = "righted">Status:</td>
            <td><?=CHtml::dropDownList("form[status]", $status, array(
                    '' => 'Any',
                    '0' => 'Undefined',
                    '1' => 'New',
                    '2' => 'Selected for crawling',
                    '3' => 'Crawling',
                    '4' => 'Crawled',
                    '5' => 'Selected to process',
                    '6' => 'Processing',
                    '7' => 'Processed',
                    '8' => 'Selected for crawling (for incremental)'
                ),
                    array(
                        'options' => array(
                            $status => Array(
                                'selected' => 'selected'
                            )
                        ),
                        'class'=>'list-et',
                    )
                )?></td>
            <td class = "righted">HTTP Code:</td>
            <td><?=CHtml::textField("form[httpCode]", $httpCode, array('class'=>'text-et numeric', 'placeholder'=>'HTTP code', 'disabled' => false))?></td>
        </tr>
        <tr>
            <td class = "righted">State:</td>
            <td><?=CHtml::dropDownList('form[state]', $state, array('0' => 'Enabled', '1' => 'Disabled',), array('class' => 'list-et'));?></td>



            <td class = "righted">Depth:</td>
            <td>From <?=CHtml::textField("form[depthFrom]", $depthFrom, array('class'=>'input-short numeric', 'placeholder'=>'', 'disabled' => false))?> to
                <?=CHtml::textField("form[depthTo]", $depthTo, array('class'=>'input-short numeric', 'placeholder'=>'', 'disabled' => false))?>
            </td>
        </tr>
        <tr>
            <td class = "righted">Type:</td>
            <td><?=CHtml::dropDownList('form[type]', $type, array('0' => 'Regular', '1' => 'Single'), array('class' => 'list-et'));?></td>



            <td class = "righted">Touch date from:</td>
            <td><?=Chtml::dateField('form[tcDateFrom]',$tcDateFrom, array('class' => 'fDate',));?><?=CHtml::timeField('form[tcTimeFrom]', $tcTimeFrom, array('class' => 'fTime'));?></td>
        </tr>
        <tr>
            <td class = "righted">Site ID:*</td>
            <td><?=CHtml::textField("form[siteId]", $siteId, array('class'=>'text-et', 'placeholder'=>'Site ID (Site Md5)', 'required'=>'true'))?></td>



            <td class = "righted">to:</td>
            <td><?=Chtml::dateField('form[tcDateTo]', $tcDateTo, array('class' => 'fDate',));?><?=CHtml::timeField('form[tcTimeTo]', $tcTimeTo, array('class' => 'fTime'));?></td>
        </tr>
        <tr>
            <td class = "righted">Resource ID:</td>
            <td><?=CHtml::textField("form[resourceId]", $resourceId, array('class'=>'text-et', 'placeholder'=>'Resource ID (URL Md5)', 'disabled' => false))?></td>



            <td class = "righted">Creation date from:</td>
            <td><?=Chtml::dateField('form[cDateFrom]', $cDateFrom, array('class' => 'fDate',));?><?=CHtml::timeField('form[cTimeFrom]', $cTimeFrom, array('class' => 'fTime'));?></td>
        </tr>
        <tr>
            <td class = "righted">Resource URL:</td>
            <td><?=CHtml::textField("form[resourceURL]", $resourceURL, array('class'=>'text-et', 'placeholder'=>'URL or its part', 'disabled' => false))?></td>



            <td class = "righted">to:</td>
            <td><?=Chtml::dateField('form[cDateTo]', $cDateTo, array('class' => 'fDate',));?><?=CHtml::timeField('form[cTimeTo]', $cTimeTo, array('class' => 'fTime'));?></td>
        </tr>
        <tr>
            <td class = "righted">Parent URL:</td>
            <td><?=CHtml::textField("form[parentUrl]", $parentUrl, array('class'=>'text-et', 'placeholder'=>'Parent URL', 'disabled' => false))?></td>



            <td class = "righted">Publication date from:</td>
            <td><?=Chtml::dateField('form[pDateFrom]', $pDateFrom, array('class' => 'fDate',));?><?=CHtml::timeField('form[pTimeFrom]', $pTimeFrom, array('class' => 'fTime'));?></td>
        </tr>
        <tr>
            <td class = "righted">Content type:</td>
            <td><?=CHtml::textField("form[contentType]", $contentType, array('class'=>'text-et', 'placeholder'=>'Content type', 'disabled' => false))?></td>



            <td class = "righted">to:</td>
            <td><?=Chtml::dateField('form[pDateTo]', $pDateTo, array('class' => 'fDate',));?><?=CHtml::timeField('form[pTimeTo]', $pTimeTo, array('class' => 'fTime'));?></td>
        </tr>
        <tr>
            <td class = "righted">Error mask</td>
            <td><?=CHtml::textField('form[errorMask]', $errorMask, array('class' => 'text-et numeric mask', 'placeholder'=>'Error mask'));?><input class="md-trigger et-inside-bttn" data-modal="create-error-mask" type="button" value="+"></td>



            <td class = "righted">Only root URLs:</td>
            <td><?=CHtml::checkBox('form[onlyRoot]', $onlyRoot, array('class'=>'checkbox-big'))?></td>
        </tr>

        <tr>
            <td class = "righted">Tags mask:</td>
            <td><?=CHtml::textField("form[tagsMask]", $tagsMask, array('class'=>'text-et numeric mask', 'placeholder'=>'Tags mask', 'disabled' => false))?><input class="md-trigger et-inside-bttn" data-modal="create-tags-mask" type="button" value="+"></td>
            <td class = "righted">Sort by:</td>
            <td><?=CHtml::dropDownList("form[sortBy]", '', array(
                    'CDate' => 'Creation date',
                    'UDate' => 'Update date',
                    'TcDate' => 'Touch date',
                    'Crawled' => 'Crawled',
                    'Processed' => 'Processed',
                    'CrawlingTime' => 'Crawling time',
                    'ProcessingTime' => 'Processing time',
                    'TotalTime' => 'Total time',
                    'Size' => 'Size',
                    'Freq' => 'Frequency',
                    'Depth' => 'Depth',
                    'LastModified' => 'Last modified',
                    'TagsCount' => 'Tags count',
                    'PDate' => 'Publication date',
                ),
                    array(
                        'options' => array(
                            $sortBy=> array(
                                'selected' => 'selected'
                            )
                        ),
                        'id'=>'sortBy',
                        'class'=>'fDate'
                    )
                )
                ?>
                <?=CHtml::dropDownList("form[sortDirection]", '', array(
                    'ASC' => 'ASC',
                    'DESC' => 'DESC',
                ),
                    array(
                        'options' => array(
                            $sortDirection=> Array(
                                'selected' => 'selected'
                            ),
                        ),
                        'id'=>'sortDirection',
                        'class'=>'fTime'
                    )
                )
                ?>
            </td>
        </tr>

        <tr>
            <td class = "righted">Tags count:</td>
            <td><?=CHtml::textField("form[tagsCount]", $tagsCount, array('class'=>'text-et numeric ', 'placeholder'=>'Tags count', 'disabled' => false))?></td>
        </tr>
        <tr>
            <td colspan = "4" class = "centred">Items per page: <?=CHtml::dropDownList("form[limit]", $limit, array(
                    '10' => '10',
                    '20' => '20',
                    '30' => '30',
                    '40' => '40',
                    '50' => '50',
                    '60' => '60',
                    '70' => '70',
                    '80' => '80',
                    '90' => '90',
                    '100' => '100',
                ),
                    array(
                        'options' => array(
                            $limit => Array(
                                'selected' => 'selected'
                            )
                        ),
                        'id'=>'limit'
                    )
                )
                ?></td>
        </tr>
        <tr>
            <td colspan = "4"><?=CHtml::submitButton('Submit', array('id'=>'submit-res'))?></td>
        </tr>
    </table>
    <?php
    if ($page != '0') {
        echo CHtml::hiddenField('form[pN]', $page);
    } else {
        echo CHtml::hiddenField('form[pN]', '1');
    }
    ?>
    </div>
</form>
<div class="md-modal md-effect-9" id="create-tags-mask">
    <div class="md-content">
        <h3>Tags:</h3>
        <table>
            <tr>
                <td style="padding-left: 5em">
                    <?php
                    echo CHtml::checkBoxList('ltagsToMask', '', array(
                        '0' => 'media',
                        '1' => 'publication date',
                        '2' => 'content_encoded',
                        '3' => 'title',
                        '4' => 'link',
                        '5' => 'description',
                        '6' => 'UPDATED_PARSED',
                        '7' => 'creation date',
                        '8' => 'author',
                        '9' => 'guid (rss)',
                        '10' => 'keywords',
                        '11' => 'media thumbnail',
                    ),
                        array(
                            'container' => 'div',
                            'template' => '{input} - {label}',
                            'class' => 'checkbox-big',
                        ));
                    ?>
                </td>
                <td style="padding-left: 5em">
                    <?php
                    echo CHtml::checkBoxList('rtagsToMask', '', array(
                        '12' => 'enclosure (rss)',
                        '13' => 'media (rss)',
                        '14' => 'google search',
                        '15' => 'google search total',
                        '16' => 'html lang',
                        '17' => 'parent rss',
                        '18' => 'parent rss urlmd5',
                        '19' => 'summary detail',
                        '20' => 'summary',
                        '21' => 'comments',
                        '22' => 'tags (rss)',
                        '23' => 'updated',
                    ),
                        array(
                            'container' => 'div',
                            'template' => '{input} - {label}',
                            'class' => 'checkbox-big',
                        ));
                    ?>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 5em">
                    <?php
                    echo CHtml::checkBoxList('lntagsToMask', '', array(
                        '-1' => 'No tags',
                    ),
                        array(
                            'container' => 'div',
                            'template' => '{input} - {label}',
                            'class' => 'checkbox-big',
                        ));
                    ?>
                </td>
                <td style="padding-left: 5em">
                    <?php
                    echo CHtml::checkBoxList('ratagsToMask', '', array(
                        'Any' => 'Any',
                    ),
                        array(
                            'container' => 'div',
                            'template' => '{input} - {label}',
                            'class' => 'checkbox-big',
                        ));
                    ?>
                </td>
            </tr>
        </table>
        <div class="md-buttons">
            <button id="genTMask">Create Mask</button>
            <button class="md-close" id="cancel-genTMask">Cancel</button>
        </div>
    </div>
</div>
<div class="md-modal md-effect-9" id="create-error-mask">
    <div class="md-content">
        <h3>Errors:</h3>
        <table>
            <tr>
                <td style="padding-left: 5em">
                    <?php
                    echo CHtml::checkBoxList('lerrorsToMask', '', array(
                        '0' => 'Wrong URL',
                        '1' => 'Timeout',
                        '2' => 'HTTP error',
                        '3' => 'Empty content',
                        '4' => 'Wrong MIME type',
                        '5' => 'Connection error',
                        '6' => 'Code page convert error',
                        '7' => 'Bad redirection',
                        '8' => 'Size error',
                        '9' => 'Authorization error',
                        '10' => 'File operation error',
                        '11' => 'Robots.txt rule not matched',
                        '12' => 'HTML parse error',
                        '13' => 'Bad encoding',
                        '14' => 'Max errors',
                        '15' => 'Max resources',
                        '16' => 'Raw content not stored',
                        '17' => 'Max HTTP redirects',
                        '18' => 'MAX HTML redirects',
                    ),
                        array(
                            'container' => 'div',
                            'template' => '{input} - {label}',
                            'class' => 'checkbox-big',
                        ));
                    ?>
                </td>
                <td style="padding-left: 5em">
                    <?php
                    echo CHtml::checkBoxList('rerrorsToMask', '', array(
                        '19' => 'Wrong HTML structure',
                        '20' => 'Wrong DTD',
                        '21' => 'Content-Type detection',
                        '22' => 'Fetcher ambiguous request',
                        '23' => 'Connection',
                        '24' => 'HTTP request',
                        '25' => 'Wrong URL',
                        '26' => 'Max redirects',
                        '27' => 'Connection timeout',
                        '28' => 'Read timeout',
                        '29' => 'Fetch timeout',
                        '30' => 'FETCH_UNDEFINED',
                        '31' => 'General fault',
                        '32' => 'Max errors',
                        '33' => 'Max resources',
                        '34' => 'Unsupported Content-Type',
                        '35' => 'URL encoding',
                        '36' => 'Scraping fault',
                        '37' => 'Raw content absent',
                    ),
                        array(
                            'container' => 'div',
                            'template' => '{input} - {label}',
                            'class' => 'checkbox-big',
                        ));
                    ?>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 5em">
                    <?php
                    echo CHtml::checkBoxList('lnerrorsToMask', '', array(
                        '-1' => 'No errors',
                    ),
                        array(
                            'container' => 'div',
                            'template' => '{input} - {label}',
                            'class' => 'checkbox-big',
                        ));
                    ?>
                </td>
                <td style="padding-left: 5em">
                    <?php
                    echo CHtml::checkBoxList('raerrorsToMask', '', array(
                        'Any' => 'Any',
                    ),
                        array(
                            'container' => 'div',
                            'template' => '{input} - {label}',
                            'class' => 'checkbox-big',
                        ));
                    ?>
                </td>
            </tr>
        </table>
        <div class="md-buttons">
            <button id="genEMask">Create Mask</button>
            <button class="md-close" id="cancel-genEMask">Cancel</button>
        </div>
    </div>
</div>



<div class="md-overlay"></div>
<script src="/js/modals/classie.js"></script>
<script src="/js/modals/modalEffects.js"></script>
<script>
    var polyfilter_scriptpath = '/js/modals/';
    $("#lnerrorsToMask_0").change(function () {
        var state = $("#lnerrorsToMask_0").prop('checked');
        if (state) {
            $("#lerrorsToMask").children("input[type='checkbox']").attr('checked', false);
            $("#rerrorsToMask").children("input[type='checkbox']").attr('checked', false);
            $("#rerrorsToMask").children("input[type='checkbox']").attr('disabled', true);
            $("#lerrorsToMask").children("input[type='checkbox']").attr('disabled', true);
            $("#raerrorsToMask_0").attr('checked', false);
        } else {
            $("#rerrorsToMask").children("input[type='checkbox']").attr('disabled', false);
            $("#lerrorsToMask").children("input[type='checkbox']").attr('disabled', false);
        }
    });
    $("#raerrorsToMask_0").change(function () {
        var state = $("#raerrorsToMask_0").prop('checked');
        if (state) {
            $("#lerrorsToMask").children("input[type='checkbox']").attr('checked', false);
            $("#rerrorsToMask").children("input[type='checkbox']").attr('checked', false);
            $("#rerrorsToMask").children("input[type='checkbox']").attr('disabled', true);
            $("#lerrorsToMask").children("input[type='checkbox']").attr('disabled', true);
            $("#lnerrorsToMask_0").attr('checked', false);
        } else {
            $("#rerrorsToMask").children("input[type='checkbox']").attr('disabled', false);
            $("#lerrorsToMask").children("input[type='checkbox']").attr('disabled', false);
        }
    });
    $("#lntagsToMask_0").change(function () {
        var state = $("#lntagsToMask_0").prop('checked');
        if (state) {
            $("#ltagsToMask").children("input[type='checkbox']").attr('checked', false);
            $("#rtagsToMask").children("input[type='checkbox']").attr('checked', false);
            $("#rtagsToMask").children("input[type='checkbox']").attr('disabled', true);
            $("#ltagsToMask").children("input[type='checkbox']").attr('disabled', true);
            $("#ratagsToMask_0").attr('checked', false);
        } else {
            $("#rtagsToMask").children("input[type='checkbox']").attr('disabled', false);
            $("#ltagsToMask").children("input[type='checkbox']").attr('disabled', false);
        }
    });
    $("#ratagsToMask_0").change(function () {
        var state = $("#ratagsToMask_0").prop('checked');
        if (state) {
            $("#ltagsToMask").children("input[type='checkbox']").attr('checked', false);
            $("#rtagsToMask").children("input[type='checkbox']").attr('checked', false);
            $("#rtagsToMask").children("input[type='checkbox']").attr('disabled', true);
            $("#ltagsToMask").children("input[type='checkbox']").attr('disabled', true);
            $("#lntagsToMask_0").attr('checked', false);
        } else {
            $("#rtagsToMask").children("input[type='checkbox']").attr('disabled', false);
            $("#ltagsToMask").children("input[type='checkbox']").attr('disabled', false);
        }
    });
</script>
<script src="/js/modals/cssParser.js"></script>
