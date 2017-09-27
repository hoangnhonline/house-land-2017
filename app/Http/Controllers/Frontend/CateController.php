<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Models\CateParent;
use App\Models\Product;
use App\Models\ProductImg;
use App\Models\MetaData;
use App\Models\Settings;
use Helper, File, Session, Auth, DB;

class CateController extends Controller
{
    
    public static $loaiSp = []; 
    public static $loaiSpArrKey = [];    

    public function __construct(){
        
       

    }
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
   
    public function getSeoInfo($meta_id){

    }   
    public function cateParent(Request $request){
        $productArr = [];
        $cateList = (object) [];
        
        $slugCateParent = $request->slugCateParent;
        if(!$slugCateParent){
            return redirect()->route('home');       
        }
        $parentDetail = CateParent::where('slug', $slugCateParent)->first();

        if($parentDetail){
            $parent_id = $parentDetail->id;
            $cateList = Cate::where('parent_id', $parent_id)->orderBy('display_order')->get();
            if($cateList){
                foreach($cateList as $cate){
                    $productArr[$cate->id] = Product::where('cate_id', $cate->id)
                                    ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                                    ->select('product_img.image_url', 'product.*')                                                   
                                    ->orderBy('product.is_hot', 'desc')
                                    ->orderBy('product.id', 'desc')
                                    ->limit(15)->get();
                }
            }
        if( $parentDetail->meta_id > 0){
           $seo = MetaData::find( $parentDetail->meta_id )->toArray();
        }else{
            $seo['title'] = $seo['description'] = $seo['keywords'] = $parentDetail->name;
        }  
        
            return view('frontend.cate.parent', compact('parent_id', 'parentDetail', 'cateList', 'productArr', 'seo'));
        }else{
            return redirect()->route('home');       
        }
        
    }
    public function cateChild(Request $request){
        $productArr = [];
        $cateList = (object) [];
        $slugCateChild = $request->slugCateChild;
        
        if(!$slugCateChild){
            return redirect()->route('home');
        }
        $cateDetail = Cate::where('slug', $slugCateChild)->first();
        if($cateDetail){
            $cate_id = $cateDetail->id;
            $settingArr = Settings::whereRaw('1')->lists('value', 'name');
            $productList = Product::where('cate_id', $cate_id)
                                    ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                                    ->select('product_img.image_url', 'product.*')   
                                    ->orderBy('product.is_hot', 'desc')     
                                    ->orderBy('product.id', 'desc')
                                    ->paginate($settingArr['product_per_page']);
			
            if( $cateDetail->meta_id > 0){
               $seo = MetaData::find( $cateDetail->meta_id )->toArray();
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = $cateDetail->name;
            }  
            $page = $request->page ? $request->page : 1;        
            return view('frontend.cate.child', compact('parent_id', 'cateDetail', 'productList', 'seo', 'page'));
            
        }else{
            return redirect()->route('home');   
        }
    }
    

    public function cate(Request $request)
    {

        $productArr = [];
        $slugEstateType = $request->slugEstateType;
        $slug = $request->slug;
        $rs = EstateType::where('slug', $slugEstateType)->first();
        if(!$rs){
            return redirect()->route('home');
        }
        $estate_type_id = $rs->id;
        $rsCate = Cate::where(['estate_type_id' => $estate_type_id, 'slug' => $slug])->first();
        $cate_id = $rsCate->id;

        $cateArr = Cate::where('status', 1)->where('estate_type_id', $estate_type_id)->get();

        
        $query = SanPham::where('cate_id', $rsCate->id)->where('estate_type_id', $estate_type_id)->where('so_luong_ton', '>', 0)->where('price', '>', 0)
                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                ->leftJoin('sp_thuoctinh', 'sp_thuoctinh.sp_id', '=','product.id')
                ->select('product_img.image_url', 'product.*', 'thuoc_tinh');
                    if($rs->price_sort == 0){
                        $query->where('price', '>', 0)->orderBy('product.price', 'asc');
                    }else{
                        $query->where('price', '>', 0)->orderBy('product.price', 'desc');
                    }
                $query->orderBy('product.id', 'desc');
                $productArr = $query->paginate(24);
        $hoverInfo = HoverInfo::where('estate_type_id', $rs->id)->orderBy('display_order', 'asc')->orderBy('id', 'asc')->get();  
        $socialImage = $rsCate->icon_url;
        if( $rsCate->meta_id > 0){            
           $seo = MetaData::find( $rsCate->meta_id )->toArray();           
        }else{
            $seo['title'] = $seo['description'] = $seo['keywords'] = $rsCate->name;
        }
        
        return view('frontend.cate.child', compact('productArr', 'cateArr', 'rs', 'rsCate', 'hoverInfo', 'socialImage', 'seo'));
    }    
    
}
