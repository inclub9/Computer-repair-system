<!DOCTYPE html >
<html lang="{{ app()->getLocale() }}" >
<head>
    @include('Userlayouts.partials._head')
</head>
<body class="fixed-header horizontal-menu" style="font-family: 'Kanit', sans-serif;">
@include('Userlayouts.master._sidebar')

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
            @include('Userlayouts.master._userinfo')
        </div>
        <div class=" pull-left">
            <div class=" pull-left sm-table hidden-xs hidden-sm">
                <div class="header-inner">

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

                                            <div class="notification-item unread clearfix">






                                            </div>



                                            @php($notifications = App\Job::all()->where('user_id','=',Auth::user()->id))
                                            @php($count = 0)
                                            @if(!empty($notifications))
                                                @foreach($notifications as $notification)
                                                    @foreach($notification->Comment as $comment)
                                                        @if($comment->status_id=='รอผลความพึงพอใจในงานซ่อม')
                                                            @php($count++)
                                                        @endif
                                                        @if($comment->status_id=='ประเมินผลความพึงพอใจในงานซ่อมแล้ว')
                                                            @php($count--)
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                            <form action="{{action('user\FollowJob@store')}}" method="post" id="hiddenForm">
                                                {{csrf_field()}}
                                                <div class="notification-item  clearfix">
                                                    <div class="heading">
                                                        <a href="#" class="text-danger pull-left">
                                                            <i class="fa fa-exclamation-triangle m-r-10"></i>
                                                            <span onclick="document.getElementById('hiddenForm').submit();"
                                                                  class="bold">คุณมีงานที่ยังไม่ได้ประเมิน@if($count>0){{$count}}@endif</span>

                                                        </a>

                                                    </div>



                                                </div>
                                                <input type="hidden" name="status" value="รอผลความพึงพอใจในงานซ่อม">
                                                <input type="hidden" name="selected" value="id">
                                            </form>








                                        </div>


                                        <div class="notification-footer text-center">
                                            <class> หากมีงานที่รอการประเมิน ผู้แจ้งงานซ่อมโปรดประเมิน<br>คะแนนความพึงพอใจ ของการได้รับบริการซ่อมและข้อเสนอแนะ </class>
                                            </a>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </li>

                    </ul>

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