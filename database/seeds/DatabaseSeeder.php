<?php

use Illuminate\Database\Seeder;
use App\Department;
use App\SystemUser;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = new Department;
        $department->id = 2;
        $department->name = 'ช่าง';
        $department->save();
        $systemuser = new SystemUser();
        $systemuser->name = 'ชื่อ-ช่าง';
        $systemuser->email = 'tech@tech.tech';
        $systemuser->password = '$2a$04$1nhLP/bnJr2P2.5yVS5I9OmMaCLanaay.pHSH4Z5YYKBNp73T8RTa';
        $systemuser->remember_token = 'dasdasdsadxczx';
        $systemuser->department_id =  $department->id ;
        $systemuser->save();

        $department = new Department;
        $department->id = 1;
        $department->name = 'เจ้าหน้าที่บริหารงานทั่วไป';
        $department->save();
        $systemuser = new SystemUser();
        $systemuser->name = 'ชื่อ-เจ้าหน้าที่บริหารงานทั่วไป';
        $systemuser->email = 'info@info.info';
        $systemuser->password = '$2a$04$1nhLP/bnJr2P2.5yVS5I9OmMaCLanaay.pHSH4Z5YYKBNp73T8RTa';
        $systemuser->remember_token = 'dasdasdsadxczx';
        $systemuser->department_id =  $department->id ;
        $systemuser->save();

        $department = new Department;
        $department->id = 3;
        $department->name = 'ผู้บริหาร';
        $department->save();
        $systemuser = new SystemUser();
        $systemuser->name = 'ชื่อ-ผู้บริหาร';
        $systemuser->email = 'manager@manager.manager';
        $systemuser->password = '$2a$04$1nhLP/bnJr2P2.5yVS5I9OmMaCLanaay.pHSH4Z5YYKBNp73T8RTa';
        $systemuser->remember_token = 'dasdasdsadxczx';
        $systemuser->department_id =  $department->id ;
        $systemuser->save();

        /*factory(\App\Department::class, 2)->create();*/
        //factory(\App\Techonjob::class, 1)->create(); //มีช่างรับแต่ไม่มีคอมเมน
        factory(\App\Comment::class, 1)->create(); //มีจ๊อบมีคอมเมนแต่ไม่มีช่างรับ
        //factory(\App\SystemUser::class, 4)->create();
    }
}
