<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration
{

    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->integer('systemuser_id')->unsigned()->nullable();
            $table->enum('status_id', ['งานใหม่', 'ช่างรับงานซ่อม', 'ตรวจสอบข้อมูลงานซ่อม', 'ดำเนินการซ่อม', 'ส่งเคลม', 'ซ่อมเสร็จสิ้น', 'รอผลความพึงพอใจในงานซ่อม', 'ประเมินผลความพึงพอใจในงานซ่อมแล้ว'])
                ->default('งานใหม่');
            $table->text('comment')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('comments');
    }
}