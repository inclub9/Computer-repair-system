<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Comment;
use App\Type;
use App\User;
use Illuminate\Support\Collection;

class ManagerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:manager');
    }
    public function index()
    {
        $jobs = Job::orderBy('created_at','desc')->get();
        $status = 'ทั้งหมด';
        return view('manager_searchjob', compact('jobs','status'));
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
        $paginate = true;
        if (isset($search)) {
            if ($selected == 'id') {
                $req = $request->get('search');
                $jobs = Job::where($selected, '=', $req)
                    ->orderBy('created_at','desc')->get();
            } elseif ($selected == 'user_id') {
                $users = User::select('id')->where('name', 'like', $req)->get()->toArray();
                //dd($users);
                $jobs = new Collection();
                foreach ($users as $user) {
                    $jobs = $jobs->merge(Job::where('user_id', $user)
                        ->orderBy('created_at','desc')->get());
                }
                $paginate = false;
            } elseif ($selected == 'type_id') {
                $types = Type::select('id')->where('name', 'like', $req)->get()->toArray();
                $jobs = new Collection();
                foreach ($types as $type) {
                    $jobs = $jobs->merge(Job::where('type_id', $type)
                        ->orderBy('created_at','desc')->get());
                    $paginate = false;
                }
            } else $jobs = Job::where($selected, 'like', $req)
                ->orderBy('created_at','desc')->get();
        }else{
            $jobs = Job::orderBy('created_at','desc')->get();
        }

        return view('manager_searchjob', compact('jobs', 'status'));
    }


    public function show($id)
    {
        $jobs = Job::all()->where('id', $id);
        $statuss = Comment::where('job_id', $id)->latest()->first();
        $types = Type::all();
        return view('manager_detailjob', compact('types', 'jobs',  'id', 'statuss'));
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
        //
    }

}
