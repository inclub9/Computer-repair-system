@extends('layouts.master')
@section('tile','User')
@section('content')

    <div class="page-content-wrapper ">



        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="content">

                                <div class="panel-heading separator">
                                    <div class="panel-title">
                                        <h5 style="font-family: 'Kanit', sans-serif;">ข้อมูลของงานซ่อม</h5>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="page-header">
                                                @foreach($jobs as $job)
                                                    <spen style="font-family: 'Kanit', sans-serif; font-size: 16px">
                                                        รายละเอียดปัญหา:<b>{{$job->problem}}</b>
                                                        วันที่: <b>{{$job->created_at}}</b>
                                                        เมื่อ:<b>{{$job->created_at->diffForHumans()}}</b><br>
                                                        รายละเอียดของสถานที่: <b>{{$job->Comment->first()->comment}}</b>
                                                    </spen>
                                                    <br>
                                                    <spen style="font-family: 'Kanit', sans-serif; font-size: 16px">
                                                        ช่างที่รับงานซ่อมนี้
                                                    </spen>
                                                    @foreach($job->Techonjob as $toj)
                                                        <spen style="font-family: 'Kanit', sans-serif; font-size: 16px">
                                                            รหัสช่าง: <b>{{$toj->id}}</b>
                                                            ชื่อช่าง: <b>{{$toj->SystemUser->name}}</b>
                                                            วันที่:<b>{{$toj->SystemUser->created_at}}</b>
                                                            เมื่อ:<b>{{$toj->SystemUser->created_at->diffForHumans()}}</b>
                                                        </spen><br>
                                                    @endforeach
                                                    <spen style="font-family: 'Kanit', sans-serif; font-size: 16px">
                                                        ประเภทของอาการเสีย
                                                        : <b>{{$job->Type->name??'ไม่มีประเภท'}}</b></spen>
                                            </div>
                                            <ul class="timeline">
                                                    @foreach($job->Comment as $com)
                                                    <li class="timeline-item">
                                                        @if($com->status_id=='งานใหม่')
                                                            @php($icon = 'danger')
                                                            @php($collor = 'asterisk')
                                                        @elseif($com->status_id=='ตรวจสอบข้อมูลงานซ่อม')
                                                            @php($icon = 'info')
                                                            @php($collor = 'refresh')
                                                        @elseif($com->status_id=='ดำเนินการซ่อม')
                                                            @php($icon = 'primary')
                                                            @php($collor = 'screenshot')
                                                        @elseif($com->status_id=='ส่งเคลม')
                                                            @php($icon = 'danger')
                                                            @php($collor = 'alert')
                                                        @elseif($com->status_id=='ซ่อมเสร็จสิ้น')
                                                            @php($icon = 'success')
                                                            @php($collor = 'check')
                                                        @elseif($com->status_id=='รอผลความพึงพอใจในงานซ่อม')
                                                            @php($icon = '')
                                                            @php($collor = 'check')
                                                        @elseif($com->status_id=='ประเมินผลความพึงพอใจในงานซ่อมแล้ว')
                                                            @php($satas = \App\Satisfaction::select('score1','score2','score3','score4','score5')->where('job_id','=',$job->id)->get()->toArray())
                                                        @php($avg = array_sum($satas[0])/5)
                                                            @php($icon = '')
                                                            @php($collor = 'check')
                                                        @elseif($com->status_id=='ช่างรับงานซ่อม')
                                                            @php($icon = 'warning')
                                                            @php($collor = 'check')
                                                        @endif
                                                        <div class="timeline-badge {{$icon}}"><i
                                                                    class="glyphicon glyphicon-{{$collor}}"></i>
                                                        </div>
                                                        <div class="timeline-panel">
                                                            <div class="timeline-heading">
                                                                <h4 class="timeline-title">
                                                                    @if($com->status_id=='ประเมินผลความพึงพอใจในงานซ่อมแล้ว')
                                                                        {{$com->status_id}} <br> ค่าเฉลี่ยคะแนนความพึงพอใจ:{{$avg}}
                                                                        @else{{$com->status_id}}
                                                                        @endif
                                                                </h4>
                                                                <p>
                                                                    <small class="text-muted"><i
                                                                                class="glyphicon glyphicon-time"></i>
                                                                        {{$com->created_at->format('d-m-Y H:m')}}
                                                                        {{$com->created_at->diffForHumans()}}
                                                                    </small>
                                                                </p>
                                                            </div>
                                                            <div class="timeline-body">
                                                                <p>{{$com->comment}}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <li class="timeline-item"></li>
                                            </ul>
                                            @endforeach
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
                <link href="/pages/css/timeline.css" rel="stylesheet"
                      type="text/css"/>
            @endpush

            @push('pages_js')
                <script src="/assets/js/scripts.js" type="text/javascript"></script>
    @endpush