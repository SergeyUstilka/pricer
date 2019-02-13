<?php

//use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Admin\ParserController;

require '../vendor/autoload.php';
$fp = fopen('tesco.csv','w+');

require '../app/Http/Controllers/Admin/ParserController.php';
$tescoLinks =  ParserController::allLinksTesco();
//ParserController::parseProductPages($tescoLinks, $fp);
fclose($fp);