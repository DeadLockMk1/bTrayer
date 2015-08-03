<?php
    if (!isset($customData)) {
        $customData = 'INTERNAL SERVER ERROR';
    }
?>
<body>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/errorpages.css" />

    <div id="error-holder">
        <p id="error-page-code">500</p>
        <p id="error-page-msg"><?=$customData?></p>
        
        <div id="hce-logo"><img src="/images/hce.png" alt="HCE"/></div>
        <?php
        if (isset($modal))
            echo"<input type = \"button\" id = \"scrap-options-close\" value = \"Close\" class = \"btn btn-default\" onclick=\"tpModalClose()\">";
        ?>
    </div>
</body>