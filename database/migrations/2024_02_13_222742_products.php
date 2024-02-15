<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('productId');
            $table->string('productName');
            $table->text('productDescription');
            $table->decimal('productPrice', 8, 2);
            $table->integer('productQuantity');
            $table->unsignedBigInteger('categoryId');
            $table->unsignedBigInteger('brandId');
            $table->timestamps();
        
            
            $table->foreign('categoryId')->references('categoryId')->on('categories')->onDelete('cascade');;
            $table->foreign('brandId')->references('brandId')->on('brands')->onDelete('cascade');;
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
