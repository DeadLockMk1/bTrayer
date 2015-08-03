<?php
echo CHtml::ajaxButton('Raw content', '/UrlsView/content', array(
        'type'=>'POST',
        'data'=>'siteId='.$p["siteId"].'&url='.$p["url"].'&urlMd5='.$p["urlMd5"].'&t=0&mask=1026',
        'update'=>'#editor',
        'success'=>"function(data) {
            $('.loader').remove();
            $('#editor').empty();
            $('#editor').html(data);
        }",
        "error"=>"
            function(xhr){
                $('#editor').empty();
                $('#editor').html(xhr.responseText);
            }
        "
    ),
    array(
        'id' => 'loadContentR',
        'class' => 'btn btn-default'
    )
);

echo CHtml::ajaxButton('Processed content', '/UrlsView/content', array(
    'type'=>'POST',
    'data'=>'siteId='.$p["siteId"].'&url='.$p["url"].'&urlMd5='.$p["urlMd5"].'&t=1&mask=3',
    'update'=>'#ajaxContent',
    'success'=>"function(data) {
//            var opt = {
//                change: function(data) {  },
//                propertyclick: function(path) { /* called when a property is clicked with the JS path to that property */ }
//            };
//            opt.propertyElement = '<textarea>';
//            opt.valueElement = '<textarea>';
//            $('#editor').jsonEditor(JSON.parse(data), opt);

            $('#editor').empty();
            $('#editor').html(data);
            var input = eval('(' + data + ')');
			$('#editor').jsonViewer(input);
			$('#log pre').prepend('\\n');
			$('#log pre').prepend(data);
			$('#log pre').prepend('\\n');
			$('#log pre').prepend('['+curDateISO()+'] >>> Buffer_Decoded ->\\n');
			$('#log pre').prepend('\\n\\n['+curDateISO()+'] >>> Operation ->URL_CONTENT\\n\\n');
            $('.loader').remove();
        }",
    "error"=>"
            function(xhr){
                $('#editor').empty();
                $('#editor').html(xhr.responseText);
            }
        "
),
    array(
        'id' => 'loadContentP',
        'class' => 'btn btn-default'
    )
);
echo CHtml::ajaxButton('Raw content (tidy)', '/UrlsView/content', array(
    'type'=>'POST',
    'data'=>'siteId='.$p["siteId"].'&url='.$p["url"].'&urlMd5='.$p["urlMd5"].'&t=2&mask=258',
    'update'=>'#editor',
    'success'=>"function(data) {
            $('.loader').remove();
            $('#editor').empty();
            $('#editor').html(data);
        }",
    "error"=>"
            function(xhr){
                $('#editor').empty();
                $('#editor').html(xhr.responseText);
            }
        "
),
    array(
        'id' => 'loadContentT',
        'class' => 'btn btn-default'
    )
);
echo CHtml::ajaxButton('HTTP headers', '/UrlsView/content', array(
    'type'=>'POST',
    'data'=>'siteId='.$p["siteId"].'&url='.$p["url"].'&urlMd5='.$p["urlMd5"].'&t=3&mask=1042',
    'update'=>'#editor',
    'success'=>"function(data) {
            $('.loader').remove();
            $('#editor').empty();
            $('#editor').html('<pre>'+data+'</pre>');
        }",
    "error"=>"
            function(xhr){
                $('#editor').empty();
                $('#editor').html(xhr.responseText);
            }
        "
),
    array(
        'id' => 'loadContentH',
        'class' => 'btn btn-default'
    )
);
echo CHtml::ajaxButton('HTTP cookies', '/UrlsView/content', array(
    'type'=>'POST',
    'data'=>'siteId='.$p["siteId"].'&url='.$p["url"].'&urlMd5='.$p["urlMd5"].'&t=4&mask=1154',
    'update'=>'#editor',
    'success'=>"function(data) {
            $('.loader').remove();
            $('#editor').empty();
            $('#editor').html('<pre>'+data+'</pre>');
        }",
    "error"=>"
            function(xhr){
                $('#editor').empty();
                $('#editor').html(xhr.responseText);
            }
        "
),
    array(
        'id' => 'loadContentC',
        'class' => 'btn btn-default'
    )
);
echo CHtml::ajaxButton('HTTP requests', '/UrlsView/content', array(
    'type'=>'POST',
    'data'=>'siteId='.$p["siteId"].'&url='.$p["url"].'&urlMd5='.$p["urlMd5"].'&t=5&mask=1058',
    'update'=>'#editor',
    'success'=>"function(data) {
            $('.loader').remove();
            $('#editor').empty();
            $('#editor').html('<pre>'+data+'</pre>');
        }",
    "error"=>"
            function(xhr){
                $('#editor').empty();
                $('#editor').html(xhr.responseText);
            }
        "
),
    array(
        'id' => 'loadContentRq',
        'class' => 'btn btn-default'
    )
);
echo CHtml::ajaxButton('HTTP meta data', '/UrlsView/content', array(
    'type'=>'POST',
    'data'=>'siteId='.$p["siteId"].'&url='.$p["url"].'&urlMd5='.$p["urlMd5"].'&t=6&mask=66',
    'update'=>'#editor',
    'success'=>"function(data) {
            $('.loader').remove();
            $('#editor').empty();
            $('#editor').html('<pre>'+data+'</pre>');
        }",
    "error"=>"
            function(xhr){
                $('#editor').empty();
                $('#editor').html(xhr.responseText);
            }
        "
),
    array(
        'id' => 'loadContentM',
        'class' => 'btn btn-default'
    )
);
echo CHtml::ajaxButton('Dynamic content', '/UrlsView/content', array(
    'type'=>'POST',
    'data'=>'siteId='.$p["siteId"].'&url='.$p["url"].'&urlMd5='.$p["urlMd5"].'&t=7&mask=514',
    'update'=>'#editor',
    'success'=>"function(data) {
            $('.loader').remove();
            $('#editor').empty();
            $('#editor').html(data);
        }",
    "error"=>"
            function(xhr){
                $('#editor').empty();
                $('#editor').html(xhr.responseText);
            }
        "
),
    array(
        'id' => 'loadContentD',
        'class' => 'btn btn-default'
    )
);
?>
<div id="flexiJson">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.json-viewer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.json-viewer.css" />
<link rel="stylesheet" href="/css/jsoneditor.css"/>
<script src="/js/jquery.jsoneditor.js"></script>
<div id="editor" class="json-editor"></div>
</div>
