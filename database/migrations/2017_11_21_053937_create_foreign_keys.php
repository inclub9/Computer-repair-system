<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

    public function up()
    {
        Schema::table('jobs', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        Schema::table('jobs', function(Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('types')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        Schema::table('claims', function(Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')
                ->onDelete('no action')
                ->onUpdate('no action');
        });

        Schema::table('systemusers', function(Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        Schema::table('techonjobs', function(Blueprint $table) {
            $table->foreign('systemuser_id')->references('id')->on('systemusers')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        Schema::table('techonjobs', function(Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')
                ->onDelete('no action')
                ->onUpdate('no action');
        });

    }

    public function down()
    {
        Schema::table('jobs', function(Blueprint $table) {
            $table->dropForeign('jobs_user_id_foreign');
        });
        Schema::table('jobs', function(Blueprint $table) {
            $table->dropForeign('jobs_type_id_foreign');
        });
        Schema::table('jobs', function(Blueprint $table) {
            $table->dropForeign('jobs_techonjob_id_foreign');
        });
        Schema::table('claims', function(Blueprint $table) {
            $table->dropForeign('claims_job_id_foreign');
        });
        Schema::table('remarks', function(Blueprint $table) {
            $table->dropForeign('remarks_claim_id_foreign');
        });
        Schema::table('systemusers', function(Blueprint $table) {
            $table->dropForeign('systemusers_department_id_foreign');
        });
        Schema::table('techonjobs', function(Blueprint $table) {
            $table->dropForeign('techonjobs_tech_id1_foreign');
        });
        Schema::table('techonjobs', function(Blueprint $table) {
            $table->dropForeign('techonjobs_tech_id2_foreign');
        });
        Schema::table('techonjobs', function(Blueprint $table) {
            $table->dropForeign('techonjobs_tech_id3_foreign');
        });
        Schema::table('comments', function(Blueprint $table) {
            $table->dropForeign('comments_job_id_foreign');
        });
    }
}