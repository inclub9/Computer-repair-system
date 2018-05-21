<?php

namespace App\Http\Controllers\user;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use App\Job;
use App\Comment;
use Alert;
class JobController extends Controller
{
    
    public function index()
    {
        $types = Type::all()->toArray();

        return view('user.AddJobs',compact('types'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $job = $this->validate(request(), [
            'user_id' => 'required|numeric',
            'type_id' => 'numeric',
            'problem' => 'required',
            'telnum' => 'required|numeric',
            'comment' => 'required',
        ], [
            'problem.required' => 'กรุณากรอกปัญหาของงานซ่อม',
            'telnum.required' => 'กรุณากรอกเบอร์โทรที่ติดต่อได้ของผู้แจ้งงานซ่อม',
            'comment.required' => 'กรุณากรอกข้อมูลเพิ่มเติ่มในอาการเสียที่พบเจอ'
        ]);

        $Job = new Job();
        $Job->user_id = $request->get('user_id');
        $Job->type_id = $request->get('type_id');
        $Job->problem = $request->get('problem');
        $Job->telnum = $request->get('telnum');
        $Job->save();
        $comment = new Comment();
        $comment->job_id = $Job->id;
        $comment->comment = $request->get('comment');
        $comment->save();

        $type = Type::find($Job->type_id);
        //dd($type->name);
        $user = User::find($Job->user_id);
        $lineapi = "o1NkBuySizOdwnOt8mSHpL1PR3EKVkOQighm1XOzI8x";
        date_default_timezone_set("Asia/Bangkok");
        $chOne = curl_init();
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt( $chOne, CURLOPT_POST, 1);
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=อาการเสีย:$Job->problem\nประเภทอาการ:$type->name\nผู้แจ้ง:$user->name\nเบอโทรติดต่อ:$Job->telnum");
//curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms&imageThumbnail=http://plusquotes.com/images/quotes-img/surprise-happy-birthday-gifts-5.jpg&imageFullsize=http://plusquotes.com/images/quotes-img/surprise-happy-birthday-gifts-5.jpg&stickerPackageId=1&stickerId=100");
        curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $chOne );
        if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); }
        else { $result_ = json_decode($result, true);
            echo "status : ".$result_['status']; echo "message : ". $result_['message']; }
        curl_close( $chOne );

        
        return redirect('searchjob');
    }


    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
    }
    public function __construct()
    {
        $this->middleware('auth:web');
    }
}
