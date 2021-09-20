<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->string('title');
            $table->string('description')->nullable()->nullable();
            $table->string('address_formatted', 255);
            $table->string('address_line_1', 255)->nullable();
            $table->string('address_line_2', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('postcode', 255);
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade')
            ;
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
