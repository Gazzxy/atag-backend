<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentAuditLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_audit_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('equipment_id')->unsigned();
            $table->string('summary');
            $table->json('trace');
            $table->timestamps();

            $table
                ->foreign('equipment_id')
                ->references('id')
                ->on('equipment_audit_log')
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
        Schema::dropIfExists('equipment_audit_log');
    }
}
