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
                                <form method="post" action="{{action('DepartmentController@store')}}">
                                    {{csrf_field()}}
                                    <input type="text" class="form-control" name="name" >
                                    <button type="submit" class="btn btn-success" style="margin-left:38px">Insert Department</button>
                                </form>



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



