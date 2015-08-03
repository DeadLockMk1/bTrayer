<?php
$data = Yii::app()->getRequest();
if ($data->getPost('value') == 'news_template') {
    $name = "template";
    $value = '{"templates":[{"output_format":{"name":"json","header":"[\n","items_header":"","item":"{\n\"pubdate\":\"%pubdate%\",\n\"title\":\"%title%\",\n\"media\":\"%media%\",\n\"author\":\"%author%\",\n\"dc_date\":\"%dc_date%\",\n\"link\":\"%link%\",\n\"keywords\":\"%keywords%\",\n\"content_encoded\":\"%content_encoded%\",\n\"html_lang\":\"%html_lang%\"\n}\n","items_footer":"","footer":"]\n"},"tags":{"pubdate":{"default":""},"title":{"default":""},"media":{"default":""},"author":{"default":""},"dc_date":{"default":""},"link":{"default":""},"keywords":{"default":""},"content_encoded":{"default":""},"html_lang":{"default":""}},"priority":100,"mandatory":1,"is_filled":0}],"select":"first_nonempty"}';
} elseif ($data->getPost('value') == 'news_processor_properties') {
    $name = "PROCESSOR_PROPERTIES";
    $value ='{ "algorithm": { "algorithm_name": "user_name_algorithm" }, "modules": { "user_name_algorithm": [ "ScrapyExtractor", "GooseExtractor", "NewspaperExtractor" ] } }';
} else {
    $name = $data->getPost("name");
    $value = $data->getPost("value");
}
?>
<tr>
    <td width = "20%"><input type = "text" class = "gr-s-fe-prop-name" value = "<?=$name?>"></td>
    <td><textarea class = "edit textarea-big gr-s-fe-prop-val"><?=$value?></textarea></td>
    <td width = "10em" class = "remove-column"><a href = "#" class = "removeclassp act-btn">Remove</a></td>
</tr>