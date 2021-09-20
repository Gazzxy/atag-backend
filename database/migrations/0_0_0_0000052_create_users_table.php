<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_administrator')->default(0);
            $table->integer('status_id')->unsigned()->nullable();
            $table->integer('type_id')->unsigned()->nullable();
            $table->bigInteger('client_id')->unsigned()->nullable();

            $table->string('full_name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->json('config')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamp('last_login_at')->nullable();

            $table
                ->foreign('type_id')
                ->references('id')
                ->on('client_account_types')
                ->onDelete('cascade');

            $table
                ->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');

            $table
                ->foreign('status_id')
                ->references('id')
                ->on('user_statuses')
                ->onDelete('cascade');
        });

        // Create a fixed-length unique index and 2 triggers to manage it
        DB::unprepared('ALTER TABLE users ADD unique_id BINARY(32) AFTER id');
        DB::unprepared('ALTER TABLE users ADD UNIQUE(unique_id)');
        DB::unprepared('
                CREATE TRIGGER `users_before_insert` BEFORE INSERT
                ON `users`
                    FOR EACH ROW BEGIN
                        SET new.unique_id = UNHEX(SHA2(new.email, 256));
                    END;
        ');

        DB::unprepared('
                CREATE TRIGGER `users_before_update` BEFORE UPDATE
                ON `users`
                    FOR EACH ROW BEGIN
                        SET new.unique_id = UNHEX(SHA2(new.email, 256));
                    END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
