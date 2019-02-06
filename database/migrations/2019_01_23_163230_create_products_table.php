<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void desription
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',256)->nullable(false);
            $table->string('slug',256)->nullable(false);
            $table->string('img',256)->default('sgone_no_img.png');
            $table->text('description')->nullable(true);
            $table->integer('cat_id')->unsigned();
            $table->decimal('price',10,2)->default(0);
            $table->string('unit',255)->nullable(true);
            $table->integer('shop_id')->unsigned();
            $table->integer('csv_id')->default(0)->unsigned();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('csv_id')->references('id')->on('csv')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
