@extends('layouts.master')
@section('title','ระบบบริการแจ้งซ่อมบำรุงคอมพิวเตอร์และอุปกรณ์ ')
@section('content')

    <div class="page-content-wrapper ">





        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="content">
                                <div class="container-fluid container-fixed-lg">
                                    <h5 class="page-title">หน้าจัดการส่งประกัน</h5>
                                </div>
                                <div class="panel-body">
                                    <div class="container">
                                        <table id="myTable" class="table table-hover table-condensed">
                                            <thead>
                                            <tr>
                                                <th>รหัสงานส่งซ่อม</th>
                                                <th>รหัสงานซ่อม</th>
                                                <th>สถานะการส่งซ่อม</th>
                                                <th>หมายเลขเประจำเครื่อง</th>
                                                <th>ผู้รับประกันการส่งซ่อม</th>
                                                <th>สร้างเมื่อ</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($claims as $claim)
                                                <tr onclick="location.href='{{action("ClaimController@show",$claim->id)}}'">
                                                    <td>{{$claim->id}}</td>
                                                    <td>{{$claim->job_id}}</td>
                                                    <td>
                                                        @if($claim->status=='กำลังส่งซ่อม')
                                                            <span class="label label-danger">{{$claim->status}}</span>
                                                        @else
                                                            <span class="label label-success">{{$claim->status}}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{$claim->sn}}</td>
                                                    <td>{{$claim->partner}}</td>
                                                    <td>{{$claim->created_at}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="container">
                                        <div>
                                            <div class="collapse" id="navbarToggleExternalContent">
                                                <form action="{{action('ClaimController@search')}}"
                                                      method="post">
                                                    {{csrf_field()}}
                                                    <div class="col-lg-2">
                                                        <input class="form-control" placeholder="คำค้นหา"
                                                               type="text"
                                                               name="search">
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <select class="form-control" name="selected">
                                                            <option value="id">หมายเลขงานส่งซ่อม</option>
                                                            <option value="job_id">หมายเลขงานซ่อม</option>
                                                            <option value="sn">หมายเลขประจำเครื่อง</option>
                                                            <option value="partner">ผู้รับประกันการส่งซ่อม</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <select class="form-control" name="status">
                                                            <option value="on">ทั้งหมด</option>
                                                            <option value="กำลังส่งซ่อม">กำลังส่งซ่อม</option>
                                                            <option value="ได้รับงานซ่อมจากการเคลม">
                                                                ได้รับงานซ่อมจากการเคลม
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <input class="btn btn-primary btn-cons m-b-10" type="submit"
                                                           value="ค้นหา">
                                                    <button class="btn btn-warning btn-cons m-b-10" type="button"
                                                            onclick="location.href='{{action("ClaimController@index")}}'">
                                                        ล้างการค้นหา
                                                    </button>
                                                </form>
                                            </div>
                                            <nav class="navbar navbar-dark bg-dark">
                                                <div class="container">
                                                    <button class="btn-complete btn" type="button"
                                                            data-toggle="collapse"
                                                            data-target="#navbarToggleExternalContent"
                                                            aria-controls="navbarToggleExternalContent"
                                                            aria-expanded="false"
                                                            aria-label="Toggle navigation">
                                                        <span class="navbar-toggler-icon">การค้นหาแบบละเอียด</span>
                                                    </button>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @parent
                </div>
            </div>
        </div>
    </div>


@endsection
@push('pages_css')
    <link class="main-stylesheet" href="/pages/css/pages.css" rel="stylesheet" type="text/css"/>
    <link class="main-stylesheet"
          href="/css/jquery.dataTables.min.css" rel="stylesheet"
          type="text/css"/>

@endpush
@push('pages_js')
    <script src="/assets/js/scripts.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript"
            src="/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="/js/buttons.flash.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="/js/jszip.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="/js/buttons.print.min.js"></script>
    <script type="text/javascript" language="javascript" src="/js/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="/js/vfs_fonts.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "order": [[0, "desc"]],
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "ทั้งหมด"]],
                "oLanguage": {
                    "sSearch": "คำค้นหา: ",
                    "sZeroRecords": "ไม่มีข้อมูลที่คุณต้องการ",
                    "sLengthMenu": 'Display <select>' +
                    '<option value="5">5</option>' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">ทั้งหมด</option>' +
                    '</select> records',
                    "sLengthMenu": "แสดง _MENU_ แถวในหน้า&nbsp;&nbsp;&nbsp;ออกรายงานเป็น:&nbsp;&nbsp;&nbsp;",
                    "oPaginate": {
                        "sNext": "หน้าถัดไป",
                        "sPrevious": "ก่อนหน้านี้"
                    },
                    "sInfo": "มีข้อมูลทั้งหมด _TOTAL_ ข้อมูล แสดงข้อมูลตั้งแต่ (_START_ จนถึง _END_)"
                },
                buttons: [
                    { extend: 'copy', text: 'คัดลอกเป็นข้อความ' },
                    { extend: 'excel', text: 'Excel File' },
                    { extend: 'pdf', text: 'PDF File' },
                    { extend: 'print', text: 'สั่งพิมพ์ข้อมูลในตาราง' },
                ]
            });
        });
    </script>
@endpush