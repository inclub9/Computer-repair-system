<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Type;

class FollowJob extends Controller
{
    
    public function index()
    {
        $jobs = Job::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
        $status = 'ทั้งหมด';
        return view('user.FollowJob', compact('jobs', 'status'));
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
                $jobs = Job::all()->where($selected, '=', $req)
                    ->where('user_id', '=', Auth::user()->id);
            } elseif ($selected == 'type_id') {
                $types = Type::select('id')->where('name', 'like', $req)->get()->toArray();
                $jobs = new Collection();
                foreach ($types as $type) {
                    $jobs = $jobs->merge(Job::where($selected, $type)
                        ->where('user_id', '=', Auth::user()->id)->orderBy('created_at','desc')->get());
                }
            } else {

                $jobs = Job::where($selected, 'like', $req)
                    ->where('user_id', '=', Auth::user()->id)->orderBy('created_at','desc')->get();
            }
        } else {
                $jobs = Job::all()->where('user_id', '=', Auth::user()->id);
        }


        return view('user.FollowJob', compact('jobs', 'status'));
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

    
    public function __construct()
    {
        $this->middleware('auth:web');
    }
}
