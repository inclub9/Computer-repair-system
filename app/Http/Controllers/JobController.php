<?php

namespace App\Http\Controllers;

use Alert;
use App\Activity;
use App\Comment;
use App\Job;
use App\Techonjob;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;


class JobController extends Controller
{
    public function index()
    {
        $users = User::all()->toArray();
            return view('SearchMember', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'search_user' => 'required',
            'selected' => 'required',
        ]);
        $req = '%' . $request->get('search_user') . '%';
        $selected = $request->get('selected');

        $users = User::where($selected, 'like', $req)->get();
        return view('SearchMember', compact('users'));

    }

    public function FindUser($id)
    {
        $types = Type::all()->toArray();
        $users = User::all()->where('id', '=', $id);
        return view('Addjobs', compact('types', 'users', 'id'));
    }

    public function detailjob($id) //ฟังก์ชันดูรายละเอียดของ Job
    {

        $jobs = Job::all()->where('id', $id);
        $comments = Techonjob::all()->where('job_id', $id)->where('systemuser_id', Auth::user()->id);
        $SystemUserBoolean = false;
        if (count($comments) > 0) {
            $SystemUserBoolean = true;
        }
        $statuss = Comment::where('job_id', $id)->latest()->first();
        $check_job = Comment::where('job_id', $id)->count();
        $SystemUserCount = true;
        if ($check_job > 1) {
            $SystemUserCount = false;
        }
        $types = Type::all();
        //dd($statuss);
        return view('detailjob', compact('types', 'jobs', 'SystemUserBoolean', 'id', 'statuss', 'SystemUserCount'));
    }

    public function detailjob2($id) //ฟังก์ชันดูรายละเอียดของ Job ประชาสัมพันธ์
    {

        $jobs = Job::all()->where('id', $id);
        $comments = Techonjob::all()->where('job_id', $id)->where('systemuser_id', Auth::user()->id);

        $statuss = Comment::where('job_id', $id)->latest()->first();
        $check_job = Comment::where('job_id', $id)->count();

        $types = Type::all();
        //dd($statuss);
        return view('detailjobinfo', compact('types', 'jobs', 'id', 'statuss'));
    }


    public function changeType(Request $request, $id)
    {
        $ChangeTypes = Job::find($id);
        $this->validate(request(), [
            'typeChange' => 'required',
        ]);
        $ChangeTypes->type_id = $request->get('typeChange');
        $ChangeTypes->save();
        Alert::success('แก้ไขประเภทงานซ่อมเสร็จสิ้น!', 'สำเร็จ');
        return back();

    }

    public function acceptionJob($job_id)
    {
        $comment = new Comment();
        $comment->job_id = $job_id;
        $comment->status_id = 'ช่างรับงานซ่อม';
        $comment->systemuser_id = Auth::user()->id;
        $comment->save();

        $toj = new Techonjob();
        $toj->systemuser_id = Auth::user()->id;
        $toj->job_id = $job_id;
        $toj->save();
        Alert::success('รับงานซ่อมในระบบเรียบร้อยแล้ว!', 'รับงานซ่อมสำเร็จ');
        return back();
    }

    public function acceptionJobDub($job_id)
    {
        $toj = new Techonjob();
        $toj->systemuser_id = Auth::user()->id;
        $toj->job_id = $job_id;
        $toj->save();
        Alert::success('รับงานซ่อมในระบบเรียบร้อยแล้ว!', 'รับงานซ่อมสำเร็จ');
        return back();
    }

    public function status($job_id, $status, Request $request)
    {
        $comment = new Comment();
        if ($status == 'ตรวจสอบข้อมูลงานซ่อม') {
            $comment->job_id = $job_id;
            $comment->status_id = 'ตรวจสอบข้อมูลงานซ่อม';
            $comment->systemuser_id = Auth::user()->id;
            $comment->save();
        } elseif ($status == 'ดำเนินการซ่อม') {
            $comment->job_id = $job_id;
            $comment->status_id = 'ดำเนินการซ่อม';
            $comment->comment = $request->get('comment');
            $comment->systemuser_id = Auth::user()->id;
            $comment->save();
        } elseif ($status == 'ส่งเคลม') {

            return redirect()->action('ClaimController@form', $job_id);
        } elseif ($status == 'ซ่อมเสร็จสิ้น') {
            $comment->job_id = $job_id;
            $comment->status_id = 'ซ่อมเสร็จสิ้น';
            $comment->systemuser_id = Auth::user()->id;
            $comment->save();

            $comment = new Comment();
            $comment->job_id = $job_id;
            $comment->status_id = 'รอผลความพึงพอใจในงานซ่อม';
            $comment->systemuser_id = Auth::user()->id;
            $comment->save();
        } elseif ($status == 'รอผลความพึงพอใจในงานซ่อม') {

        } elseif ($status == 'ประเมินผลความพึงพอใจในงานซ่อมแล้ว') {

        }

        activity()
            ->causedBy(\auth()->user()) //causer_type
            ->performedOn($comment) //subject_type
            ->withProperties([ //properties
                'whoMakes_name' => \auth()->user()->name,
                'job_id' => $job_id,
                ])
            ->log($comment->status_id); //description

        Alert::success('เปลี่ยนสถานะงานซ่อมในระบบเรียบร้อยแล้ว!', 'การเปลี่ยนสถานะงานสำเร็จ');
        return back();
    }

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('auth:technician')->only('detailjob');
        $this->middleware('auth:technician')->only('acceptionJob');
        $this->middleware('auth:technician')->only('acceptionJobDub');
        $this->middleware('auth:technician')->only('status');
        $this->middleware('auth:technician')->only('status');
        $this->middleware('auth:admin')->only('detailjob2');



    }

}

?>