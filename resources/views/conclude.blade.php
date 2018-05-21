<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>ระบบแจ้งซ่อม</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="/assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="/assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="/assets/plugins/mapplic/css/mapplic.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"
          media="screen">

    <link href="/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="/pages/css/pages.css" rel="stylesheet" type="text/css"/>
    <!--[if lte IE 9]>
    <link href="/assets/plugins/codrops-dialogFx/dialog.ie.css" rel="stylesheet" type="text/css" media="screen"/>
    <![endif]-->
    <link href="https://fonts.googleapis.com/css?family=Kanit:400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link class="main-stylesheet"
          href="/css/jquery.dataTables.min.css" rel="stylesheet"
          type="text/css"/>

</head>
<body class="fixed-header dashboard" style="font-family: 'Kanit', sans-serif;">

@include('layouts.master._sidebar')
@php($sum_avg = 0)
@php($sum_one=0)
@php($sum_two=0)
@php($sum_three=0)
@php($sum_four=0)
@php($sum_five=0)
@foreach($satisfactions as  $satisfaction)
    @php($sum_avg=$sum_avg+(($satisfaction->score1+$satisfaction->score2+$satisfaction->score3+$satisfaction->score4+$satisfaction->score5)/5) )
    @php($sum_one=($sum_one+$satisfaction->score1))
    @php($sum_two=($sum_two+$satisfaction->score2))
    @php($sum_three=($sum_three+$satisfaction->score3))
    @php($sum_four=($sum_four+$satisfaction->score4))
    @php($sum_five=($sum_five+$satisfaction->score5))
@endforeach


<div class="page-container ">

    <div class="header ">

        <div class="container-fluid relative">

            <div class="pull-left full-height visible-sm visible-xs">

                <div class="header-inner">
                    <a href="#"
                       class="btn-link toggle-sidebar visible-sm-inline-block visible-xs-inline-block padding-5"
                       data-toggle="sidebar">
                        <span class="icon-set menu-hambuger"></span>
                    </a>
                </div>

            </div>
            <div class="pull-center hidden-md hidden-lg">
                <div class="header-inner">
                    <div class="brand inline">
                        <img src="/assets/img/logo-sru.jpg" alt="logo" data-src="/assets/img/logo-sru.jpg"
                             data-src-retina="/assets/img/logo-sru.jpg" width="40" height="50">
                    </div>
                </div>
            </div>

            <div class="pull-right full-height visible-sm visible-xs">

                <div class="header-inner">
                    <a href="#" class="btn-link visible-sm-inline-block visible-xs-inline-block" data-toggle="quickview"
                       data-toggle-element="#quickview">
                        <span class="icon-set menu-hambuger-plus"></span>
                    </a>
                </div>

            </div>
        </div>
        {{--โลโก้มหาลัย--}}
        <div class=" pull-left sm-table hidden-xs hidden-sm">
            <div class="header-inner">
                <div class="brand inline">
                    <img src="/assets/img/logo-sru.jpg" alt="logo" data-src="/assets/img/logo-sru.jpg"
                         data-src-retina="/assets/img/logo-sru.jpg" width="40" height="50">
                </div>
                <span style="font-size: 14px;">
                    ระบบบริการแจ้งซ่อมบำรุงคอมพิวเตอร์และอุปกรณ์ ศูนย์คอมพิวเตอร์และสารสนเทศ มหาวิทยาลัยราชภัฎสุราษฎร์ธานี
                </span>
            </div>
        </div>
        <div class=" pull-right">
            @include('layouts.master._userinfo')
        </div>
        <div class=" pull-left">
            <div class=" pull-left sm-table hidden-xs hidden-sm">
                <div class="header-inner">

                    @if(\Illuminate\Support\Facades\Auth::user()->department_id==3 || \Illuminate\Support\Facades\Auth::user()->department_id==1)

                    @else
                        <ul class="notification-list no-margin hidden-sm hidden-xs b-grey b-l b-r no-style p-l-5 p-r-2">
                            <li class="p-r-15 inline">
                                <div class="dropdown">
                                    <a href="javascript:;" id="notification-center" class="icon-set globe-fill"
                                       data-toggle="dropdown">
                                        <span class="bubble"></span>
                                    </a>

                                    <div class="dropdown-menu notification-toggle" role="menu"
                                         aria-labelledby="notification-center">

                                        <div class="notification-panel">

                                            <div class="notification-body scrollable">

                                                {{--ชื่อผู้เข้าใช้--}}
                                                @php($Techonjobs=App\Techonjob::all()->where('systemuser_id','=',Auth::user()->id)->sortByDesc('id'))
                                                @foreach($Techonjobs as $Techonjob)
                                                    {{-- {{$Techonjob->job_id}}--}}
                                                    @php($count_notifications=App\Activity::where('properties->job_id','=',(string)$Techonjob->job_id)->count())
                                                    @if($count_notifications>0)
                                                        <div class="notification-item unread clearfix">

                                                            <div class="heading close">
                                                                <a href="#" class="text-complete pull-left">
                                                                    <i class="pg-map fs-16 m-r-10"></i>
                                                                    <span class="bold">งานที่ {{$Techonjob->job_id}}</span>
                                                                    <span class="fs-12 m-l-10">ความเคลื่อนไหวของงาน</span><br>
                                                                    <span class="bold">รายละเอียดงาน:{{$Techonjob->Job->problem ?? ''}}</span>
                                                                </a>
                                                                <div class="pull-right">
                                                                    <div class="thumbnail-wrapper d16 circular inline m-t-15 m-r-10 toggle-more-details">
                                                                        <div><i class="fa fa-angle-left"></i>
                                                                        </div>
                                                                    </div>
                                                                    @php($lastTime=App\Activity::where('properties->job_id','=',(string)$Techonjob->job_id)
                                                               ->latest()->first())
                                                                    <span class=" time">{{$lastTime->created_at}}</span>
                                                                </div>
                                                                @endif
                                                                @php($notifications=App\Activity::where('properties->job_id','=',(string)$Techonjob->job_id)
                                                                ->get())
                                                                {{--->latest()->first()--}}
                                                                @foreach($notifications as $notification)
                                                                    <div class="more-details">
                                                                        <div class="more-details-inner">
                                                                            <a href="{{route('AdminDetailJob',$Techonjob->job_id)}}">
                                                                                {{$notification->description}}
                                                                                :{{@$notification->SystemUser->name}}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                                @if($count_notifications>0)
                                                            </div>


                                                            <div class="option" data-toggle="tooltip"
                                                                 data-placement="left"
                                                                 title="mark as read">
                                                                <a href="#" class="mark"></a>
                                                            </div>

                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>


                                            <div class="notification-footer text-center">
                                                <class> กดที่ < เพื่อดูรายละเอียดการเปลี่ยนสถานะของงาน <br>ตรวจสอบรายละเอียดของงานซ่อม
                                                    โดยการกดที่สถานะของงานซ่อม
                                                </class>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </li>

                        </ul>
                    @endif

                </div>
            </div>
        </div>

    </div>


    <div class="page-content-wrapper ">

        <div class="content sm-gutter">

            <div class="container-fluid padding-25 sm-padding-10">

                <div class="row">
                    <div class="col-md-12 col-xlg-12">
                        <div class="row">
                            <div class="col-sm-3 m-b-5">
                                <div class="ar-2-1">

                                    <div class="widget-4 panel no-border  no-margin widget-loader-bar">
                                        <div class="container-sm-height full-height">
                                            <div class="row-sm-height">
                                                <div class="col-sm-height col-top">
                                                    <div class="panel-heading ">
                                                        <div class="panel-title text-black hint-text">
                                  <span style="font-size: 20px">
	                                  งานทั้งหมดภายในระบบ <i class="fa fa-cogs color-primary"></i>
                                  </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-sm-height">
                                                <div class="col-sm-height col-top">
                                                    <div class="p-l-20 p-r-20">
                                                        <h5 class="no-margin p-b-5 pull-left hint-text">จำนวน</h5>
                                                        <e class="pull-right no-margin bold"
                                                           style="font-size: 30px">{{count($jobs)}}</e>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-sm-height">
                                                <div class="col-sm-height col-bottom ">
                                                    <div class="widget-4-chart line-chart " data-line-color="success"
                                                         data-area-color="success-light" data-y-grid="false"
                                                         data-points="false" data-stroke-width="2">
                                                        <svg></svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-3 m-b-5">
                                <div class="ar-2-1">

                                    <div class="widget-4 panel no-border  no-margin widget-loader-bar">
                                        <div class="container-sm-height full-height">
                                            <div class="row-sm-height">
                                                <div class="col-sm-height col-top">
                                                    <div class="panel-heading ">
                                                        <div class="panel-title text-black hint-text">
                                  <span style="font-size: 20px">
	                                  งานที่ซ่อมเสร็จ <i class="fa  fa-check-square-o f-s-40 color-success"></i>
                                  </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-sm-height">
                                                <div class="col-sm-height col-top">
                                                    <div class="p-l-20 p-r-20">
                                                        <h5 class="no-margin p-b-5 pull-left hint-text">จำนวน</h5>
                                                        <e class="pull-right no-margin bold"
                                                           style="font-size: 30px">{{count($time_diff)}}</e>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-sm-height">
                                                <div class="col-sm-height col-bottom ">
                                                    <div class="widget-4-chart line-chart " data-line-color="success"
                                                         data-area-color="success-light" data-y-grid="false"
                                                         data-points="false" data-stroke-width="2">
                                                        <svg></svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-3 m-b-5">
                                <div class="ar-2-1">

                                    <div class="widget-4 panel no-border  no-margin widget-loader-bar">
                                        <div class="container-sm-height full-height">
                                            <div class="row-sm-height">
                                                <div class="col-sm-height col-top">
                                                    <div class="panel-heading ">
                                                        <div class="panel-title text-black hint-text">
                                  <span style="font-size: 20px">
	                                  เวลาเฉลี่ยในแต่ละงาน <i class="fa fa-clock-o f-s-40 color-warning"></i>
                                  </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-sm-height">
                                                <div class="col-sm-height col-top">
                                                    <div class="p-l-20 p-r-20">
                                                        <e class="pull-right     no-margin bold"
                                                           style="font-size: 30px">{{number_format(array_sum($time_diff)/count($time_diff), 2, '.', '')}}
                                                            นาที</e>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-sm-height">
                                                <div class="col-sm-height col-bottom ">
                                                    <div class="widget-4-chart line-chart " data-line-color="success"
                                                         data-area-color="success-light" data-y-grid="false"
                                                         data-points="false" data-stroke-width="2">
                                                        <svg></svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-3 m-b-5">
                                <div class="ar-2-1">

                                    <div class="widget-4 panel no-border  no-margin widget-loader-bar">
                                        <div class="container-sm-height full-height">
                                            <div class="row-sm-height">
                                                <div class="col-sm-height col-top">
                                                    <div class="panel-heading ">
                                                        <div class="panel-title text-black hint-text">
                                  <span style="font-size: 20px">
	                                  คะแนนเฉลี่ยของทั้งระบบ <i class="fa fa-user f-s-40 color-danger"></i>
                                  </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-sm-height">
                                                <div class="col-sm-height col-top">
                                                    <div class="p-l-20 p-r-20">
                                                        <h5 class="no-margin p-b-5 pull-left hint-text">เฉลี่ย</h5>
                                                        <e class="pull-right no-margin bold"
                                                           style="font-size: 30px">{{number_format($sum_avg/count($satisfactions),'2','.','')}}</e>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-sm-height">
                                                <div class="col-sm-height col-bottom ">
                                                    <div class="widget-4-chart line-chart " data-line-color="success"
                                                         data-area-color="success-light" data-y-grid="false"
                                                         data-points="false" data-stroke-width="2">
                                                        <svg></svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="app">
                                    <center>
                                        {!! $type_job->html() !!}
                                    </center>
                                </div>
                                {!! Charts::scripts() !!}
                                {!! $chartAllJob->script() !!}
                                {!! $TectOnJob->script() !!}
                                {!! $type_job->script() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 panel">
                        <div class="row-sm-height">
                            <div class="col-sm-height col-top">
                                <div class="panel-heading ">
                                    <div class="panel-title text-black hint-text">
                                  <span style="font-size: 16px">
	                                  งานที่นานที่สุดในระบบ <i class="fa fa-cogs color-primary"></i>
                                  </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table style="font-size: 12px" class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>รหัสงาน</th>
                                <th>สถานะ</th>
                                <th>ปัญหา</th>
                                <th>วันที่</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobLessSend as $index=>$item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->Comment->last()->status_id}}</td>
                                    <td>{{$item->problem}}</td>
                                    <td>{{$item->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="app">
                            <center>
                                {!! $chartAllJob->html() !!}
                            </center>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        {!! $TectOnJob->html() !!}
                    </div>
                </div>
                <style>
                    .column {
                        float: left;
                        width: 20%;
                        padding: 10px;
                        height: 300px;
                    }

                    .center {
                        text-align: center;
                    }
                </style>
                <div class="row">

                    <div class="col-lg-12 center panel">
                        <label style="font-size: 20px">คะแนนเฉลี่ยในแต่ละด้าน</label>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 m-b-5 column">
                            <div class="ar-2-1">

                                <div class="widget-4 panel no-border  no-margin widget-loader-bar">
                                    <div class="container-sm-height full-height">
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-top">
                                                <div class="panel-heading ">
                                                    <div class="panel-title text-black hint-text">
                                  <span style="font-size: 18px">
	                                  ด้านความรวดเร็วในการแก้ปัญหาของเจ้าหน้าที่
                                  </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-top">
                                                <div class="p-l-20 p-r-20">
                                                    <h5 class="no-margin p-b-5 pull-left hint-text">เฉลี่ย</h5>
                                                    <e class="pull-right no-margin bold"
                                                       style="font-size: 30px">{{number_format($sum_one/count($satisfactions),'2','.','')}}</e>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-bottom ">
                                                <div class="widget-4-chart line-chart " data-line-color="success"
                                                     data-area-color="success-light" data-y-grid="false"
                                                     data-points="false" data-stroke-width="2">
                                                    <svg></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-3 m-b-5 column">
                            <div class="ar-2-1">

                                <div class="widget-4 panel no-border  no-margin widget-loader-bar">
                                    <div class="container-sm-height full-height">
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-top">
                                                <div class="panel-heading ">
                                                    <div class="panel-title text-black hint-text">
                                  <span style="font-size: 18px">
	                                  สามารถแก้ปัญหาได้ตรงจุด
                                  </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-top">
                                                <div class="p-l-20 p-r-20">
                                                    <h5 class="no-margin p-b-5 pull-left hint-text">เฉลี่ย</h5>
                                                    <e class="pull-right no-margin bold"
                                                       style="font-size: 30px">{{number_format($sum_two/count($satisfactions),'2','.','')}}</e>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-bottom ">
                                                <div class="widget-4-chart line-chart " data-line-color="success"
                                                     data-area-color="success-light" data-y-grid="false"
                                                     data-points="false" data-stroke-width="2">
                                                    <svg></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-3 m-b-5 column">
                            <div class="ar-2-1">

                                <div class="widget-4 panel no-border  no-margin widget-loader-bar">
                                    <div class="container-sm-height full-height">
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-top">
                                                <div class="panel-heading ">
                                                    <div class="panel-title text-black hint-text">
                                  <span style="font-size: 18px">
	                                  เจ้าหน้าที่ที่ให้บริการซ่อมมีมนุษยสัมพันธ์ที่ดี
                                  </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-top">
                                                <div class="p-l-20 p-r-20">
                                                    <h5 class="no-margin p-b-5 pull-left hint-text">เฉลี่ย</h5>
                                                    <e class="pull-right no-margin bold"
                                                       style="font-size: 30px">{{number_format($sum_three/count($satisfactions),'2','.','')}}</e>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-bottom ">
                                                <div class="widget-4-chart line-chart " data-line-color="success"
                                                     data-area-color="success-light" data-y-grid="false"
                                                     data-points="false" data-stroke-width="2">
                                                    <svg></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-3 m-b-5 column">
                            <div class="ar-2-1">

                                <div class="widget-4 panel no-border  no-margin widget-loader-bar">
                                    <div class="container-sm-height full-height">
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-top">
                                                <div class="panel-heading ">
                                                    <div class="panel-title text-black hint-text">
                                  <span style="font-size: 18px">
	                                  เจ้าหน้าที่มีความรับผิดชอบต่องานซ่อมที่รับผิดชอบ
                                  </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-top">
                                                <div class="p-l-20 p-r-20">
                                                    <h5 class="no-margin p-b-5 pull-left hint-text">เฉลี่ย</h5>
                                                    <e class="pull-right no-margin bold"
                                                       style="font-size: 30px">{{number_format($sum_four/count($satisfactions),'2','.','')}}</e>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-bottom ">
                                                <div class="widget-4-chart line-chart " data-line-color="success"
                                                     data-area-color="success-light" data-y-grid="false"
                                                     data-points="false" data-stroke-width="2">
                                                    <svg></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-3 m-b-5 column">
                            <div class="ar-2-1">

                                <div class="widget-4 panel no-border  no-margin widget-loader-bar">
                                    <div class="container-sm-height full-height">
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-top">
                                                <div class="panel-heading ">
                                                    <div class="panel-title text-black hint-text">
                                  <span style="font-size: 18px">
	                                  ความพึงพอใจหลังจากได้รับบริการซ่อมจากระบบ
                                  </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-top">
                                                <div class="p-l-20 p-r-20">
                                                    <h5 class="no-margin p-b-5 pull-left hint-text">เฉลี่ย</h5>
                                                    <e class="pull-right no-margin bold"
                                                       style="font-size: 30px">{{number_format($sum_five/count($satisfactions),'2','.','')}}</e>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-sm-height">
                                            <div class="col-sm-height col-bottom ">
                                                <div class="widget-4-chart line-chart " data-line-color="success"
                                                     data-area-color="success-light" data-y-grid="false"
                                                     data-points="false" data-stroke-width="2">
                                                    <svg></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <span style="font-size: 16px">
	                                  รายละเอียดของคะแนนประเมินในแต่ละงานซ่อม
                                  </span>
                        <table id="myTable" class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <td>ลำดับที่</td>
                                <td>รหัสงานซ่อม</td>
                                <td>รายละเอียดปัญหา</td>
                                <td>คะแนนที่ได้รับรวม</td>
                                <td>คะแนนเฉลี่ย</td>
                                <td>ด้านความรวดเร็วในการแก้ปัญหาของเจ้าหน้าที่</td>
                                <td>สามารถแก้ปัญหาได้ตรงจุด</td>
                                <td>เจ้าหน้าที่ที่ให้บริการซ่อมมีมนุษยสัมพันธ์ที่ดี</td>
                                <td>เจ้าหน้าที่มีความรับผิดชอบต่องานซ่อมที่รับผิดชอบ</td>
                                <td>ความพึงพอใจหลังจากได้รับบริการซ่อมจากระบบ</td>
                                <td>ความคิดเห็น</td>
                            </tr>
                            </thead>
                            <tbody>
                            @php($key=0)
                            @foreach($jobs as $job)
                                @foreach($job->Comment as $comment)
                                    @if($comment->status_id == 'ประเมินผลความพึงพอใจในงานซ่อมแล้ว')
                                        @php($key=$key+1)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$job->id}}</td>
                                            <td>{{$job->problem}}</td>
                                            <td>
                                                @php($Array_sum = 0)
                                                @php($Array_score = 0)
                                                @php($Array_score = $job->Satisfaction
                                                ->select('score1','score2','score3','score4','score5')
                                                ->orderBy('job_id', 'asc')->get()->toArray())
                                                @php($Array_sum = array_sum($Array_score[$key-1]))
                                                {{$Array_sum}}
                                            </td>
                                            <td>{{$Array_sum/5}}</td>
                                            <td>{{$job->Satisfaction->score1}}</td>
                                            <td>{{$job->Satisfaction->score2}}</td>
                                            <td>{{$job->Satisfaction->score3}}</td>
                                            <td>{{$job->Satisfaction->score4}}</td>
                                            <td>{{$job->Satisfaction->score5}}</td>
                                            <td>{{$job->Satisfaction->comment}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


        <div class="container-fluid container-fixed-lg footer">
            <div class="copyright sm-text-center">
                Copyrights © 2018 All Rights Reserved by สำนักวิทยบริการและเทคโนโลยีสารสนเทศ.
                พัฒนาโดย : นักศึกษาสาขาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยราชภัฏสุราษฎร์ธานี
                <p class="small no-margin pull-left sm-pull-reset">
                <div class="clearfix"></div>
            </div>
        </div>

    </div>

</div>


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
<script src="/assets/plugins/nvd3/lib/d3.v3.js" type="text/javascript"></script>
<script src="/assets/plugins/nvd3/nv.d3.min.js" type="text/javascript"></script>
<script src="/assets/plugins/nvd3/src/utils.js" type="text/javascript"></script>
<script src="/assets/plugins/nvd3/src/tooltip.js" type="text/javascript"></script>
<script src="/assets/plugins/nvd3/src/interactiveLayer.js" type="text/javascript"></script>
<script src="/assets/plugins/nvd3/src/models/axis.js" type="text/javascript"></script>
<script src="/assets/plugins/nvd3/src/models/line.js" type="text/javascript"></script>
<script src="/assets/plugins/nvd3/src/models/lineWithFocusChart.js" type="text/javascript"></script>
<script src="/assets/plugins/mapplic/js/hammer.js"></script>
<script src="/assets/plugins/mapplic/js/jquery.mousewheel.js"></script>
<script src="/assets/plugins/mapplic/js/mapplic.js"></script>
<script src="/assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="/assets/plugins/skycons/skycons.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>


<script src="/pages/js/pages.min.js"></script>


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
            "order": [[0, "asc"]],
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

</body>
</html>