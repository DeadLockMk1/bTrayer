<?php
/* @var $this SitesViewController */

$this->renderPartial('_filterForm', array(
    'uid'=>'*',
    'pattern'=>'http',
    'page'=>'0',
    'limit'=>'10',
    'state'=>'all',
    'sortBy'=>'UDate',
    'sortDirection'=>'DESC',
    )
);
