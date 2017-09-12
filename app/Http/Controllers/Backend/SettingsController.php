<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Models\Product;
use App\Models\Settings;
use File, Session, DB, Auth;

class SettingsController  extends Controller
{
    public function index(Request $request)
    {              
        if(Auth::user()->role == 1){
            return redirect()->route('product.index');
        }
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');

        return view('backend.settings.index', compact( 'settingArr'));
    }
     public function noti(Request $request)
    {           
        if(Auth::user()->role == 1){
            return redirect()->route('product.index');
        }   
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');

        return view('backend.settings.noti', compact( 'settingArr'));
    }
    public function dashboard(Request $request)
    {              
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $query = Product::where('product.status', 2);
        
        //$query->join('users', 'users.id', '=', 'product.created_user');
        $query->join('city', 'city.id', '=', 'product.city_id');        
        $query->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id'); 
        $query->join('estate_type', 'product.estate_type_id', '=','estate_type.id'); 
        $query->orderBy('product.id', 'desc');   
        $kyguiList = $query->select(['product_img.image_url as image_urls','product.*', 'estate_type.slug as slug_loai'])->get();


        return view('backend.product.index', compact( 'settingArr', 'kyguiList'));
    }
    public function storeNoti(Request $request){

        $dataArr = $request->all();

        $dataArr['updated_user'] = Auth::user()->id;

        unset($dataArr['_token']);       

        foreach( $dataArr as $key => $value ){
            $data['value'] = $value;
            Settings::where( 'name' , $key)->update($data);
        }

        Session::flash('message', 'Cập nhật thành công.');

        return redirect()->route('settings.noti');
    }
    public function update(Request $request){

    	$dataArr = $request->all();

    	$this->validate($request,[            
            'site_name' => 'required',            
            'site_title' => 'required',            
            'site_description' => 'required',            
            'site_keywords' => 'required',                                    
        ],
        [            
            'site_name.required' => 'Bạn chưa nhập tên site',            
            'site_title.required' => 'Bạn chưa nhập meta title',
            'site_description.required' => 'Bạn chưa nhập meta desciption',
            'site_keywords.unique' => 'Bạn chưa nhập meta keywords.'
        ]);  

    	if($dataArr['logo'] && $dataArr['logo_name']){
            
            $tmp = explode('/', $dataArr['logo']);

            if(!is_dir('uploads/'.date('Y'))){
                mkdir('uploads/'.date('Y'), 0777, true);
            }

            $destionation = date('Y'). '/'. end($tmp);
            
            File::move(config('houseland.upload_path').$dataArr['logo'], config('houseland.upload_path').$destionation);
            
            $dataArr['logo'] = $destionation;
        }

        if($dataArr['favicon'] && $dataArr['favicon_name']){
            
            $tmp = explode('/', $dataArr['favicon']);

            if(!is_dir('uploads/'.date('Y'))){
                mkdir('uploads/'.date('Y'), 0777, true);
            }

            $destionation = date('Y'). '/'. end($tmp);
            
            File::move(config('houseland.upload_path').$dataArr['favicon'], config('houseland.upload_path').$destionation);
            
            $dataArr['favicon'] = $destionation;
        }

        if($dataArr['banner'] && $dataArr['banner_name']){
            
            $tmp = explode('/', $dataArr['banner']);

            if(!is_dir('uploads/'.date('Y'))){
                mkdir('uploads/'.date('Y'), 0777, true);
            }

            $destionation = date('Y'). '/'. end($tmp);
            
            File::move(config('houseland.upload_path').$dataArr['banner'], config('houseland.upload_path').$destionation);
            
            $dataArr['banner'] = $destionation;
        }

        if($dataArr['icon_nam_hinh_thanh'] && $dataArr['icon_nam_hinh_thanh_name']){
            
            $tmp = explode('/', $dataArr['icon_nam_hinh_thanh']);

            if(!is_dir('uploads/'.date('Y'))){
                mkdir('uploads/'.date('Y'), 0777, true);
            }

            $destionation = date('Y'). '/'. end($tmp);
            
            File::move(config('houseland.upload_path').$dataArr['icon_nam_hinh_thanh'], config('houseland.upload_path').$destionation);
            
            $dataArr['icon_nam_hinh_thanh'] = $destionation;
        }

        if($dataArr['icon_kien_truc_su'] && $dataArr['icon_kien_truc_su_name']){
            
            $tmp = explode('/', $dataArr['icon_kien_truc_su']);

            if(!is_dir('uploads/'.date('Y'))){
                mkdir('uploads/'.date('Y'), 0777, true);
            }

            $destionation = date('Y'). '/'. end($tmp);
            
            File::move(config('houseland.upload_path').$dataArr['icon_kien_truc_su'], config('houseland.upload_path').$destionation);
            
            $dataArr['icon_kien_truc_su'] = $destionation;
        }

        if($dataArr['icon_cong_nhan'] && $dataArr['icon_cong_nhan_name']){
            
            $tmp = explode('/', $dataArr['icon_cong_nhan']);

            if(!is_dir('uploads/'.date('Y'))){
                mkdir('uploads/'.date('Y'), 0777, true);
            }

            $destionation = date('Y'). '/'. end($tmp);
            
            File::move(config('houseland.upload_path').$dataArr['icon_cong_nhan'], config('houseland.upload_path').$destionation);
            
            $dataArr['icon_cong_nhan'] = $destionation;
        }

        if($dataArr['icon_cong_trinh'] && $dataArr['icon_cong_trinh_name']){
            
            $tmp = explode('/', $dataArr['icon_cong_trinh']);

            if(!is_dir('uploads/'.date('Y'))){
                mkdir('uploads/'.date('Y'), 0777, true);
            }

            $destionation = date('Y'). '/'. end($tmp);
            
            File::move(config('houseland.upload_path').$dataArr['icon_cong_trinh'], config('houseland.upload_path').$destionation);
            
            $dataArr['icon_cong_trinh'] = $destionation;
        }

        if($dataArr['icon_tieu_de'] && $dataArr['icon_tieu_de_name']){
            
            $tmp = explode('/', $dataArr['icon_tieu_de']);

            if(!is_dir('uploads/'.date('Y'))){
                mkdir('uploads/'.date('Y'), 0777, true);
            }

            $destionation = date('Y'). '/'. end($tmp);
            
            File::move(config('houseland.upload_path').$dataArr['icon_tieu_de'], config('houseland.upload_path').$destionation);
            
            $dataArr['icon_tieu_de'] = $destionation;
        }

        $dataArr['updated_user'] = Auth::user()->id;

        unset($dataArr['_token']);
        unset($dataArr['logo_name']);
        unset($dataArr['favicon_name']);
        unset($dataArr['banner_name']);

    	foreach( $dataArr as $key => $value ){
    		$data['value'] = $value;
    		Settings::where( 'name' , $key)->update($data);
    	}

    	Session::flash('message', 'Cập nhật thành công.');

    	return redirect()->route('settings.index');
    }
}
