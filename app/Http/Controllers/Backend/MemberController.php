<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Member;

use Helper, File, Session, Auth, Image;

class MemberController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $items = Member::whereRaw('1')->orderBy('display_order')->get();
        
        return view('backend.member.index', compact( 'items' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {

        return view('backend.member.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'name' => 'required',
            'chuc_vu' => 'required'
        ],
        [            
            'name.required' => 'Bạn chưa nhập tên',            
            'chuc_vu.required' => 'Bạn chưa nhập chức danh'            
        ]); 
        
        if($dataArr['image_url'] && $dataArr['image_name']){
            
            $tmp = explode('/', $dataArr['image_url']);

            if(!is_dir('public/uploads/'.date('Y/m/d'))){
                mkdir('public/uploads/'.date('Y/m/d'), 0777, true);
            }         
            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('houseland.upload_path').$dataArr['image_url'], config('houseland.upload_path').$destionation);           

            $dataArr['image_url'] = $destionation;
        }        
        $dataArr['display_order'] = Helper::getNextOrder('member');
        $rs = Member::create($dataArr);

        $object_id = $rs->id;

        Session::flash('message', 'Tạo mới thành công');

        return redirect()->route('member.index');
    }
   
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
    //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {

        $detail = Member::find($id);        

        return view('backend.member.edit', compact( 'detail' ));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  Request  $request
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'name' => 'required',
            'chuc_vu' => 'required'
        ],
        [            
            'name.required' => 'Bạn chưa nhập tên',            
            'chuc_vu.required' => 'Bạn chưa nhập chức danh'            
        ]);        
        
        if($dataArr['image_url'] && $dataArr['image_name']){
            
            $tmp = explode('/', $dataArr['image_url']);

            if(!is_dir('public/uploads/'.date('Y/m/d'))){
                mkdir('public/uploads/'.date('Y/m/d'), 0777, true);
            }           

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('houseland.upload_path').$dataArr['image_url'], config('houseland.upload_path').$destionation);            
           
            $dataArr['image_url'] = $destionation;
        }
        
        $model = Member::find($dataArr['id']);

        $model->update($dataArr);        
     
        Session::flash('message', 'Cập nhật thành công');        

        return redirect()->route('member.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        // delete
        $model = Member::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa thành công');
        return redirect()->route('member.index');
    }
}
