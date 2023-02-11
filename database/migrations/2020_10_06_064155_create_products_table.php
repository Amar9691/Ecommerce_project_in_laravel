<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->double('price');
            $table->integer('stock');
            $table->boolean('featured')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('discount');
            $table->string('slug');
            $table->string('discount_price');
            $table->string('thumbnail');
            $table->text('options')->nullable();
            $table->softDeletes();
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
