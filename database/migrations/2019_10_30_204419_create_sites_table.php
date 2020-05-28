<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'sites',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('title')
                    ->comment('Sites title for sites list');
                $table->text('url')
                    ->comment('Sites url');
                $table->integer('https')
                    ->default(0);
                $table->integer('enabled')
                    ->default(0);
                $table->text('comment')
                    ->nullable()
                    ->comment('Sites description');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
