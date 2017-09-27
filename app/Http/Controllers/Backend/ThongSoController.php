<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ThongSo;
use Helper, File, Session, Auth;

class ThongSoController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
                if(Auth::user()->role == 1 ){
            return redirect()->route('product.index');
        }
        $items = ThongSo::all()->sortBy('display_order');
        return view('backend.thong-so.index', compact( 'items' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        if(Auth::user()->role == 1 ){
            return redirect()->route('product.index');
        }
        return view('backend.thong-so.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store(Request $request)
    {
        if(Auth::user()->role == 1 ){
            return redirect()->route('product.index');
        }
        $dataArr = $request->all();
        
        $this->validate($request,[
            'name' => 'required',            
        ],
        [
            'name.required' => 'Bạn chưa nhập tên',               
        ]);
        $dataArr['display_order'] = Helper::getNextOrder('thong_so');
        ThongSo::create($dataArr);

        Session::flash('message', 'Tạo mới thành công');

        return redirect()->route('thong-so.index');
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
        if(Auth::user()->role == 1 ){
            return redirect()->route('product.index');
        }
        $detail = ThongSo::find($id);

        return view('backend.thong-so.edit', compact( 'detail' ));
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
        if(Auth::user()->role == 1 ){
            return redirect()->route('product.index');
        }
        $dataArr = $request->all();
        
        $this->validate($request,[
            'name' => 'required',         
        ],
        [
            'name.required' => 'Bạn chưa nhập tên',
                    
        ]);
        
        $model = ThongSo::find($dataArr['id']);

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật thành công');

        return redirect()->route('thong-so.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        if(Auth::user()->role == 1 ){
            return redirect()->route('product.index');
        }
        // delete
        $model = ThongSo::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa thành công');
        return redirect()->route('thong-so.index');
    }
}
