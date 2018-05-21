@extends('layouts.master')
@section('title','ระบบแจ้งซ่อมคอมพิวเตอร์')
@section('content')

    <div class="page-content-wrapper ">





        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="content">
                                <div class="container-fluid container-fixed-lg">
                                    <h5 class="page-title">เลือกผู้ใช้ที่ติดต่อแจ้งงานซ่อม</h5>
                                </div>
                                <form action="job" method="post">
                                    {{csrf_field()}}
                                    <div class="col-lg-2">
                                    <input placeholder="คำค้นหา" class="form-control" type="text" name="search_user">
                                    </div>
                                    <div class="col-lg-2">
                                    <select class="form-control" name = "selected">
                                        <option value="id">หมายเลขผู้ใช้งาน</option>
                                        <option value="name">ชื่อ</option>
                                        <option value="email">E-mail</option>
                                    </select>
                                    </div>
                                    <div class="col-lg-1">
                                    <input class="btn-primary btn" type="submit" value="ค้นหา">
                                    </div>
                                    <button class="btn-warning btn" type="button" onclick="location.href='{{action("JobController@index")}}'">ล้างการค้นหา</button>
                                </form>
                                <table class="table table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>หมายเลขผู้ใช้งาน</th>
                                        <th>ชื่อ</th>
                                        <th>E-Mail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr onclick="location.href='{{action('JobController@FindUser',$user['id'])}}'">
                                            <td>{{$user['id']}}</td>
                                            <td>{{$user['name']}}</td>
                                            <td>{{$user['email']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <br>




                            </div>


                            @parent
                        </div>

                        @endsection

                        @push('pages_css')
                            <link class="main-stylesheet" href="/pages/css/pages.css" rel="stylesheet" type="text/css"/>
                        @endpush

                        @push('pages_js')
                            <script src="/assets/js/scripts.js" type="text/javascript"></script>
    @endpush



