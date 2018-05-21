@extends('layouts.master')
@section('tile','User')
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
                                @foreach($jobs as $job)
                                    {{$job->id}}
                                    {{$job->problem}}<br>
                                    {{$job->Type->name??'ไม่มีประเภทของงานซ่อม'}}


                                    {{-- <button class="btn btn-complete btn-cons" type="submit">
                                         ตกลง
                                     </button>--}}

                                    <hr>
                                    ข้อมูลเจ้าหน้าที่ช่างที่รับผิดชอบ <br>
                                    @foreach($job->Techonjob as $toj)
                                        รหัสช่าง: {{$toj->id}}
                                        ชื่อช่าง: {{$toj->SystemUser->name}}
                                        {{$toj->SystemUser->created_at}}<br>
                                    @endforeach
                                    <hr>
                                    <table>
                                        @foreach($job->Comment as $com)
                                            <td>&nbsp;</td>
                                            <td style="border-right-style:dotted; border-right-width:1px">
                                                <center>{{ $com->status_id}}</center>
                                                ความคิดเห็นของสถานะ: {{$com->comment}}<br>
                                                โดยช่าง: {{$com->SystemUser->name ?? 'ไม่มีช่าง'}}<br>
                                                เมื่อเวลา: {{$com->created_at->format('d-m-Y H:m')}}<br>
                                            {{$com->created_at->diffForHumans()}}
                                            <td>
                                            <td>&nbsp;</td>
                                        @endforeach
                                    </table>
                                @endforeach
                                <br>
                                <div class="col-md-3">


                                </div>



                                @parent

                                @endsection

                                @push('pages_css')
                                    <link class="main-stylesheet" href="/pages/css/pages.css" rel="stylesheet"
                                          type="text/css"/>
                                    <script src="/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
                                    <script src="/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
                                    <script src="/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
                                    <script src="/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
                                    <script src="/assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
                                    <script src="/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
                                    <script src="/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
                                    <script src="/assets/plugins/jquery-bez/jquery.bez.min.js"></script>
                                    <script src="/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
                                    <script src="/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
                                    <script src="/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
                                    <script type="text/javascript" src="/assets/plugins/select2/js/select2.full.min.js"></script>
                                    <script type="text/javascript" src="/assets/plugins/classie/classie.js"></script>
                                    <script src="/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
                                @endpush

                                @push('pages_js')
                                    <script src="/assets/js/scripts.js" type="text/javascript"></script>
    @endpush