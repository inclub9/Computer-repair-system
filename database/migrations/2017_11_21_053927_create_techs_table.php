<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTechsTable extends Migration {

	public function up()
	{
		Schema::create('systemusers', function(Blueprint $table) {
			$table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
			$table->integer('department_id')->unsigned();
			$table->softDeletes();
			$table->timestamps();
		});
        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('systemuser_id')->references('id')->on('systemusers')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
	}

	public function down()
	{
		Schema::drop('systemusers');
	}
}