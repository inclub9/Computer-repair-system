<?php

namespace App\Http\Controllers;

use App\Infomation;
use Illuminate\Http\Request;
use Alert;
class InformationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:info');
    }

    public function showinput()
    {
        return view('insertInformation');
    }

    public function index()
    {
        $informations = Infomation::all();
        return view('information',compact('informations'));
    }


    public function create()
    {
        //
    }



    public function store(Request $request)
    {
        $news = $this->validate(request(), [
            'news' => 'required',
            'url' => 'required'
        ]);
        $infor = new Infomation();
        $infor->news = $request->news;
        $infor->url = $request->url;
        $infor->save();
        Alert::success('เพิ่มข้อมูลเสร็จสิ้น','เพิ่มข้อมูลข่าวประชาสัมพันธ์เสร็จสิ้น');
        return redirect('admin/information');
    }


    public function show($id)
    {
        $informations = Infomation::find($id);
        return view('editinformation',compact('informations'));
    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
        $req = $request;
        $infor = Infomation::find($id);
        $infor->news = $req->news;
        $infor->url = $req->url;
        $infor->save();
        return redirect('admin/information');
    }


    public function destroy($id)
    {
        $infor = Infomation::find($id);
        $infor->delete();
        Alert::success('ลบเสร็จสิ้น','ลบข่าวประชาสัมพันธ์เสร็จสิ้น');
        return redirect('admin/information');
    }
}
