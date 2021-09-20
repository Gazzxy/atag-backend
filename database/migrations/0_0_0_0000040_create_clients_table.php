<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('status_id')->unsigned();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('address')->nullable();
            $table->json('theme')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('last_seen_at')->nullable(); // Updated when managing account authenticates
            $table->timestamp('last_login_at')->nullable(); // Updated when managing account authenticates

            $table->foreign('status_id')
                ->references('id')
                ->on('client_statuses')
                ->onDelete('cascade');
        });

        DB::statement('ALTER TABLE clients ADD public_id BINARY(36) AFTER id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
