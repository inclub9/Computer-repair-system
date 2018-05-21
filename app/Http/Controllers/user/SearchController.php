<?php

namespace App\Http\Controllers\user;

use App\Satisfaction;
use App\User;
use App\Comment;
use App\Techonjob;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job;
use App\Type;
use Illuminate\Support\Facades\Auth;
use Alert;
class SearchController extends Controller
{
    
    public function index()
    {
        $jobs = Job::orderBy('created_at','desc')->get();
        $status = 'ทั้งหมด';
        return view('user.Searchjob', compact('jobs', 'status'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $this->validate(request(), [
            'selected' => 'required',
        ]);
        $search = $request->get('search');
        $req = '%' . $request->get('search') . '%';
        $selected = $request->get('selected');
        $status = $request->get('status');

        if (isset($search)) {
            if ($selected == 'id') {
                $req = $request->get('search');
                $jobs = Job::where($selected, '=', $req)->orderBy('created_at','desc')->get();
            } elseif ($selected == 'user_id') {
                $users = User::select('id')->where('name', 'like', $req)->get()->toArray();
                //dd($users);
                $jobs = new Collection();
                foreach ($users as $user) {
                    $jobs = $jobs->merge(Job::where('user_id', $user)->orderBy('created_at','desc')->get());
                }
            } elseif ($selected == 'type_id') {
                $types = Type::select('id')->where('name', 'like', $req)->get()->toArray();
                $jobs = new Collection();
                foreach ($types as $type) {
                    $jobs = $jobs->merge(Job::where('type_id', $type)->orderBy('created_at','desc')->get());
                }
            } else $jobs = Job::where($selected, 'like', $req)->orderBy('created_at','desc')->get();
        } else {
            $jobs = Job::orderBy('created_at','desc')->get();
        }

        return view('user.Searchjob', compact('jobs', 'status'));
    }

    
    public function show($id)
    {
        return view('user.satisfaction', compact('id'));
    }

    public function satisfaction_store(Request $request)
    {
        $chcom = Comment::all()->where('job_id',$request->job_id)->last();
        $ch = Satisfaction::where('job_id','=',$request->job_id)->get()->toArray();

        if($ch == [] && $chcom->status_id == 'รอผลความพึงพอใจในงานซ่อม'){
            $satisfaction = new Satisfaction();
            $satisfaction->job_id = $request->get('job_id');
            $satisfaction->score1 = $request->get('star1');
            $satisfaction->score2=$request->get('star2');
            $satisfaction->score3=$request->get('star3');
            $satisfaction->score4=$request->get('star4');
            $satisfaction->score5=$request->get('star5');
            $satisfaction->comment=$request->get('comment');
            $satisfaction->save();

            $comment = new Comment();
            $comment->job_id = $request->get('job_id');
            $comment->status_id = "ประเมินผลความพึงพอใจในงานซ่อมแล้ว";
            $comment->save();
            Alert::success('บันทึกการประเมินความพึงพอใจเสร็จสิ้น!', 'สำเร็จ');
        }else{Alert::success('ท่านประเมินความพึงพอใจซ้ำ!', 'ไม่สำเร็จ');}

        return redirect()->action('user\FollowJob@index');
    }
    
    public function edit($id)
    {
        //
    }

    public function detailjobs($id) //ฟังก์ชันดูรายละเอียดของ Job
    {
        $jobs = Job::all()->where('id', $id);
        $comments = Techonjob::all()->where('job_id', $id)->where('systemuser_id', Auth::user()->id);
        $statuss = Comment::where('job_id', $id)->latest()->first();
        $check_job = Comment::where('job_id', $id)->count();
        $types = Type::all();
        //dd($statuss);
        return view('user.Detailjob', compact('types', 'jobs', 'id', 'statuss'));
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
