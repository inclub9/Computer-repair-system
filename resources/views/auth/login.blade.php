<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>ระบบบริการแจ้งซ่อมบำรุงคอมพิวเตอร์และอุปกรณ์</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no"/>
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="pages/css/pages.css" rel="stylesheet" type="text/css"/>
    <!--[if lte IE 9]>
    <link href="pages/css/ie9.css" rel="stylesheet" type="text/css"/>
    <![endif]-->
</head>
<body class="fixed-header ">
<div class="login-wrapper ">

    <div class="bg-pic">

        <img src="/assets/img/demo/wachiralongkorn-02.jpg" data-src="/assets/img/demo/wachiralongkorn-02.jpg"
             data-src-retina="assets/img/demo/wachiralongkorn-02.jpg" alt="" class="lazy">



        <div class=" pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">

            <h2 class="semi-bold text-white">
                ระบบบริการแจ้งซ่อมบำรุงคอมพิวเตอร์และอุปกรณ์ <br> ศูนย์คอมพิวเตอร์และสารสนเทศ
                มหาวิทยาลัยราชภัฎสุราษฎร์ธานี</h2>
            <p class="small">
                ระบบบริการแจ้งซ่อมบำรุงคอมพิวเตอร์และอุปกรณ์ กรณีศึกษา ศูนย์คอมพิวเตอร์และสารสนเทศ
                มหาวิทยาลัยราชภัฎสุราษฎร์ธานี
            </p>
            <center>ข่าวประชาสัมพันธ์</center>
            @php($informations = \App\Infomation::orderBy('created_at','desc')->paginate(3))
            @foreach($informations as $information)
                <center><a href="{{$information->url}}" class="text-white">{{$information->news}}</a></center>
            @endforeach

        </div>

    </div>


    <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <ul class="nav navbar-nav navbar-right">

                @guest

                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                           aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
            <img src="assets/img/logo-sru.jpg" alt="logo" data-src="assets/img/logo-sru.jpg"
                 data-src-retina="assets/img/logo-sru.jpg" width="49" height="60">
            <p class="p-t-35">เข้าสู่ระบบสำหรับบุคลากรทั่วไปและนักศึกษา</p>

            <form class="p-t-15" method="POST" action="{{route('admin.login.submit') }}">

                <div class="form-group form-group-default">
                    <label>รหัสบุคลากรหรือรหัสนักศึกษา</label>
                    <div class="controls">
                        {{ csrf_field() }}
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="ป้อนรหัสบุคลากรหรือรหัสนักศึกษา" class="form-control">
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>


                <div class="form-group form-group-default">
                    <label>รหัสผ่าน</label>
                    <div class="controls">
                        <input id="password" type="password" class="form-control" name="password"
                               placeholder="ป้อนรหัสผ่าน" required>
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6 no-padding">
                        <div class="checkbox ">
                            <input type="checkbox" value="1" id="checkbox1">
                            <label for="checkbox1">จดจำรหัสบุคลากรและรหัสผ่าน</label>
                        </div>
                    </div>

                </div>

                <button class="btn btn-primary btn-cons m-t-10" type="submit">เข้าสู่ระบบ</button>
            </form>

            <div class="pull-bottom sm-pull-bottom">
                <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                    <div class="col-sm-3 col-md-2 no-padding">
                        <img alt="" class="m-t-5" data-src="/assets/img/demo/logo-sru.jpg"
                             data-src-retina="assets/img/demo/logo-sru.jpg" height="60"
                             src="/assets/img/demo/logo-sru.jpg" width="49">
                    </div>
                    <div class="col-sm-9 no-padding m-t-10">
                        <p>
                            <small>
                                สามารถเข้าเยี่ยมชมเว็บไซต์มหาลัยและข่าวประชาสัมพันธ์ของมหาลัยเพิ่มเติม <br>
                                <a href="http://www.sru.ac.th" class="text-info  ">เว็บไซต์มหาลัย</a> และ <a
                                        href="http://sru.ac.th/news-and-announcement/announcements.html"
                                        class="text-info">ข่าวประชาสัมพันธ์ของมหาลัยเพิ่มเติม</a>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="overlay hide" data-pages="search">

    <div class="overlay-content has-results m-t-20">

        <div class="container-fluid">

            <img class="overlay-brand" src="assets/img/logo.png" alt="logo" data-src="assets/img/logo.png"
                 data-src-retina="assets/img/logo_2x.png" width="78" height="22">


            <a href="#" class="close-icon-light overlay-close text-black fs-16">
                <i class="pg-close"></i>
            </a>

        </div>

        <div class="container-fluid">

            <input id="overlay-search" class="no-border overlay-search bg-transparent" placeholder="Search..."
                   autocomplete="off" spellcheck="false">
            <br>
            <div class="inline-block">
                <div class="checkbox right">
                    <input id="checkboxn" type="checkbox" value="1" checked="checked">
                    <label for="checkboxn"><i class="fa fa-search"></i> Search within page</label>
                </div>
            </div>
            <div class="inline-block m-l-10">
                <p class="fs-13">Press enter to search</p>
            </div>

        </div>

        <div class="container-fluid">
          <span>
                <strong>suggestions :</strong>
            </span>
            <span id="overlay-suggestions"></span>
            <br>
            <div class="search-results m-t-40">
                <p class="bold">Pages Search Results</p>
                <div class="row">
                    <div class="col-md-6">

                        <div class="">

                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div>
                                    <img width="50" height="50" src="assets/img/profiles/avatar.jpg"
                                         data-src="assets/img/profiles/avatar.jpg"
                                         data-src-retina="assets/img/profiles/avatar2x.jpg" alt="">
                                </div>
                            </div>

                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> on pages</h5>
                                <p class="hint-text">via john smith</p>
                            </div>
                        </div>


                        <div class="">

                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div>T</div>
                            </div>

                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> related topics
                                </h5>
                                <p class="hint-text">via pages</p>
                            </div>
                        </div>


                        <div class="">

                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div><i class="fa fa-headphones large-text "></i>
                                </div>
                            </div>

                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> music</h5>
                                <p class="hint-text">via pagesmix</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="">

                            <div class="thumbnail-wrapper d48 circular bg-info text-white inline m-t-10">
                                <div><i class="fa fa-facebook large-text "></i>
                                </div>
                            </div>

                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> on facebook</h5>
                                <p class="hint-text">via facebook</p>
                            </div>
                        </div>


                        <div class="">

                            <div class="thumbnail-wrapper d48 circular bg-complete text-white inline m-t-10">
                                <div><i class="fa fa-twitter large-text "></i>
                                </div>
                            </div>

                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5">Tweats on<span class="semi-bold result-name"> ice cream</span></h5>
                                <p class="hint-text">via twitter</p>
                            </div>
                        </div>


                        <div class="">

                            <div class="thumbnail-wrapper d48 circular text-white bg-danger inline m-t-10">
                                <div><i class="fa fa-google-plus large-text "></i>
                                </div>
                            </div>

                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5">Circles on<span class="semi-bold result-name"> ice cream</span></h5>
                                <p class="hint-text">via google plus</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>



</body>
</html>