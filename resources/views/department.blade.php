@extends('layouts.master')
@section('title','ระบบแจ้งซ่อมคอมพิวเตอร์')
@section('content')

    <div class="page-content-wrapper ">





        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading separator">
                            <div class="panel-title"><h5>Sru News</h5>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="content">
                                <form action="searchDepartment" method="post">
                                    {{csrf_field()}}
                                    <input type="text"  name="searchDepart">
                                    <input type="submit" value="ค้นหา">
                                </form>
                                <a href="{{action('DepartmentController@create')}}"><button class="btn btn-primary" type="submit">insert</button></a>
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <th>รหัสแผนก</th>
                                        <th>ชื่อแผนก</th>
                                        <th>จัดการ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($departs as $depart)
                                        <tr>
                                            <td>{{$depart['id']}}</td>
                                            <td>{{$depart['name']}}</td>
                                            <td><a href="{{action('DepartmentController@edit', $depart['id'])}}" class="btn btn-warning">Edit</a></td>
                                            <td>
                                                <form action="{{action('DepartmentController@destroy', $depart['id'])}}" method="post">
                                                    {{csrf_field()}}
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </form>
                                            </td>
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



