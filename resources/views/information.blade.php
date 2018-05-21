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
                                    <h4 class="page-title">จัดการข่าว</h4>
                                </div>
                                <div class="container">
                                            <button onclick="location.href='{{action('InformationController@showinput')}}'"
                                                    class="btn btn-primary pull-right">
                                                เพิ่มข่าวประชาสัมพันธ์
                                            </button>
                                </div>
                                <div class="container">
                                    <table id="myTable" class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>ข่าว</th>
                                            <th>URL ของเว็บไซต์</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($informations as $information)

                                            <tr>
                                                <td>{{$information->news}}</td>
                                                <td>{{$information->url}}</td>
                                                <td>
                                                    <a href="{{action('InformationController@show', $information['id'])}}"
                                                       class="btn btn-warning">แก้ไขชื่อข่าวประชาสัมพันธ์</a>
                                                </td>
                                                <td>
                                                    <form action="{{action('InformationController@destroy', $information['id'])}}"
                                                          method="post">
                                                        {{csrf_field()}}
                                                        <input name="_method" type="hidden" value="DELETE">

                                                        <button class="btn btn-danger" name="archive" type="submit"
                                                                onclick="archiveFunction()">
                                                            <i class="fa fa-archive"></i>
                                                            ลบข่าวประชาสัมพันธ์
                                                        </button>
                                                        <script>
                                                            function archiveFunction() {
                                                                event.preventDefault(); // prevent form submit
                                                                var form = event.target.form; // storing the form
                                                                swal({
                                                                        title: "ลบข่าวประชาสัมพันธ์?",
                                                                        text: "คุณต้องการที่จะลบข่าวประชาสัมพันธ์?",
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
                                                                            swal("ยกเลิกเรียบร้อย", "ยกเลิกการลบข่าวประชาสัมพันธ์", "error");
                                                                        }
                                                                    });
                                                            }
                                                        </script>
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
                                        }
                                    });
                                });
                            </script>
    @endpush