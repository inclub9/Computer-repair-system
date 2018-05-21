<?php

namespace App\Http\Controllers;

use Alert;
use App\Claim;
use Illuminate\Http\Request;
use App\Comment;
use App\Remark;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{


    public function index()
    {
        $claims = Claim::orderBy('created_at', 'desc')->get();
        return view('ManageClaim', compact('claims'));
    }

    public function form($job_id)
    {
        return view('claim', compact('job_id'));
    }


    public function create()
    {

    }


    public function search(Request $request)
    {

        $this->validate(request(), [
            'selected' => 'required',
        ]);
        $search = $request->get('search');
        $req = '%' . $request->get('search') . '%';
        $selected = $request->get('selected');
        $status = $request->get('status');
        if (isset($search)) {
            if ($request->get('status') == 'on') {
                if ($request->get('selected') == 'id'
                    OR $request->get('selected') == 'job_id' OR $request->get('selected') == 'sn') {
                    $req = $request->get('search');
                    $claims = Claim::where($selected, $req)->orderBy('created_at', 'desc')->get();
                } elseif ($request->get('selected') == 'partner') {
                    $claims = Claim::where($selected, 'like', $req)->orderBy('created_at', 'desc')->get();
                }

            } else {

                if ($request->get('selected') == 'id'
                    OR $request->get('selected') == 'job_id' OR $request->get('selected') == 'sn') {
                    $req = $request->get('search');
                    $claims = Claim::where($selected, $req)->where('status', $status)
                        ->orderBy('created_at', 'desc')->get();
                } elseif ($request->get('selected') == 'partner') {
                    $claims = Claim::where($selected, 'like', $req)->where('status', $status)
                        ->orderBy('created_at', 'desc')->get();
                }

            }
        } else $claims = Claim::where('status', '=', $status)
            ->orderBy('created_at', 'desc')->get();
        //dd($request->get('status'));

        return view('ManageClaim', compact('claims'));
    }

    public function store(Request $request)
    {

        $comment = new Comment();
        $comment->job_id = $request->get('job_id');
        $comment->status_id = 'ส่งเคลม';
        $comment->systemuser_id = Auth::user()->id;
        $comment->save();

        $claim = $this->validate(request(), [
            'job_id' => 'required',
            'status' => 'required',
            'sn' => 'required',
            'partner' => 'required'
        ]);
        Claim::create($claim);


        Alert::success('บันทึกข้อมูลงานที่ส่งเคลมเสร็จสิ้น!', 'สำเร็จ');
        return redirect('admin/claim');
    }


    public function show($id)
    {
        $show = Claim::find($id);

        return view('DetailClaim', compact('show'));
    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {

        $ClaimEdit = new Claim();
        $this->validate(request(), [
            'job_id' => 'required',
            'status' => 'required',
            'sn' => 'required',
            'partner' => 'required',
        ]);
        $ClaimEdit->job_id = $request->get('job_id');
        $ClaimEdit->status = $request->get('status');
        $ClaimEdit->sn = $request->get('sn');
        $ClaimEdit->partner = $request->get('partner');
        $ClaimEdit->save();


        $comment = new Comment();
        $comment->job_id = $request->get('job_id');
        $comment->status_id = 'รอผลความพึงพอใจในงานซ่อม';
        $comment->comment = $request->get('comment');
        $comment->systemuser_id = Auth::user()->id;
        $comment->save();


        $claims = Claim::orderBy('created_at', 'desc')->get();
        Alert::success('แก้ไขประเภทงานซ่อมเสร็จสิ้น!', 'สำเร็จ');
        return view('ManageClaim', compact('claims'));

    }


    public function destroy($id)
    {

    }

    public function __construct()
    {
        $this->middleware('auth:technician');
    }

}

?>