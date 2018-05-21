@extends('layouts.master')
@section('title','ระบบแจ้งซ่อมคอมพิวเตอร์')
@section('content')

    <div class="page-content-wrapper ">





        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading separator">
                            <div class="panel-title">
                                <br>
                                <br>
                                <h5>เพิ่มประเภทของงานซ่อม</h5>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="content">
                                <div class="col-lg-5">
                                <form method="post" action="{{action('TypeController@store')}}">
                                    {{csrf_field()}}
                                    <span>เพิ่มประเภทงานซ่อม</span><input type="text" class="form-control" name="name"><br>
                                    <button type="submit" class="btn btn-success">ยืนยันการเพิ่มประเภทงานซ่อม</button>
                                </form>
                                </div>


                            </div>
                            </div>
                        </div>
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



