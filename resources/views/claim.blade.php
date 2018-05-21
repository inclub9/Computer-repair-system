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
                                    <h5 class="page-title">จัดการการเคลม</h5>
                                </div>
                                <div class="container">
                                    <div class="col-lg-6">
                                        <form action="{{action('ClaimController@store')}}"
                                              method="post">{{csrf_field()}}
                                            <div class="form-group form-group-default required ">
                                                <label>รหัสงานซ่อม</label>
                                                <input type="text" name="job_idd" class="form-control"
                                                       disabled value={{$job_id}}>
                                            </div>
                                            <div class="form-group form-group-default required ">
                                                <input type="hidden" name="job_id" value={{$job_id}}>
                                                <label>สถานะของการส่งซ่อม</label>
                                                <label class="container">
                                                    <input type="radio" value="กำลังส่งซ่อม" required name="status">กำลังส่งซ่อม
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="form-group form-group-default required ">
                                                <label>หมายเลขประจำเครื่อง</label>
                                                <input type="text" name="sn" required class="form-control"
                                                       placeholder="ป้อนหมายเลขประจำเครื่อง">
                                            </div>
                                            <div class="form-group form-group-default required ">
                                                <label>ผู้ผลิต</label>
                                                <input type="text" name="partner" required class="form-control"
                                                       placeholder="ป้อนชื่อบริษัทผู้ผลิต">
                                            </div>
                                            <div class="form-group form-group-default required ">
                                                <label>ความคิดเห็น</label>
                                                <input type="text" name="remark" required class="form-control"
                                                       placeholder="ป้อนความคิดเห็น">
                                            </div>
                                            <input type="submit" class="btn-primary btn" value="ส่งเคลม">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @parent

        @endsection

        @push('pages_css')
            <link class="main-stylesheet" href="/pages/css/pages.css" rel="stylesheet"
                  type="text/css"/>
        @endpush

        @push('pages_js')
            <script src="/assets/js/scripts.js" type="text/javascript"></script>

    @endpush