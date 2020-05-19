<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('contact_email')->unique()->nullable();
            $table->string('business_name')->unique();
            $table->string('website_url');
            $table->string('products_services');
            $table->enum('status',['new','approved','rejected']);
            $table->enum('accepts_bitcoin',[0,1]);
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
            $table->index('products_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
}
