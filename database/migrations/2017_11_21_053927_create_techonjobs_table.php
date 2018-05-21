<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTechonjobsTable extends Migration {

	public function up()
	{
		Schema::create('techonjobs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('systemuser_id')->unsigned();
            $table->integer('job_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('techonjobs');
	}
}