<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('second_mobile')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('instagram_page')->nullable();
            $table->string('telegram_channel')->nullable();
            $table->string('landline')->nullable();
            $table->text('address')->nullable();
            $table->string('referral')->nullable();
            $table->string('picture', 4096)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('second_mobile');
            $table->dropColumn('whatsapp_number');
            $table->dropColumn('instagram_page');
            $table->dropColumn('telegram_channel');
            $table->dropColumn('landline');
            $table->dropColumn('address');
            $table->dropColumn('referral');
            $table->dropColumn('picture');
        });
    }
}
