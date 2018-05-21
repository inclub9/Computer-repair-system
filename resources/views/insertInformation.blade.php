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
                                    <h5 class="page-title" >เพิ่มข่าวประชาสัมพัธ์</h5>
                                </div>
                                <div class="col-lg-5">
                                <form method="post" action="{{action('InformationController@store')}}">
                                    {{csrf_field()}}
                                    <span>ข่าว</span><input required type="text" class="form-control" name="news"><br>
                                    <span>เว็บไซต์</span><input required type="text" class="form-control" name="url"><br>
                                    <button type="submit" class="btn btn-success">เพิ่มข่าวประชาสัมพันธ์</button>
                                </form>
                                </div>



                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @parent
        </div>
    </div>

                        @endsection

                        @push('pages_css')
                            <link class="main-stylesheet" href="/pages/css/pages.css" rel="stylesheet" type="text/css"/>
                        @endpush

                        @push('pages_js')
                            <script src="/assets/js/scripts.js" type="text/javascript"></script>
    @endpush



