@extends('Userlayouts.master')
@section('title','ระบบแจ้งซ่อมคอมพิวเตอร์')
@section('content')

    <style>
        * {
            margin: 0;
            padding: 0;

        }
        .cont {
            width: 93%;
            max-width: 350px;
            text-align: center;
            margin: 4% auto;
            padding: 30px 0;
            background: #d4e4fe;
            color: #000000;
            border-radius: 5px;
            border: thin solid #fff0ff;
            overflow: hidden;
        }

        hr {
            margin: 20px;
            border: none;
            border-bottom: thin solid rgba(255,255,255,.1);
        }

        div.title { font-size: 30px; }

        h1 span {
            font-weight: 300;
            color: #000000;
        }

        div.stars {
            width: 270px;
            display: inline-block;
            font-size: 20px;
        }

        input.star { display: none; }

        label.star {
            float: right;
            padding: 10px;
            font-size: 36px;
            color: #444;
            transition: all .2s;
        }

        input.star:checked ~ label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked ~ label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked ~ label.star:before { color: #F62; }

        label.star:hover { transform: rotate(-15deg) scale(1.3); }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
        }
    </style>

    <div class="page-content-wrapper ">





        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading separator">
                            <div class="panel-title">
                                <br>
                                <br><h5>ประเมินความพึงพอใจของการซ่อม</h5>
                            </div>
                        </div>
                        <style>

                        </style>
                        <div class="panel-body">
                            <div class="content">
                                <form method="get" action="{{action('user\SearchController@satisfaction_store')}}">
                                    <center><h5>กรุณาประเมินความพึงพอใจที่ได้รับบริการหลังจากการแจ้งซ่อมปัญหา</h5></center>
                                    <div class="cont" style="margin-top:10px;">
                                        <div class="stars"> ด้านความรวดเร็วในการแก้ปัญหาของเจ้าหน้าที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input class="star star-5" required value="5" id="star-5" type="radio" name="star1"/>
                                            <label class="star star-5"  for="star-5"></label>
                                            <input class="star star-4"  value="4" id="star-4" type="radio" name="star1"/>
                                            <label class="star star-4"   for="star-4"></label>
                                            <input class="star star-3"  value="3" id="star-3" type="radio" name="star1"/>
                                            <label class="star star-3"   for="star-3"></label>
                                            <input class="star star-2" value="2"  id="star-2" type="radio" name="star1"/>
                                            <label class="star star-2"   for="star-2"></label>
                                            <input class="star star-1" value="1"  id="star-1" type="radio" name="star1"/>
                                            <label class="star star-1"   for="star-1"></label>
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <div class="stars">การแก้ปัญหาของเจ้าหน้าที่สามารถแก้ปัญหาได้ตรงจุด
                                            <input class="star star-5" required value="5"  id="star-5-2" type="radio" name="star2"/>
                                            <label class="star star-5" for="star-5-2"></label>
                                            <input class="star star-4" value="4"  id="star-4-2" type="radio" name="star2"/>
                                            <label class="star star-4" for="star-4-2"></label>
                                            <input class="star star-3" value="3"  id="star-3-2" type="radio" name="star2"/>
                                            <label class="star star-3" for="star-3-2"></label>
                                            <input class="star star-2" value="2"  id="star-2-2" type="radio" name="star2"/>
                                            <label class="star star-2" for="star-2-2"></label>
                                            <input class="star star-1" value="1"  id="star-1-2" type="radio" name="star2"/>
                                            <label class="star star-1" for="star-1-2"></label>
                                        </div>
                                    </div>

                                    <div class="cont">
                                        <div class="stars">เจ้าหน้าที่ที่ให้บริการซ่อมมีมนุษยสัมพันธ์ที่ดี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input class="star star-5" required value="5"  id="star-5-3" type="radio" name="star3"/>
                                            <label class="star star-5" for="star-5-3"></label>
                                            <input class="star star-4" value="4"  id="star-4-3" type="radio" name="star3"/>
                                            <label class="star star-4" for="star-4-3"></label>
                                            <input class="star star-3" value="3"  id="star-3-3" type="radio" name="star3"/>
                                            <label class="star star-3" for="star-3-3"></label>
                                            <input class="star star-2" value="2"  id="star-2-3" type="radio" name="star3"/>
                                            <label class="star star-2" for="star-2-3"></label>
                                            <input class="star star-1" value="1"  id="star-1-3" type="radio" name="star3"/>
                                            <label class="star star-1" for="star-1-3"></label>
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <div class="stars">เจ้าหน้าที่มีความรับผิดชอบต่องานซ่อมที่รับผิดชอบ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input class="star star-5" required value="5"  id="star-5-4" type="radio" name="star4"/>
                                            <label class="star star-5" for="star-5-4"></label>
                                            <input class="star star-4" value="4"  id="star-4-4" type="radio" name="star4"/>
                                            <label class="star star-4" for="star-4-4"></label>
                                            <input class="star star-3" value="3"  id="star-3-4" type="radio" name="star4"/>
                                            <label class="star star-3" for="star-3-4"></label>
                                            <input class="star star-2" value="2"  id="star-2-4" type="radio" name="star4"/>
                                            <label class="star star-2" for="star-2-4"></label>
                                            <input class="star star-1" value="1"  id="star-1-4" type="radio" name="star4"/>
                                            <label class="star star-1" for="star-1-4"></label>
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <div class="stars"> ความพึงพอใจหลังจากได้รับบริการซ่อมจากระบบ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input class="star star-5" required value="5"  id="star-5-5" type="radio" name="star5"/>
                                            <label class="star star-5" for="star-5-5"></label>
                                            <input class="star star-4" value="4"  id="star-4-5" type="radio" name="star5"/>
                                            <label class="star star-4" for="star-4-5"></label>
                                            <input class="star star-3" value="3"  id="star-3-5" type="radio" name="star5"/>
                                            <label class="star star-3" for="star-3-5"></label>
                                            <input class="star star-2" value="2"  id="star-2-5" type="radio" name="star5"/>
                                            <label class="star star-2" for="star-2-5"></label>
                                            <input class="star star-1" value="1"  id="star-1-5" type="radio" name="star5"/>
                                            <label class="star star-1" for="star-1-5"></label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="job_id" value="{{$id}}">
                                    <div class="form-group form-group-default required ">
                                        <label>ความคิดเห็นของผู้ใช้</label>
                                        <textarea name="comment"class="form-control"></textarea>
                                    </div>


                                    <script>
                                        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                                            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                                            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                                        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
                                        ga('create', 'UA-46156385-1', 'cssscript.com');
                                        ga('send', 'pageview');
                                    </script>
                                    <button class="btn-primary btn" value="บันทึกผลการประเมิน" type="submit">ประเมิน</button>
                                </form>
                            </div>



                        </div>



                    </div>
                </div>
            </div>
            @parent
        </div>
    </div>


                    @endsection

                    @push('pages_css')
                        <link class="main-stylesheet" href="/pages/css/pages.css" rel="stylesheet" type="text/css"/>
                    @endpush

                    @push('pages_js')
                        <script src="/assets/js/scripts.js" type="text/javascript"></script>
                        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                // Check Radio-box
                                $(".rating input:radio").attr("checked", false);

                                $('.rating input').click(function () {
                                    $(".rating span").removeClass('checked');
                                    $(this).parent().addClass('checked');
                                });

                                $('input:radio').change(
                                    function(){
                                        var userRating = this.value;

                                    });
                            });
                        </script>
    @endpush