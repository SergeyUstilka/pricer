<?php

///var/www/html/console_functions/tesco.csv
//use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Admin\ParserController;

require '../vendor/autoload.php';
$fp = fopen('tesco.csv','w+');

require '../app/Http/Controllers/Admin/ParserController.php';
$tescoLinks =  ParserController::allLinksTesco();
// Парсим товары, собираем данные и заодно получаем ссылки на картинки которые в последующем используем в Extrim Picture Founder
$img_links =  ParserController::parseProductPagesTesco($tescoLinks, $fp);
fclose($fp);

$fp = fopen('tesco_img.csv','w+');
foreach ($img_links as $link){
    $img [0] = $link;
    fputcsv($fp, $img, ' ');
}
fclose($fp);