@if ($errors->any())
    <div class="pgn-wrapper" data-position="top">


        <div class="pgn push-on-sidebar-open pgn-bar">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><span>{{ $error  }}</span></li>
                    @endforeach
                </ul>

            </div>
        </div>


    </div>
@endif

@if(Session::has('success'))
    <div class="pgn-wrapper" data-position="top">


        <div class="pgn push-on-sidebar-open pgn-bar">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                {{Session::get('success')}}
            </div>
        </div>


    </div>
@endif

