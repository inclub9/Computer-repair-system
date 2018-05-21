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

                                <div class="panel-heading separator">
                                    <div class="panel-title">
                                        <h5 style="font-family: 'Kanit', sans-serif;">ข้อมูลของงานซ่อม</h5>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach($jobs as $job)
                                                <div class="page-header">
                                                    <spen style="font-family: 'Kanit', sans-serif; font-size: 16px">
                                                        รายละเอียดปัญหา:<b>{{$job->problem}}</b>
                                                        วันที่: <b>{{$job->created_at}}</b>
                                                        เมื่อ:<b>{{$job->created_at->diffForHumans()}}</b><br>
                                                        ผู้แจ้ง: <b>{{$job->User->name}}</b><br>
                                                        เบอร์ติดต่อ: <b>{{$job->telnum}}</b><br>
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
                                                        <spen style="font-family: 'Kanit', sans-serif; font-size: 16px">
                                                            ประเภทของอาการเสีย
                                                            : <b>{{$job->Type->name??'ไม่มีประเภท'}}</b></spen>
                                                        <div class="container">
                                                            <form action="{{action("JobController@changeType",$job->id)}}">
                                                                <div class="col-lg-2">
                                                                    <select name="typeChange"
                                                                            class="form-control">
                                                                        @foreach($types as $type)
                                                                            @if($type->id == $job->type_id)
                                                                            @endif
                                                                            <option
                                                                                    @if($type->id == $job->type_id)
                                                                                    selected
                                                                                    @endif
                                                                                    value="{{$type->id}}">{{$type->name}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <button class="btn btn-warning"
                                                                        name="archive"
                                                                        type="submit"
                                                                        onclick="archiveFunction()">
                                                                    <i class="fa fa-archive"></i>
                                                                    ยืนยันการเปลี่ยนประเภท
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endforeach
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
                                                                    <h4 class="timeline-title">{{$com->status_id}}</h4>
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

                                <div class="col-md-5">
                                    @if($SystemUserBoolean==false && $SystemUserCount == false)

                                        <button class="btn btn-complete btn-cons" type="submit"
                                                onclick="location.href='{{action('JobController@acceptionJobDub',$id)}}'">
                                            เข้าร่วมงาน
                                        </button>
                                    @endif

                                    @if($SystemUserBoolean==false && $SystemUserCount == true)
                                        <button class="btn btn-complete btn-cons"
                                                onclick="location.href='{{action('JobController@acceptionJob',$id)}}'">
                                            รับงานซ่อม
                                        </button>
                                    @elseif($statuss['status_id']=='ช่างรับงานซ่อม'&&$SystemUserBoolean==true)
                                        <button class="btn btn-complete btn-cons" type="submit"
                                                onclick="location.href='{{action('JobController@status',['id'=>$id,'status'=>'ตรวจสอบข้อมูลงานซ่อม'])}}'">
                                            ตรวจสอบข้อมูลงานซ่อม
                                        </button>
                                    @elseif($statuss['status_id']=='ตรวจสอบข้อมูลงานซ่อม'&&$SystemUserBoolean==true)
                                        <button class="btn btn-complete btn-cons" type="submit"
                                                onclick="location.href='{{action('JobController@status',['id'=>$id,'status'=>'ดำเนินการซ่อม'])}}'">
                                            ดำเนินการซ่อม
                                        </button>
                                        <button class="btn btn-complete btn-cons" type="submit"
                                                onclick="location.href='{{action('JobController@status',['id'=>$id,'status'=>'ส่งเคลม'])}}'">
                                            ส่งเคลม
                                        </button>
                                    @elseif($statuss['status_id']=='ดำเนินการซ่อม'&&$SystemUserBoolean==true)
                                        <form style="display:inline"
                                              action="{{action('JobController@status',['id'=>$id,'status'=>'ดำเนินการซ่อม'])}}">
                                            <div class="form-group">
                                                <label class="" for="tx">ข้อมูลการทำงาน</label>
                                                <textarea id="tx"
                                                          placeholder="ข้อมูลการทำงานรายละเอียดต่างๆในการดำเนินงาน"
                                                          name="comment" class="form-control"></textarea>
                                            </div>
                                            <button class="btn btn-complete btn-cons" type="submit">
                                                ดำเนินการซ่อม
                                            </button>
                                        </form>
                                        <button class="btn btn-complete btn-cons" type="submit"
                                                onclick="location.href='{{action('JobController@status',['id'=>$id,'status'=>'ซ่อมเสร็จสิ้น'])}}'">
                                            ซ่อมเสร็จสิ้น
                                        </button>
                                    @elseif($statuss['status_id']=='ส่งเคลม'&&$SystemUserBoolean==true)
                                        ส่งเคลม
                                        @foreach($jobs as $claim)
                                            @foreach($claim->Claim as $c)
                                                {{$c->status}}
                                            @endforeach
                                        @endforeach
                                    @elseif($statuss['status_id']=='ซ่อมเสร็จสิ้น'&&$SystemUserBoolean==true)
                                    @elseif($statuss['status_id']=='รอผลความพึงพอใจในงานซ่อม'&&$SystemUserBoolean==true)
                                        รอผลความพึงพอใจในงานซ่อม
                                    @elseif($statuss['status_id']=='ประเมินผลความพึงพอใจในงานซ่อมแล้ว'&&$SystemUserBoolean==true)
                                    @endif
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
            <script>
                function archiveFunction() {
                    event.preventDefault(); // prevent form submit
                    var form = event.target.form; // storing the form
                    swal({
                            title: "เปลี่ยนประเภทของงานซ่อม?",
                            text: "คุณต้องการที่จะเปลี่ยนประเภทของงานซ่อม?",
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
                                swal("ยกเลิกเรียบร้อย", "ยกเลิกการเปลี่ยนประเภทของการซ่อม", "error");
                            }
                        });
                }
            </script>
            <script src="/assets/js/scripts.js" type="text/javascript"></script>
    @endpush