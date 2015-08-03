<?php
if (!empty($model)) {
    $header = !empty($header) ? $header : null;
    $footer = !empty($footer) ? $footer : null;
    $htmlOptions = !empty($htmlOptions) ? $htmlOptions : array();
    $errors = CHtml::errorSummary($model, $header, $footer, $htmlOptions);
    if (!empty($errors)) {
        echo $errors;
    }
}