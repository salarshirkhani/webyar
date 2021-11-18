<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixCascades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('absences', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->foreign('employee_id')
                ->on('users')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->foreign('employee_id')
                ->on('users')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['user_id']);
            $table->foreign('sender_id')
                ->on('users')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
        Schema::table('employee_project', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['project_id']);
            $table->foreign('employee_id')
                ->on('users')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('project_id')
                ->on('projects')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['phase_id']);
            $table->dropForeign(['employee_id']);
            $table->foreign('project_id')
                ->on('projects')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('phase_id')
                ->on('phases')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('employee_id')
                ->on('users')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('absences', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->foreign('employee_id')
                ->on('users')
                ->references('id');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->foreign('employee_id')
                ->on('users')
                ->references('id');
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['user_id']);
            $table->foreign('sender_id')
                ->on('users')
                ->references('id');
            $table->foreign('user_id')
                ->on('users')
                ->references('id');
        });
        Schema::table('employee_project', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['project_id']);
            $table->foreign('employee_id')
                ->on('users')
                ->references('id');
            $table->foreign('project_id')
                ->on('projects')
                ->references('id');
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['phase_id']);
            $table->dropForeign(['employee_id']);
            $table->foreign('project_id')
                ->on('projects')
                ->references('id');
            $table->foreign('phase_id')
                ->on('phases')
                ->references('id');
            $table->foreign('employee_id')
                ->on('users')
                ->references('id');
        });
    }
}
