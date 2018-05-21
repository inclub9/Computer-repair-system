<?php
use Faker\Generator as Faker;
$factory->define(\App\Department::class, function (Faker $faker) {
    static $name=array('เจ้าหน้าที่บริหารงานทั่วไป','เจ้าหน้าที่วิชาการด้านคอมพิวเตอร์','ผู้บริหาร');
    return [
        'name' => $name[1],
    ];
});
$factory->define(\App\SystemUser::class, function (Faker $faker)use ($factory) {
    static $password='password';
    return [
        'department_id' => $factory->create(\App\Department::class)->id,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt($password),
        'remember_token' => str_random(10),
    ];
});
$factory->define(\App\Techonjob::class, function (Faker $faker)use ($factory) {
    return [
        'systemuser_id' => $factory->create(\App\SystemUser::class)->id,
        'job_id' => $factory->create(\App\Job::class)->id,
    ];
});
$factory->define(\App\Type::class, function () {
    $name = array('อินเตอร์เน็ต','อุปกรณ์คอมพิวเตอร์','อุปกรณ์ต่อพ่วงคอมพิวเตอร์','ซอฟแวร์');
    return [
        'name' => $name[1],
    ];
});
$factory->define(\App\Job::class, function (Faker $faker)use ($factory) {
    return [
        'user_id' => $factory->create(\App\User::class)->id,
        'type_id' => $factory->create(\App\Type::class)->id,
        'problem' => 'problemmmmmmmmmmm',
        'telnum' => '0887878',
    ];
});
$factory->define(\App\Comment::class, function (Faker $faker)use ($factory) {
    return [
        'job_id' => $factory->create(\App\Job::class)->id,
        'systemuser_id' => $factory->create(\App\SystemUser::class)->id,
        'comment' => 'คอมเม้นโง่ๆ',
    ];
});
