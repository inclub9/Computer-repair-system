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
                                    <h5 class="page-title">แก้ไขรายละเอียดของการส่งเคลม</h5>
                                </div>
                                <div class="container">
                                    <div class="col-lg-6">
                                        <form action="{{action('ClaimController@update',$show->id)}}"
                                              method="post">{{csrf_field()}}
                                            <div class="form-group form-group-default ">
                                                <label>รหัสงานซ่อม</label>
                                                <input type="text" name="job_id" class="form-control"
                                                       readonly  value={{$show->job_id}}>
                                            </div>
                                            <div class="form-group form-group-default required ">
                                                <label>สถานะของการส่งซ่อม</label>
                                                <select name="status" required>

                                                    @if($show->status=="กำลังส่งซ่อม")
                                                        <option @if($show->status=="กำลังส่งซ่อม")disabled selected
                                                                @endif value="กำลังส่งซ่อม">กำลังส่งซ่อม
                                                        </option>
                                                        <option @if($show->status=="ได้รับงานซ่อมจากการเคลม")disabled
                                                                selected
                                                                @endif value="ได้รับงานซ่อมจากการเคลม">
                                                            ได้รับงานซ่อมจากการส่งประกัน
                                                        </option>
                                                    @else
                                                        <option @if($show->status=="ได้รับงานซ่อมจากการเคลม")disabled
                                                                selected
                                                                @endif value="ได้รับงานซ่อมจากการเคลม">
                                                            ได้รับงานซ่อมจากการส่งประกัน
                                                        </option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group form-group-default  ">
                                                <label>หมายเลขประจำเครื่อง</label>
                                                <input type="text" name="sn" class="form-control"
                                                       readonly value="{{$show->sn}}">
                                            </div>
                                            <div class="form-group form-group-default  ">
                                                <label>ผู้ผลิต</label>
                                                <input type="text" name="partner" class="form-control"
                                                       readonly value="{{$show->partner}}">
                                            </div>

                                            <div class="form-group form-group-default required ">
                                                <label>ความคิดเห็น</label>
                                                <input type="text" name="remark" required class="form-control"
                                                       placeholder="ป้อนความคิดเห็นในการเปลี่ยนสถานะงานเคลม">
                                            </div>
                                            <br>
                                            <input type="submit" class="btn-primary btn" value="แก้ไขสถานะงานเคลม">
                                        </form>
                                    </div>
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
                            <link class="main-stylesheet" href="/pages/css/pages.css" rel="stylesheet"
                                  type="text/css"/>
                        @endpush

                        @push('pages_js')
                            <script src="/assets/js/scripts.js" type="text/javascript"></script>
    @endpush