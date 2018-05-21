<?php

namespace App\Http\Controllers;

use App\Techonjob;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Job;
use App\Type;
use Illuminate\Support\Facades\Auth;

class SearchControllerinfo extends Controller
{

    public function index()
    {
        $jobs = Job::orderBy('created_at','desc')->get();
        $status = 'ทั้งหมด';
        return view('Searchjobinfo', compact('jobs', 'status'));
    }

    public function FollowJob()
    {
        $tojs = Techonjob::select('job_id')->where('systemuser_id', '=', Auth::user()->id)->get();
        $jobs = new Collection();
        foreach ($tojs as $toj) {
            $jobs = $jobs->merge(Job::all()->where('id', $toj->job_id));
        }
        //dd($jobs);
        $status = 'ทั้งหมด';
        return view('followjob', compact('jobs', 'status'));
    }

    public function SearchFollowJob(Request $request)
    {
        $this->validate(request(), [
            'selected' => 'required',
        ]);
        $search = $request->get('search');
        $req = '%' . $request->get('search') . '%';
        $selected = $request->get('selected');
        $status = $request->get('status');
        $tojs = Techonjob::select('job_id')->where('systemuser_id', '=', Auth::user()->id)->get();
        $jobs = new Collection();
        if (isset($search)){
            if ($selected == 'id') {
                $req = $request->get('search');
                foreach ($tojs as $toj) {
                    $jobs = $jobs->merge(Job::where($selected, '=', $req)->where('id', $toj->job_id)->get());
                }
            } elseif ($selected == 'user_id') {
                $users = User::select('id')->where('name', 'like', $req)->get()->toArray();
                //dd($users);
                $jobs = new Collection();
                foreach ($tojs as $toj) {
                    $jobs = $jobs->merge(Job::where('user_id', $users)->where('id', $toj->job_id)->get());
                }
            } elseif ($selected == 'type_id') {
                $types = Type::select('id')->where('name', 'like', $req)->get()->toArray();
                $jobs = new Collection();
                foreach ($tojs as $toj) {
                    foreach ($types as $type) {
                        $jobs = $jobs->merge(Job::where('type_id', $type)->where('id', $toj->job_id)->get());
                    }
                }
            } else {
                foreach ($tojs as $toj) {
                    $jobs = Job::where($selected, 'like', $req)->where('id', $toj->job_id)->get();
                }
            }
        }else{
            foreach ($tojs as $toj) {
                $jobs = $jobs->merge(Job::all()->where('id', $toj->job_id));
            }
        }


        return view('followjob', compact('jobs', 'status'));
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
            } elseif ($selected == 'type_id') {
                $types = Type::select('id')->where('name', 'like', $req)->get()->toArray();
                $jobs = new Collection();
                foreach ($types as $type) {
                    $jobs = $jobs->merge(Job::where('type_id', $type)
                        ->orderBy('created_at','desc')->get());
                }
            } else $jobs = Job::where($selected, 'like', $req)
                ->orderBy('created_at','desc')->get();
        }else{
            $jobs = Job::orderBy('created_at','desc')->get();
        }

        return view('searchjobinfo', compact('jobs', 'status'));
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
        $this->middleware('auth:admin');
    }
}
