<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ProductMigration extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('name_en');

            $table->string('description');
            $table->string('description_en');

            $table->integer('ageFrom');
            $table->integer('ageTo');
            $table->string('imageId');

            $table->string('producer');
            $table->double('discount');

            $table->integer('category');

            $table->integer('portionType');
            $table->double('portionSize');
            $table->integer('portionTotal');

            $table->integer('maxTime');
            $table->integer('breakTime');
            $table->integer('instock');

            $table->double('cost');
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
}