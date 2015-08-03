<body>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/errorpages.css" />

    <div id="error-holder">
        <p id="error-page-code">404</p>
        <p id="error-page-msg">PAGE NOT FOUND</p>
        <p id="error-page-ref"><?php echo $data['message']?></p>
        <div id="hce-logo"><a href="/"><img src="/images/hce.png" alt="HCE"/><p>HOME</p></a></div>
    </div>
</body>