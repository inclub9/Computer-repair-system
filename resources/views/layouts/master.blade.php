<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
<head>
    @include('layouts.partials._head')
</head>
<body class="fixed-header horizontal-menu" style="font-family: 'Kanit', sans-serif;">
@include('layouts.master._sidebar')

<div class="page-container">


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



@section('content')





            <div class="container-fluid container-fixed-lg footer">
                <div class="copyright sm-text-center">
                    Copyrights © 2018 All Rights Reserved by สำนักวิทยบริการและเทคโนโลยีสารสนเทศ.
                    พัฒนาโดย : นักศึกษาสาขาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยราชภัฏสุราษฎร์ธานี
                    <p class="small no-margin pull-left sm-pull-reset">
                    <div class="clearfix"></div>
                </div>
            </div>


</div>
@show



<div id="quickview" class="quickview-wrapper" data-pages="quickview">

    <ul class="nav nav-tabs">
        <li class="">
            <a href="#quickview-notes" data-toggle="tab">Notes</a>
        </li>
        <li>
            <a href="#quickview-alerts" data-toggle="tab">Alerts</a>
        </li>
        <li class="active">
            <a href="#quickview-chat" data-toggle="tab">Chat</a>
        </li>
    </ul>
    <a class="btn-link quickview-toggle" data-toggle-element="#quickview" data-toggle="quickview"><i
                class="pg-close"></i></a>

    <div class="tab-content">

        <div class="tab-pane fade  in no-padding" id="quickview-notes">
            <div class="view-port clearfix quickview-notes" id="note-views">

                <div class="view list" id="quick-note-list">
                    <div class="toolbar clearfix">
                        <ul class="pull-right ">
                            <li>
                                <a href="#" class="delete-note-link"><i class="fa fa-trash-o"></i></a>
                            </li>
                            <li>
                                <a href="#" class="new-note-link" data-navigate="view" data-view-port="#note-views"
                                   data-view-animation="push"><i class="fa fa-plus"></i></a>
                            </li>
                        </ul>
                        <button class="btn-remove-notes btn btn-xs btn-block" style="display:none"><i
                                    class="fa fa-times"></i> Delete
                        </button>
                    </div>
                    <ul>

                        <li data-noteid="1" data-navigate="view" data-view-port="#note-views"
                            data-view-animation="push">
                            <div class="left">

                                <div class="checkbox check-warning no-margin">
                                    <input id="qncheckbox1" type="checkbox" value="1">
                                    <label for="qncheckbox1"></label>
                                </div>


                                <p class="note-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                    veniam</p>

                            </div>

                            <div class="right pull-right">

                                <span class="date">12/12/14</span>
                                <a href="#"><i class="fa fa-chevron-right"></i></a>

                            </div>

                        </li>

                    </ul>
                </div>

                <div class="view note" id="quick-note">
                    <div>
                        <ul class="toolbar">
                            <li><a href="#" class="close-note-link" data-navigate="view" data-view-port="#note-views"
                                   data-view-animation="push"><i class="pg-arrow_left"></i></a>
                            </li>
                            <li><a href="#" class="Bold"><i class="fa fa-bold"></i></a>
                            </li>
                            <li><a href="#" class="Italic"><i class="fa fa-italic"></i></a>
                            </li>
                            <li><a href="#" class=""><i class="fa fa-link"></i></a>
                            </li>
                        </ul>
                        <div class="body">
                            <div>
                                <div class="top">
                                    <span>21st april 2014 2:13am</span>
                                </div>
                                <div class="content">
                                    <div class="quick-note-editor full-width full-height js-input"
                                         contenteditable="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-pane fade no-padding" id="quickview-alerts">
            <div class="view-port clearfix" id="alerts">

                <div class="view bg-white">

                    <div class="navbar navbar-default navbar-sm">
                        <div class="navbar-inner">

                            <a href="javascript:;" class="inline action p-l-10 link text-master" data-navigate="view"
                               data-view-port="#chat" data-view-animation="push-parrallax">
                                <i class="pg-more"></i>
                            </a>

                            <div class="view-heading">
                                Notications
                            </div>

                            <a href="#" class="inline action p-r-10 pull-right link text-master">
                                <i class="pg-search"></i>
                            </a>

                        </div>
                    </div>


                    <div data-init-list-view="ioslist" class="list-view boreded no-top-border">

                        <div class="list-view-group-container">

                            <div class="list-view-group-header text-uppercase">
                                Calendar
                            </div>

                            <ul>

                                <li class="alert-list">

                                    <a href="javascript:;" class="" data-navigate="view" data-view-port="#chat"
                                       data-view-animation="push-parrallax">
                                        <p class="col-xs-height col-middle">
                                            <span class="text-warning fs-10"><i class="fa fa-circle"></i></span>
                                        </p>
                                        <p class="p-l-10 col-xs-height col-middle col-xs-9 overflow-ellipsis fs-12">
                                            <span class="text-master">David Nester Birthday</span>
                                        </p>
                                        <p class="p-r-10 col-xs-height col-middle fs-12 text-right">
                                            <span class="text-warning">Today <br></span>
                                            <span class="text-master">All Day</span>
                                        </p>
                                    </a>


                                </li>

                            </ul>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="tab-pane fade in active no-padding" id="quickview-chat">
            <div class="view-port clearfix" id="chat">
                <div class="view bg-white">

                    <div class="navbar navbar-default">
                        <div class="navbar-inner">

                            <a href="javascript:;" class="inline action p-l-10 link text-master" data-navigate="view"
                               data-view-port="#chat" data-view-animation="push-parrallax">
                                <i class="pg-plus"></i>
                            </a>

                            <div class="view-heading">
                                Chat List
                                <div class="fs-11">Show All</div>
                            </div>

                            <a href="#" class="inline action p-r-10 pull-right link text-master">
                                <i class="pg-more"></i>
                            </a>

                        </div>
                    </div>

                    <div data-init-list-view="ioslist" class="list-view boreded no-top-border">
                        <div class="list-view-group-container">
                            <div class="list-view-group-header text-uppercase">
                                a
                            </div>
                            <ul>

                                <li class="chat-user-list clearfix">
                                    <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view"
                                       class="" href="#">
                        <span class="col-xs-height col-middle">
                        <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt="" data-src-retina="/assets/img/profiles/1x.jpg"
                                 data-src="/assets/img/profiles/1.jpg" src="/assets/img/profiles/1x.jpg"
                                 class="col-top">
                        </span>
                        </span>
                                        <p class="p-l-10 col-xs-height col-middle col-xs-12">
                                            <span class="text-master">ava flores</span>
                                            <span class="block text-master hint-text fs-12">Hello there</span>
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="list-view-group-container">
                            <div class="list-view-group-header text-uppercase">b</div>
                            <ul>

                                <li class="chat-user-list clearfix">
                                    <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view"
                                       class="" href="#">
                        <span class="col-xs-height col-middle">
                        <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt="" data-src-retina="/assets/img/profiles/2x.jpg"
                                 data-src="/assets/img/profiles/2.jpg" src="/assets/img/profiles/2x.jpg"
                                 class="col-top">
                        </span>
                        </span>
                                        <p class="p-l-10 col-xs-height col-middle col-xs-12">
                                            <span class="text-master">bella mccoy</span>
                                            <span class="block text-master hint-text fs-12">Hello there</span>
                                        </p>
                                    </a>
                                </li>


                                <li class="chat-user-list clearfix">
                                    <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view"
                                       class="" href="#">
                        <span class="col-xs-height col-middle">
                        <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt="" data-src-retina="/assets/img/profiles/3x.jpg"
                                 data-src="/assets/img/profiles/3.jpg" src="/assets/img/profiles/3x.jpg"
                                 class="col-top">
                        </span>
                        </span>
                                        <p class="p-l-10 col-xs-height col-middle col-xs-12">
                                            <span class="text-master">bob stephens</span>
                                            <span class="block text-master hint-text fs-12">Hello there</span>
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="view chat-view bg-white clearfix">

                    <div class="navbar navbar-default">
                        <div class="navbar-inner">
                            <a href="javascript:;" class="link text-master inline action p-l-10" data-navigate="view"
                               data-view-port="#chat" data-view-animation="push-parrallax">
                                <i class="pg-arrow_left"></i>
                            </a>
                            <div class="view-heading">
                                John Smith
                                <div class="fs-11 hint-text">Online</div>
                            </div>
                            <a href="#" class="link text-master inline action p-r-10 pull-right ">
                                <i class="pg-more"></i>
                            </a>
                        </div>
                    </div>


                    <div class="chat-inner" id="my-conversation">

                        <div class="message clearfix">
                            <div class="chat-bubble from-me">
                                Hello there
                            </div>
                        </div>


                        <div class="message clearfix">
                            <div class="profile-img-wrapper m-t-5 inline">
                                <img class="col-top" width="30" height="30" src="/assets/img/profiles/avatar_small.jpg"
                                     alt="" data-src="/assets/img/profiles/avatar_small.jpg"
                                     data-src-retina="/assets/img/profiles/avatar_small2x.jpg">
                            </div>
                            <div class="chat-bubble from-them">
                                Hey
                            </div>
                        </div>


                        <div class="message clearfix">
                            <div class="chat-bubble from-me">
                                Did you check out Pages framework ?
                            </div>
                        </div>


                        <div class="message clearfix">
                            <div class="chat-bubble from-me">
                                Its an awesome chat
                            </div>
                        </div>


                        <div class="message clearfix">
                            <div class="profile-img-wrapper m-t-5 inline">
                                <img class="col-top" width="30" height="30" src="/assets/img/profiles/avatar_small.jpg"
                                     alt="" data-src="/assets/img/profiles/avatar_small.jpg"
                                     data-src-retina="/assets/img/profiles/avatar_small2x.jpg">
                            </div>
                            <div class="chat-bubble from-them">
                                Yea
                            </div>
                        </div>

                    </div>


                    <div class="b-t b-grey bg-white clearfix p-l-10 p-r-10">
                        <div class="row">
                            <div class="col-xs-1 p-t-15">
                                <a href="#" class="link text-master"><i class="fa fa-plus-circle"></i></a>
                            </div>
                            <div class="col-xs-8 no-padding">
                                <input type="text" class="form-control chat-input" data-chat-input=""
                                       data-chat-conversation="#my-conversation" placeholder="Say something">
                            </div>
                            <div class="col-xs-2 link text-master m-l-10 m-t-15 p-l-10 b-l b-grey col-top">
                                <a href="#" class="link text-master"><i class="pg-camera"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

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
<script src="/assets/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
<script src="/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
@stack('vendor_js')



<script src="/pages/js/pages.js" type="text/javascript"></script>
<script src="/assets/plugins/classie/classie.js"></script>
@stack('core_js')

<script src="/assets/js/sweetalert.min.js"></script>
@include('sweet::alert')




<script src="/assets/js/scripts.js" type="text/javascript"></script>
<script src="/assets/plugins/classie/classie.js"></script>
@stack('pages_js')

@include('layouts.partials._message')
</body>
</html>