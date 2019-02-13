<?php

//use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Admin\ParserController;

require '../vendor/autoload.php';
$fp = fopen('biedronka.csv','w+');

require '../app/Http/Controllers/Admin/ParserController.php';
$biedronkaLinks =  ParserController::getAllProductLinksBiedronka();
ParserController::parseClubCardBiedronka($biedronkaLinks, $fp);
fclose($fp);