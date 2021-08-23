<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name',191);
            $table->string('slug',191)->unique();
            $table->text('description')->nullable();
            $table->string('type',191)->index()->nullable();
            $table->unsignedbigInteger('parent_id')->nullable()->index();
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
        Schema::drop('categories');
    }
}