<?php

use Illuminate\Support\Facades\Input;
use App\Department;
Route::get('/', function () {
    return view('auth.login',compact('informations'));
})->name('login');
Route::get('searchjob', 'user\SearchController@index')->name('UserAllJob');
Route::post('searchjobinput', 'user\SearchController@store');
Route::resource('useraddjob', 'user\JobController');
Route::resource('userfollowjob', 'user\FollowJob');
Route::get('userdetailjob/{id}', 'user\SearchController@detailjobs');
Route::get('satisfaction/', 'user\SearchController@satisfaction_store');
Route::get('satisfaction/{id}', 'user\SearchController@show');
Auth::routes();
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::prefix('admin')->group(function () {
    Route::resource('information','InformationController');
    Route::get('showinputinfor', 'InformationController@showinput');
    Route::get('showinformation/{id}', 'InformationController@show');
    Route::post('updateinformation/{id}', 'InformationController@update');
    Route::get('finished_work', 'ConcludeController@finished_work_time');
    Route::resource('/conclude', 'ConcludeController');
    Route::resource('department', 'DepartmentController');
    Route::post('searchDepartment', function () {
        $q = Input::get('searchDepart');
        $departs = Department::where('name', 'LIKE', '%' . $q . '%')->get();
        return view('department', compact('departs'));
    });
    Route::resource('type', 'TypeController');
    Route::post('searchType','TypeController@search')->name('typesearch');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::resource('job', 'JobController');//หน้าเลือก User เพื่อทำการเพิ่มงาน ประชา
    Route::get('finduser/{id}', 'JobController@FindUser'); //แอดมินเพิ่มงานตามรหัสยูสเซอ ประชา
    Route::get('detailjob/{id}', 'JobController@detailjob')->name('AdminDetailJob'); //ดูรายละเอียดของแต่ละงาน
    Route::get('detailjob2/{id}', 'JobController@detailjob2');
    Route::get('acceptionJob/{id}', 'JobController@acceptionJob'); //ช่างรับงานเป็นคนแรกและเปลี่ยนสถานะงานใหม่เป็นรับงานซ่อม
    Route::get('addstatus/{id}/{status}', 'JobController@status'); //คอนโทรลเลอเพิ่มสเตตัสงาน
    Route::resource('addjob', 'AddJobController'); //หน้าเพิ่มงาน
    Route::get('searchjob', 'SearchController@index')->name('AdminAllJob'); //หน้าค้นหางาน
    Route::post('searchjobinput', 'SearchController@store');
    Route::resource('searchjobinfo', 'SearchControllerinfo');
    Route::get('searchjobinfoget', 'SearchControllerinfo@index')->name('infojob');
    Route::get('followjob', 'SearchController@FollowJob'); //หน้าติดตามงานของตัวเองทำ
    Route::resource('job', 'JobController');        //หน้าหา User
    Route::get('acceptionJob/{id}', 'JobController@acceptionJob');
    Route::get('acceptionJobDub/{id}', 'JobController@acceptionJobDub');
    Route::get('addstatus/{id}/{status}', 'JobController@status');
    Route::resource('addjob', 'AddJobController'); //หน้าเพิ่ม
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('claim/form/{job_id}', 'ClaimController@form'); //เพิ่มงานซ่อมจากงาน
    Route::resource('claim', 'ClaimController'); //หน้าจัดการการเคลมงาน
    Route::get('/changeType/{id}', 'JobController@changeType');
    Route::get('showclaim/{id}', 'ClaimController@show');
    Route::post('editclaim/{id}', 'ClaimController@update');
    Route::post('searchclaim/', 'ClaimController@search');
    Route::post('searchfollowjob/', 'SearchController@SearchFollowJob');
    Route::resource('manager', 'ManagerController'); //manager
    Route::get('managerindex', 'ManagerController@index')->name('managerindex');
});

