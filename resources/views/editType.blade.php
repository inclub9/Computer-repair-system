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
                                <h5>แก้ไขชื่อประเภทงานซ่อม</h5>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="content">
                                <span class="sl-pencil">แก้ไขประเภท</span>
                                <form method="post" action="{{action('TypeController@update', $id)}}">
                                    {{csrf_field()}}
                                    <input name="_method" type="hidden" value="PATCH">
                                    <div class="col-lg-3">
                                    <input class="form-control" type="text" class="form-control" name="name" value="{{$type->name}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-success" style="margin-left:38px">ยืนยันการแก้ไขชื่อประเภท</button>
                                    </div>
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



