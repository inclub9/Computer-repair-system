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
                                    <span style="font-size: 15px"
                                          class="page-title">แจ้งปัญหาของคุณ <b>{{$users[$id-1]['name']}}</b></span>
                                </div>
                                <form id="form-personal" role="form" autocomplete="off"
                                      action="{{action('AddJobController@store')}}" method="post">
                                    <input type="hidden" class="form-control" name="user_id" value="{{$id}}">
                                    {{csrf_field()}}
                                    <div class="container"></div>
                                    <div class="col-lg-5">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="alert alert-info" role="alert">
                                                    <span style="font-size: 17px">รายละเอียดของปัญหา</span>
                                                </div>
                                                <div class="form-group form-group-default required ">
                                                    <label>ปัญหา</label>
                                                    <input type="text" name="problem" required="" class="form-control"
                                                           placeholder="ป้อนปัญหา">
                                                </div>
                                                <div class="form-group form-group-default required ">
                                                    <label>เบอร์โทร</label>
                                                    <input type="text" name="telnum" required="" class="form-control"
                                                           placeholder="ป้อนเบอร์โทรเพือติดต่อกลับ">
                                                </div>
                                                <b style="font-size: 15px; ">รายละเอียดของตำแหน่งที่เสีย</b>
                                                <textarea name="comment" required="" class="form-control" rows="3"
                                                          cols="60"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="alert alert-info" role="alert">
                                                    <span style="font-size: 17px">ประเภทของปัญหา</span>
                                                </div>
                                                เลือกประเภท :@foreach($types as $type)
                                                    <label class="container">{{$type['name']}}
                                                        <input type="radio" value="{{$type['id']}}" name="type_id">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                @endforeach
                                                <input type="submit" class="btn-primary btn" value="แจ้งซ่อม">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                </div>


                @parent
            </div>

            @endsection

            @push('pages_css')
                <link class="main-stylesheet" href="/pages/css/pages.css" rel="stylesheet" type="text/css"/>
                <link class="main-stylesheet" href="/pages/css/ra.css" rel="stylesheet" type="text/css">
            @endpush

            @push('pages_js')
                <script src="/assets/js/scripts.js" type="text/javascript"></script>
    @endpush