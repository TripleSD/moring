<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSitesSslCertifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites_ssl_certifications', function (Blueprint $table) {
            $table->Increments('id');
            $table->UnsignedbigInteger('site_id')->comment('Site ID');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->string('issuer')->nullable()->comment('Issuer certificate');
            $table->integer('valid_status')->nullable()->comment('Valid status');
            $table->timestamp('expiration_date')->nullable()->comment('Expiration date');
            $table->integer('expiration_days')->nullable()->comment('Expiration days');
            $table->string('algorithm')->nullable()->comment('Algorithm');
            $table->timestamp('from_date')->nullable()->comment('Valid from date');
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
        Schema::dropIfExists('sites_ssl_certifications');
    }
}
