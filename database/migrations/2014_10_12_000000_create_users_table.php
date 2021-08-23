<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name', 191)->nullable();
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('company_name', 191)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('birthdate', 191)->nullable();
            $table->string('phone', 191)->nullable();
            $table->string('mobile', 191)->nullable();
            $table->string('instagram', 191)->nullable();
            $table->string('telegram', 191)->nullable();
            $table->string('number2', 191)->nullable();
            $table->string('profile', 191)->nullable();
            $table->string('situation', 191)->nullable();
            $table->string('files', 191)->nullable();
            $table->enum('type', ['employee', 'admin', 'customer', 'operator']);
            $table->string('role', 191)->nullable();
            $table->unsignedTinyInteger('rate')->default(0);
            $table->rememberToken();
            $table->softDeletes(); 
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
        Schema::dropIfExists('users');
    }
}
