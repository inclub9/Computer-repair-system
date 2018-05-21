@guest
    <div class=" pull-right">

        <div class="visible-lg visible-md m-t-10">
            <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
                <span class="semi-bold">Guest User</span>
            </div>
            <div class="dropdown pull-right open">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true">
                <span class="thumbnail-wrapper d32 circular inline m-t-5">
                <img src="/assets/img/profiles/avatar_small.jpg" alt="" data-src="/assets/img/profiles/avatar_small.jpg"
                     data-src-retina="/assets/img/profiles/avatar_small.jpg" width="32" height="32">
            </span>
                </button>
                <ul class="dropdown-menu profile-dropdown" role="menu">
                    <li><a href="/login"><i class="pg-settings_small"></i> เข้าสู่ระบบ</a>
                    </li>
                    <li><a href="/staff/login"><i class="pg-outdent"></i> สำหรับเจ้าหน้าที่</a>
                    </li>
                    <li class="bg-master-lighter">
                        <a href="/register" class="clearfix">
                            <span class="pull-left">สมัครสมาชิก</span>
                            <span class="pull-right"><i class="pg-power"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
@endguest


@auth
    <div class=" pull-right">

        <div class="visible-lg visible-md m-t-10">
            <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
                <span class="semi-bold">{{Auth::user()->name}}</span>
            </div>
            <div class="dropdown pull-right ">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true">
                 <span class="thumbnail-wrapper d32 circular inline m-t-5">
                <img src="/assets/img/profiles/avatar_small.jpg" alt="" data-src="/assets/img/profiles/avatar_small.jpg"
                     data-src-retina="/assets/img/profiles/avatar_small.jpg" width="32" height="32">
            </span>
                </button>
                <ul class="dropdown-menu profile-dropdown" role="menu">
                    <li class="">
                        <a role="menuitem" href="#"
                           onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                            <span class="pull-left">ออกจากระบบ</span>
                            <span class="pull-right"><i class="pg-power"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <form id="logout-form" action="/logout" method="POST"
          style="display: none;">
        {{ csrf_field() }}
    </form>
@endauth