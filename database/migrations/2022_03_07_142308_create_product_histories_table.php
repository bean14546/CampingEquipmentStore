<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_histories', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->decimal('price',7,2);
            $table->text('description')->nullable();
            $table->string('category');
            $table->integer('quantity');
            $table->decimal('total', 7, 2); // 7 คือ เก็บได้ทั้งหมด 7 หลัก(รวมทศนิยม), 2 คือ ทศนิยม 2 ตำแหน่ง 99999.99
            $table->integer('user_id');
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
        Schema::dropIfExists('product_histories');
    }
}
