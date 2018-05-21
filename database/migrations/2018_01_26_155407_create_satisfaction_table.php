<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSatisfactionTable extends Migration {

	public function up()
	{
		Schema::create('satisfactions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('job_id')->unsigned();
			$table->integer('score1')->nullable();
			$table->integer('score2')->nullable();
			$table->integer('score3')->nullable();
			$table->integer('score4')->nullable();
			$table->integer('score5')->nullable();
			$table->string('comment', 255)->nullable();
			$table->timestamps();
		});
        Schema::table('satisfactions', function(Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
	}

	public function down()
	{
		Schema::drop('satisfactions');
	}
}