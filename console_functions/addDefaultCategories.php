<?php
/**
 * Created by PhpStorm.
 * User: NoteBook
 * Date: 09.02.2019
 * Time: 16:26
 */


use App\Models\Category;

require '../vendor/autoload.php';
require '../app/Models/Category.php';

$categories =  ['any','Фрукты, овощи','Молочные продукты и яйца','Хлеб, кондитерские изделия', 'Мясо, рыба, деликатесы', 'Бакалея',
    'Замороженные продукты', 'Напитки', 'Бытовая химия','Косметика', 'Для детей','Для животных', 'Дом и сад'];
foreach($categories as $category){
    $cat = new Category();
    $cat->name = $category;
    $cat->description = $category;
    dump('Имя категории: '.$cat->name);
    $cat->save();
}