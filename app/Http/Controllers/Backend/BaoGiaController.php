<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\BaoGia;
use App\Models\District;
use App\Models\MetaData;
use Helper, File, Session, Auth;

class BaoGiaController extends Controller
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
        $type = isset($request->type) ? $request->type : 1;

        $query = BaoGia::where('type', $type);        
        
        $items = $query->orderBy('id', 'desc')->paginate(50);
        
        return view('backend.bao-gia.index', compact( 'items', 'type'));
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
        $detail = BaoGia::find($id);
        $meta = (object) [];
        if ( $detail->meta_id > 0){
            $meta = MetaData::find( $detail->meta_id );
        }       

        return view('backend.bao-gia.edit', compact( 'detail', 'meta'));
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
        $model = BaoGia::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa thành công');
        return redirect()->route('bao-gia.index');
    }
}