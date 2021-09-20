<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->unsigned();
            $table->string('title');
            $table->string('description');
            $table->json('metadata');
            $table->timestamp('installed_at');
            $table->timestamp('last_service_at');
            $table->timestamp('expires_at');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared('ALTER TABLE equipment ADD public_id BINARY(36) AFTER id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}
