<?php

namespace App\Http\Controllers;

use App\Job;
use App\Type;
use Illuminate\Http\Request;
use Alert;

class TypeController extends Controller
{


    public function index()
    {
        $types = Type::all()->toArray();
        return view('type', compact('types'));
    }


    public function create()
    {
        return view('insertType');
    }

    public function search(Request $request)
    {
        $this->validate(request(), [
            'search' => 'required',
        ]);
        
        $types = Type::where('name', 'LIKE', '%' . $request->search . '%')->get();
        return view('type', compact('types'));
    }


    public function store(Request $request)
    {
        $type = $this->validate(request(), [
            'name' => 'required',
        ]);
        Type::create($type);
        Alert::success('เพิ่มประเภทของงานซ่อมในระบบเสร็จสิ้น!', 'เพิ่มประเภทของงานซ่อมสำเร็จ');
        return redirect('admin/type');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $type = Type::find($id);
        return view('editType', compact('type', 'id'));
    }


    public function update(Request $request, $id)
    {
        $type = Type::find($id);
        $this->validate(request(), [
            'name' => 'required',

        ]);
        $type->name = $request->get('name');

        $type->save();
        Alert::success('แก้ไขประเภทของงานซ่อมในระบบเสร็จสิ้น!', 'แก้ไขประเภทของงานซ่อมสำเร็จ');
        return redirect('admin/type');
    }


    public function destroy($id)
    {
        $job = Job::where('type_id','=',$id)->get()->toArray();

        if($job == []){
            $type = Type::find($id);
            $type->delete();

            Alert::success('ลบประเภทของงานซ่อมในระบบเสร็จสิ้น!', 'ลบประเภทของงานซ่อมสำเร็จ');
            return redirect('admin/type');
        }else{
            Alert::success('ลบไม่ได้!', 'ลบไม่ได้');
            return redirect('admin/type');
        }

    }

    public function __construct()
    {
        $this->middleware('auth:technician');
    }


}

?>