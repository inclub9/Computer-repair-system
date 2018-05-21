
<div class="page-sidebar" data-pages="sidebar">
    <div id="appMenu" class="sidebar-overlay-slide from-top">
    </div>

    <div class="sidebar-header">
        <img src="/assets/img/logo-sru.gif" alt="logo" class="brand" data-src="/assets/img/logo-sru.gif"
             data-src-retina="/assets/img/logo-sru.gif" width="40" height="50">
        <div class="sidebar-header-controls">
            <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu">
                <i class="fa fa-angle-down fs-16"></i>
            </button>
            <button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i
                        class="fa fs-12"></i>
            </button>
        </div>
    </div>


    <style>
        span {
            font-family: 'Kanit', sans-serif;
        }
    </style>
    <div class="sidebar-menu">
        <ul class="menu-items">
            @if(Auth::user()->department_id==1)
                <li class="">
                    <a href="/admin/job">
                        <span class="title">เพิ่มงานซ่อม</span>
                    </a>
                    <span class="icon-thumbnail "><i class="material-icons">add_to_queue</i>
                    </span>
                </li>
                <li class="">
                    <a href="/admin/searchjobinfo">
                        <span class="title">งานซ่อม</span>
                    </a>
                    <span class="icon-thumbnail "><i class="material-icons">build</i>
                    </span>
                </li>
                <li class="">
                    <a href="/admin/information">
                        <span class="title">เพิ่มข่าวประชาสัมพันธ์</span>
                    </a>
                    <span class="icon-thumbnail "><i class="material-icons">chrome_reader_mode</i>
                    </span>
                </li>
            @elseif(Auth::user()->department_id==2)
                <li class="">
                    <a href="/admin/searchjob">
                        <span class="title">งานซ่อม</span>
                    </a>
                    <span class="icon-thumbnail "><i class="material-icons">build</i>
                    </span>
                </li>
                <li class="">
                    <a href="/admin/followjob">
                        <span class="title">ติดตามงานซ่อม</span>
                    </a>
                    <span class="icon-thumbnail "><i class="material-icons">location_city</i>
                    </span>
                </li>
                <li class="">
                    <a href="/admin/claim">
                        <span class="title">ส่งประกัน</span>
                    </a>
                    <span class="icon-thumbnail "><i class="material-icons">local_shipping</i>
                    </span>
                </li>
                <li class="">
                    <a href="/admin/type">
                        <span class="title">ประเภท</span>
                    </a>
                    <span class="icon-thumbnail "><i class="material-icons">playlist_add</i>
                    </span>
                </li>
            @elseif(Auth::user()->department_id==3)
                <li class="">
                    <a href="/admin/manager">
                        <span class="title">งานซ่อม</span>
                    </a>
                    <span class="icon-thumbnail "><i class="material-icons">build</i>
                    </span>
                </li>
                <li class="">
                    <a href="/admin/conclude">
                        <span class="title">สรุปผลรูปแบบกราฟต่างๆ</span>
                    </a>
                    <span class="icon-thumbnail "><i class="material-icons">pie_chart</i>
                    </span>
                </li>
            @endif

        </ul>
        <div class="clearfix"></div>
    </div>

</div>
