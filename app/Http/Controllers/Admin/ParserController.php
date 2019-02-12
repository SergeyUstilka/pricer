<?php

namespace App\Http\Controllers\Admin;

use DiDom\Document;
use DiDom\Query;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParserController extends Controller
{
   public static function index(){
        $urls =  [];
        $document = new Document();
        $url = 'https://ezakupy.tesco.pl/groceries/pl-PL/promotions/all';
        $document->loadHtmlFile($url, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $pageCount = intval($document->first('.pagination--page-selector-wrapper li:nth-child(6) span')->text());
        dump($pageCount);

       for($i=1; $i<$pageCount; $i++){
            $document = new Document();
            $document->loadHtmlFile('https://ezakupy.tesco.pl/groceries/pl-PL/promotions/all?page='.$i, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $posts =  $document->find('.tile-content a.product-image-wrapper');
            foreach($posts as $post) {
                $links[] = $post->getAttribute('href');
                break;
            }
            $file_path = app_path().'/../public/storage/csv/tesco.csv';
            $fp = fopen($file_path ,'w+');
            foreach($links as $link){
                $productPage =new Document();
                $productPage->loadHtmlFile('https://ezakupy.tesco.pl'.$link, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $product_name =  $productPage->first('h1.product-details-tile__title')->text();
                $product_description =  $productPage->first('.list-item-content.promo-content-small')->text();
                $product_price = floatval($productPage->first('.price-per-quantity-weight .value')->text());
                $product_count =  $productPage->first('.price-per-quantity-weight .weight')->text();
                $product_img =  $productPage->first('.product-image__container .product-image ')->getAttribute('src');

//           $product_name.'~'.$product_img.'~'.$product_description.'~'.'1~'.$product_price.'~'.$product_count;
                $str=[];
                $str[] = $product_name;
                $str[] = $product_img;
                $str[] = $product_description;
                $str[] = 1;
                $str[] = $product_price;
                $str[] = $product_count;


                fputcsv($fp,$str,';');
            }
            fclose($fp);

           break;
        }
       dump($links);

   }

// Проверяем сколько страниц в каталоге и собираем ссылки на еденичные продукты (собираем их в массив)
   public static function allLinks(){
       $urls =  [];
       $document = new Document();
       $url = 'https://ezakupy.tesco.pl/groceries/pl-PL/promotions/all';
       $document->loadHtmlFile($url, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
       $pageCount = intval($document->first('.pagination--page-selector-wrapper li:nth-child(6) span')->text());
       dump($pageCount);
       for($i=1; $i<$pageCount; $i++){
           $document = new Document();
           $document->loadHtmlFile('https://ezakupy.tesco.pl/groceries/pl-PL/promotions/all?page='.$i, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
           $posts =  $document->find('.tile-content a.product-image-wrapper');
           foreach($posts as $post) {
               $links[] = $post->getAttribute('href');
               break;
           }
           if($i ==10){break;}
       }
//       dump($links);
       return $links;
   }


// Парсим данные из страниц каталога
   public static function parseProductPages($links, $fp){
       $j=0;

       $categories = ['any','Owoce, warzywa','Nabiał i jaja','Pieczywo, cukiernia', 'Mięso, ryby, garmaż', 'Art. spożywcze', 'Mrożonki', 'Napoje', 'Chemia','Kosmetyki', 'Dla dzieci','Dla zwierząt', 'Art. przemysłowe'];
       foreach($links as $link){
           $productPage =new Document();
           $productPage->loadHtmlFile('https://ezakupy.tesco.pl'.$link, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
           $product_name =  $productPage->first('h1.product-details-tile__title')->text();
           $product_description =  $productPage->first('.list-item-content.promo-content-small')->text();
           $product_price = ($productPage->first('.price-per-sellable-unit--price .value')->text());
           $product_count =  $productPage->first('.price-per-quantity-weight .weight')->text();
           $product_img =  $productPage->first('.product-image__container .product-image ')->getAttribute('src');

           $product_category_text = $productPage->first('.breadcrumbs li:nth-child(2)')->text();
           foreach ($categories as $key => $category){
               if($category == $product_category_text ){
                   $product_category =  $key;
                   break;
               }
           }


           $str=[];
           $str[] = $product_name;
           $str[] = $product_img;
           $str[] = $product_description;
           $str[] = $product_category;
           $str[] = $product_count;
           $str[] = $product_price;


           fputcsv($fp,$str,';');
           dump($j++);
       }
    }
}
