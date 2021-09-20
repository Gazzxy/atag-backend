<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('equipment_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('title');
            $table->string('url');
            $table->string('filename');
            $table->string('filepath');
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('equipment_id')
                ->references('id')
                ->on('equipment')
                ->onDelete('cascade')
            ;

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_reports');
    }
}
