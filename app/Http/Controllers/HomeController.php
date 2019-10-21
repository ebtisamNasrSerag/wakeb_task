<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Redirect;
use DataTables;
use App\Info;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    /**
    *show all data fron database
    **/
    public function infosList()
    {
        $infos = Info::all();

      return Datatables::of($infos)->addColumn('name', function ($info) {
            $url= asset('imgs/'.$info->image);
            return '<img src="'.$url.'" border="0" width="40" height="60" class="img-rounded" align="center" />'." ".$info->name;
          })->addColumn('action', function ($info) {
              return '<a href="'.url('/editRecord',$info->id).'" class="btn btn-xs btn-info "><i class="glyphicon glyphicon-edit"></i> Edit</a>
              <a href="'.url('/deleteRecord',$info->id).'" class="btn btn-xs btn-danger del"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
          })
          // ->editColumn('id', ' {{$id}}')
          // ->removeColumn('password')
          ->rawColumns(['name', 'action'])->make(true);

    }

    /**
    *display data depends on user filter date range datePicker
    *@param Request $request
    *@return datatable data
    **/
    public function userList(Request $request)
    {
      $request = $request->all();
      $arr = [
           'start' => Carbon::parse(substr($request['start_date'], 4, 11))->startOfDay(),
           'end' =>  Carbon::parse(substr($request['end_date'], 64, -44))->endOfDay()
        ];

        // Both `start` and `end` are Carbon objects
      $infos = Info::whereBetween('created_at', [$arr['start'],$arr['end']]);
      return Datatables::of($infos)->addColumn('name', function ($info) {
            $url= asset('imgs/'.$info->image);
            return '<img src="'.$url.'" border="0" width="40" height="60" class="img-rounded" align="center" />'." ".$info->name;
          })->addColumn('action', function ($info) {
              return '<a href="'.url('/editRecord',$info->id).'" class="btn btn-xs btn-info "><i class="glyphicon glyphicon-edit"></i> Edit</a>
              <a href="'.url('/deleteRecord',$info->id).'" class="btn btn-xs btn-danger del"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
          })
          // ->editColumn('id', ' {{$id}}')
          // ->removeColumn('password')
          ->rawColumns(['name', 'action'])->make(true);

    }

    /**
    * display add new Record view
    *
    */
    public function addRecord()
    {
      return view('addRecord');
    }
    /**
    *create new Record
    *@param Request $request
    *@return json array
    */
    public function createRecord(Request $request)
    {
      $validation = Validator::make($request->all(),[
                              'name'          => 'required',
                              'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                              'screen_name'   => 'required',
                              'content'       => 'nullable',
                              'description'   => 'nullable',
                              'user_name'     => 'required',
                              'date'          => 'nullable',
      ]);
      if($validation->fails()){
         $json['errors'] = implode('<br>',$validation->errors()->all());
      }else{

        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/imgs');
        $image->move($destinationPath, $name);
        $request = $request->all();

        $info = new Info;
        $info->name        = $request['name'];
        $info->image       = $name;
        $info->screen_name = $request['screen_name'];
        $info->content     = $request['content'];
        $info->description = $request['description'];
        $info->user_name   = $request['user_name'];
        $info->date        = date('Y-m-d');
        $info->status        = 0;
        $info->save();
        $json['success'] = "Record added successfuly.";
      }
      return response()->json($json,200);
    }

    /**
    *show record data to edit
    */
    public function showRecord($id)
    {
      $record = Info::findOrFail($id);
      return view('editRecord',compact('record'));
    }

    /**
    *edit Record
    *@param Request $request and $id
    **/
    public function editRecord(Request $request,$id)
    {
      $editRecord = Info::findOrFail($id);
      $validation = Validator::make($request->all(),[
                              'name'          => 'required',
                              'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                              'screen_name'   => 'required',
                              'content'       => 'nullable',
                              'description'   => 'nullable',
                              'user_name'     => 'required',
                              'date'          => 'nullable',
      ]);
      if($validation->fails()){
         $json['errors'] = implode('<br>',$validation->errors()->all());
      }else{
        if($request->file('image'))
        {
          $image = $request->file('image');
          $name = time().'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/imgs');
          $image->move($destinationPath, $name);

        }else{
          $name = $editRecord->image;
        }
        $request = $request->all();
        $editRecord->name        = $request['name'];
        $editRecord->image       = $name;
        $editRecord->screen_name = $request['screen_name'];
        $editRecord->content     = $request['content'];
        $editRecord->description = $request['description'];
        $editRecord->user_name   = $request['user_name'];
        $editRecord->date        = date('Y-m-d');
        $editRecord->status      = $request['status'];
        $editRecord->save();
        $json['success'] = "Record Edited successfuly.";
    }
    return response()->json($json,200);
  }

  /**
  *delete record using soft deleteRecord
  *@param $id
  **/
  public function deleteRecord($id)
  {
    $deleteRecord = Info::findOrFail($id);
    $deleteRecord->delete();
    return Redirect::back()->with('message','Record Deleted Successful !');
  }
}
