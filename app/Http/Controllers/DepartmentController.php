<?php 

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller 
{


  public function index()
  {
      $departs = Department::all()->toArray();
    return view('department',compact('departs'));
  }


  public function create()
  {
      return view('insertDepartment');
  }


  public function store(Request $request)
  {
      $depart = $this->validate(request(), [
          'name' => 'required',
      ]);
      Department::create($depart);
      return back()->with('success', 'Department has been added');
  }


  public function show($id)
  {
    
  }


  public function edit($id)
  {
      $depart = Department::find($id);
      return view('editDepartment',compact('depart','id'));
  }


  public function update(Request $request,$id)
  {
      $depart = Department::find($id);
      $this->validate(request(), [
          'name' => 'required',
      ]);
      $depart->name = $request->get('name');
      $depart->save();
      return redirect('admin/department')->with('success','Department has been updated');
  }


  public function destroy($id)
  {
      $depart = Department::find($id);
      $depart->delete();
      return redirect('admin/department')->with('success','Department has been  deleted');
  }
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
  
}

?>