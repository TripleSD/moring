<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsSortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_sorts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('User ID');
            $table->string('item_name')->comment('Item name being sorted');
            $table->integer('position')->comment('Position of the item in the screen');
            $table->foreign('user_id')->references('id')->on('users');
            $table->smallInteger('display')->default(1)->comment('Show or hide item in the screen');
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
        Schema::dropIfExists('items_sorts');
    }
}
