<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClaimsTable extends Migration {

	public function up()
	{
		Schema::create('claims', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('job_id')->unsigned();
            $table->enum('status', ['กำลังส่งซ่อม', 'ได้รับงานซ่อมจากการเคลม'])->default('กำลังส่งซ่อม');
			$table->string('sn', 50);
			$table->string('partner', 50);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('claims');
	}
}