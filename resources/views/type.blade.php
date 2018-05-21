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
                                    <h5 class="page-title">จัดการประเภทของงานซ่อม</h5>
                                </div>
                                <div class="container">
                                    <a class="pull-right" href="{{action('TypeController@create')}}">
                                        <button class="btn btn-primary pull-right">เพิ่มประเภทของงานซ่อม</button>
                                    </a>
                                </div>
                                <div class="container">
                                    <table id="myTable" class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>รหัสของอาการเสีย</th>
                                            <th>ประเภทของการแจ้งซ่อม</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($types as $type)
                                            <tr>
                                                <td>{{$type['id']}}</td>
                                                <td>{{$type['name']}}</td>

                                                <td><a href="{{action('TypeController@edit', $type['id'])}}"
                                                       class="btn btn-warning">แก้ไขชื่อประเภทของงานซ่อม</a></td>
                                                <td>
                                                    <form action="{{action('TypeController@destroy', $type['id'])}}"
                                                          method="post">
                                                        {{csrf_field()}}
                                                        <input name="_method" type="hidden" value="DELETE">

                                                        <button class="btn btn-danger" name="archive" type="submit"
                                                                onclick="archiveFunction()">
                                                            <i class="fa fa-archive"></i>
                                                            ลบประเภทของงานซ่อม
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
    <script>
        function archiveFunction() {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            swal({
                    title: "ลบประเภทของงานซ่อม?",
                    text: "คุณต้องการที่จะลบประเภทของงานซ่อม?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#66FF99",
                    confirmButtonText: "ยืนยัน!",
                    cancelButtonText: "ยกเลิก!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        form.submit();          // submitting the form when user press yes
                    } else {
                        swal("ยกเลิกเรียบร้อย", "ยกเลิกการลบประเภทของการซ่อม", "error");
                    }
                });
        }
    </script>
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