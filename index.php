<?php
date_default_timezone_set('Europe/London');
require_once '../ppi-framework/init.php';
require_once '../phponcouch/lib/couch.php';
require_once '../phponcouch/lib/couchClient.php';
require_once '../phponcouch/lib/couchDocument.php';
$app = new PPI_App();
$app->boot()->dispatch();