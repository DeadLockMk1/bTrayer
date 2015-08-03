<?php
/* @var $this SitesViewController */

$this->breadcrumbs=array(
    'Sites View'=>'/SitesView/index','Site Fields',
);
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $itemsProvider,
    'columns' => array( 
        array(  
            'name' => 'State',  
            'value' => '$data["state"]',
        ),  
        array(  
            'name' => 'Iterations',  
            'value' => '$data["iterations"]',
        ),
        array(  
            'name' => 'Resources',  
            'value' => '$data["resources"]',
        ),
        array(  
            'name' => 'Contents',  
            'value' => '$data["contents"]',
        ),
        array(  
            'name' => 'Errors',  
            'value' => '$data["errors"]',
        ),
    )  
));
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $itemsProvider,
    'columns' => array( 
        array(  
            'name' => 'Root URLs',  
            'type' => 'raw',
            'value' => '"<div class=\"scrollable\">".$data["urls"]."</div>"',  
        ),
    )  
));
$this->widget('zii.widgets.grid.CGridView', array(  
    'id' => 'itemGrid',
    'summaryText' => '',  
    'dataProvider' => $itemsProvider,
    'columns' => array( 
        array(  
            'name' => 'Errors types',  
            'value' => '$data["errorMask"]'  
        ),
    )  
));

?> 