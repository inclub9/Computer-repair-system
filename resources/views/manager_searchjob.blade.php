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
                                    <h5 class="page-title">งานซ่อมทั้งหมดในระบบ</h5>
                                </div>

                                <div class="container">
                                    <table id="myTable" class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>รหัสงานซ่อม</th>
                                            <th>ประเภทปัญหา</th>
                                            <th>ปัญหา</th>
                                            <th>สถานะ</th>
                                            <th>ชื่อผู้แจ้งซ่อม</th>
                                            <th>เบอร์โทร</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jobs as $job)

                                            @if($status =='ทั้งหมด')
                                                <tr onclick="location.href='{{action('ManagerController@show',$job->id)}}'">

                                                    <td>{{$job->id}}</td>
                                                    <td>{{$job->Type->name ??'ไม่มีประเภท'}}</td>
                                                    <td>{{$job->problem}}</td>
                                                    <td>
                                                        @foreach($job->Comment as $index =>$comment)
                                                            @if(count($job->Comment)-1==$index)
                                                                @if($comment->status_id=='งานใหม่')
                                                                    <span class="label label-warning">{{$comment->status_id}}</span>
                                                                @elseif($comment->status_id=='ตรวจสอบข้อมูลงานซ่อม')
                                                                    <span class="label label-warning">{{$comment->status_id}}</span>
                                                                @elseif($comment->status_id=='ดำเนินการซ่อม')
                                                                    <span class="label label-info">{{$comment->status_id}}</span>
                                                                @elseif($comment->status_id=='ส่งเคลม')
                                                                    <span class="label label-danger">{{$comment->status_id}}</span>
                                                                @elseif($comment->status_id=='ซ่อมเสร็จสิ้น')
                                                                    <span class="label label-primary">{{$comment->status_id}}</span>
                                                                @elseif($comment->status_id=='รอผลความพึงพอใจในงานซ่อม')
                                                                    <span class="label label-success">{{$comment->status_id}}</span>
                                                                @elseif($comment->status_id=='ประเมินผลความพึงพอใจในงานซ่อมแล้ว')
                                                                    <span class="label label-success">{{$comment->status_id}}</span>
                                                                @elseif($comment->status_id=='ช่างรับงานซ่อม')
                                                                    <span class="label label-primary">{{$comment->status_id}}</span>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{$job->User->name}}</td>
                                                    <td>{{$job->telnum}}</td>
                                                </tr>
                                            @else
                                                @foreach($job->Comment as $index =>$comment)
                                                    @if(count($job->Comment)-1==$index)
                                                        @if($comment->status_id == @$status)
                                                            <tr onclick="location.href='{{action('ManagerController@show',$job->id)}}'">
                                                                <td>{{$job->id}}</td>

                                                                <td>{{$job->Type->name}}</td>
                                                                <td>{{$job->problem}}</td>
                                                                <td>
                                                                    @foreach($job->Comment as $index =>$comment)
                                                                        @if(count($job->Comment)-1==$index)
                                                                            @if($comment->status_id=='งานใหม่')
                                                                                <span class="label label-warning">{{$comment->status_id}}</span>
                                                                            @elseif($comment->status_id=='ตรวจสอบข้อมูลงานซ่อม')
                                                                                <span class="label label-warning">{{$comment->status_id}}</span>
                                                                            @elseif($comment->status_id=='ดำเนินการซ่อม')
                                                                                <span class="label label-info">{{$comment->status_id}}</span>
                                                                            @elseif($comment->status_id=='ส่งเคลม')
                                                                                <span class="label label-danger">{{$comment->status_id}}</span>
                                                                            @elseif($comment->status_id=='ซ่อมเสร็จสิ้น')
                                                                                <span class="label label-primary">{{$comment->status_id}}</span>
                                                                            @elseif($comment->status_id=='รอผลความพึงพอใจในงานซ่อม')
                                                                                <span class="label label-success">{{$comment->status_id}}</span>
                                                                            @elseif($comment->status_id=='ประเมินผลความพึงพอใจในงานซ่อมแล้ว')
                                                                                <span class="label label-success">{{$comment->status_id}}</span>
                                                                            @elseif($comment->status_id=='ช่างรับงานซ่อม')
                                                                                <span class="label label-primary">{{$comment->status_id}}</span>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </td>

                                                                <td>{{$job->User->name}}</td>
                                                                <td>{{$job->telnum}}</td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="container">
                                    <div>
                                        <div class="collapse" id="navbarToggleExternalContent">
                                            <form action="{{action('ManagerController@store')}}" method="post">
                                                {{csrf_field()}}
                                                <div class="col-lg-2">
                                                    <input placeholder="คำค้นหา" class="form-control" type="text"
                                                           name="search">
                                                </div>
                                                <div class="col-lg-2">
                                                    <select class="form-control" name="selected">
                                                        <option value="id">รหัสงานซ่อม</option>
                                                        <option value="user_id">ชื่อผู้แจ้งซ่อม</option>
                                                        <option value="type_id">ประเภทปัญหา</option>
                                                        <option value="problem">ปัญหา</option>
                                                        <option value="telnum">เบอร์โทร</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <select class="form-control" name="status" id="">
                                                        <option value="ทั้งหมด">ทั้งหมด</option>
                                                        <option value="งานใหม่">งานใหม่</option>
                                                        <option value="ช่างรับงานซ่อม">ช่างรับงานซ่อม</option>
                                                        <option value="ตรวจสอบข้อมูลงานซ่อม">ตรวจสอบข้อมูลงานซ่อม
                                                        </option>
                                                        <option value="ดำเนินการซ่อม">ดำเนินการซ่อม</option>
                                                        <option value="ส่งเคลม">ส่งเคลม</option>
                                                        <option value="ซ่อมเสร็จสิ้น">ซ่อมเสร็จสิ้น</option>
                                                        <option value="รอผลความพึงพอใจในงานซ่อม">
                                                            รอผลความพึงพอใจในงานซ่อม
                                                        </option>
                                                        <option value="ประเมินผลความพึงพอใจในงานซ่อมแล้ว">
                                                            ประเมินผลความพึงพอใจในงานซ่อมแล้ว
                                                        </option>
                                                    </select>
                                                </div>
                                                <input class="btn-primary btn" type="submit" value="ค้นหา">
                                                <button class="btn-warning btn" type="button"
                                                        onclick="location.href='{{action("ManagerController@index")}}'">
                                                    ล้างการค้นหา
                                                </button>
                                            </form>
                                        </div>
                                        <nav class="navbar navbar-dark bg-dark">
                                            <div class="container">
                                                <button class="btn-complete btn" type="button" data-toggle="collapse"
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
                            @parent
                        </div>
                    </div>
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
                                            {extend: 'copy', text: 'คัดลอกเป็นข้อความ'},
                                            {extend: 'excel', text: 'Excel File'},
                                            {extend: 'pdf', text: 'PDF File'},
                                            {extend: 'print', text: 'สั่งพิมพ์ข้อมูลในตาราง'},
                                        ]
                                    });
                                });
                            </script>
    @endpush