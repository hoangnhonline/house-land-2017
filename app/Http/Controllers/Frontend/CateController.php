<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CateType;
use App\Models\Cate;
use App\Models\CateParent;
use App\Models\Product;
use App\Models\ProductImg;
use App\Models\MetaData;
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
    public function index(Request $request)
    {   
        $productArr = [];
        $slug = $request->slug;
        $rs = EstateType::where('slug', $slug)->first();
        
        if($rs){//danh muc cha
            $estate_type_id = $rs->id;
            
            $query = SanPham::where('estate_type_id', $estate_type_id)
                ->where('so_luong_ton', '>', 0)
                ->where('price', '>', 0)
                ->where('chieu_dai', '>', 0)
                ->where('chieu_rong', '>', 0)
                ->where('chieu_cao', '>', 0)
                ->where('can_nang', '>', 0)
                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                ->leftJoin('sp_thuoctinh', 'sp_thuoctinh.sp_id', '=','product.id')
                ->select('product_img.image_url', 'product.*', 'thuoc_tinh');
                if($rs->price_sort == 0){
                    $query->where('price', '>', 0)->orderBy('product.price', 'asc');
                }else{
                    $query->where('price', '>', 0)->orderBy('product.price', 'desc');
                }
                //->where('product_img.image_url', '<>', '')
                $query->orderBy('product.id', 'desc');

                $productList  = $query->paginate(2);
                $productArr = $productList->toArray();

           

            $hoverInfo = HoverInfo::where('estate_type_id', $rs->id)->orderBy('display_order', 'asc')->orderBy('id', 'asc')->get();
            $socialImage = $rs->banner_menu;
            if( $rs->meta_id > 0){
               $seo = MetaData::find( $rs->meta_id )->toArray();
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = $rs->name;
            }                                     
            return view('frontend.cate.parent', compact('productList','productArr', 'rs', 'hoverInfo', 'socialImage', 'seo'));
        }else{
            $detailPage = Pages::where('slug', $slug)->first();
            if(!$detailPage){
                return redirect()->route('home');
            }
            $seo['title'] = $detailPage->meta_title ? $detailPage->meta_title : $detailPage->title;
            $seo['description'] = $detailPage->meta_description ? $detailPage->meta_description : $detailPage->title;
            $seo['keywords'] = $detailPage->meta_keywords ? $detailPage->meta_keywords : $detailPage->title;           
            return view('frontend.pages.index', compact('detailPage', 'seo'));    
        }
    }
    public function getSeoInfo($meta_id){

    }
    public function cateType(Request $request){
        $cateArr = [];      
        $parentList = (object)[];
        $slugCateType = $request->slugCateType;
        if(!$slugCateType){
            return redirect()->route('home');
        }
        $typeDetail = CateType::where('slug', $slugCateType)->first();
        
        if($typeDetail){
            $type_id = $typeDetail->id;

            $parentList = CateParent::where('type_id', $type_id)->orderBy('display_order')->get();

            if($parentList){
                foreach($parentList as $parent){
                    $cateArr[$parent->id] = Cate::where('parent_id', $parent->id)                             
                                            ->orderBy('display_order')
                                            ->get();
                }
            }
            if( $typeDetail->meta_id > 0){
               $seo = MetaData::find( $typeDetail->meta_id )->toArray();
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = $typeDetail->name;
            }  
                return view('frontend.cate.type', compact('type_id', 'typeDetail', 'cateArr', 'seo', 'parentList'));
            
        }else{
            return redirect()->route('home');   
        }
    }
    public function cateParent(Request $request){
        $productArr = [];
        $cateList = (object) [];
        $slugCateType = $request->slugCateType;
        if(!$slugCateType){
            return redirect()->route('home');
        }
        $type_id = CateType::where('slug', $slugCateType)->first()->id;
        if($type_id){
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
                                                ->orderBy('product.id', 'desc')
                                                ->get();
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
            
            $productList = Product::where('cate_id', $cate_id)
                                    ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                                    ->select('product_img.image_url', 'product.*')                                                   
                                    ->orderBy('product.id', 'desc')
                                    ->paginate(15);
            if( $cateDetail->meta_id > 0){
               $seo = MetaData::find( $cateDetail->meta_id )->toArray();
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = $cateDetail->name;
            }  
            return view('frontend.cate.child', compact('parent_id', 'cateDetail', 'productList', 'seo'));
            
        }else{
            return redirect()->route('home');   
        }
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function search(Request $request)
    {

        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        
        $layout_name = "main-category";
        
        $page_name = "page-category";

        $cateArr = $cateActiveArr = $moviesActiveArr = [];

        $tu_khoa = $request->k;
        
        $is_search = 1;

        $moviesArr = Film::where('alias', 'LIKE', '%'.$tu_khoa.'%')->orderBy('id', 'desc')->paginate(20);

        return view('frontend.cate', compact('settingArr', 'moviesArr', 'tu_khoa',  'is_search', 'layout_name', 'page_name' ));
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
    
    

    public function newsList(Request $request)
    {
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $layout_name = "main-news";
        
        $page_name = "page-news";

        $cateArr = $cateActiveArr = $moviesActiveArr = [];
       
        $cateDetail = ArticlesCate::where('slug' , 'tin-tuc')->first();
        $title = trim($cateDetail->meta_title) ? $cateDetail->meta_title : $cateDetail->name;

        $articlesArr = Articles::where('cate_id', 1)->orderBy('id', 'desc')->paginate(10);
        $hotArr = Articles::where( ['cate_id' => 1, 'is_hot' => 1] )->orderBy('id', 'desc')->limit(5)->get();
        return view('frontend.news-list', compact('title','settingArr', 'hotArr', 'layout_name', 'page_name', 'articlesArr'));
    }

    public function newsDetail(Request $request)
    {
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $layout_name = "main-news";
        
        $page_name = "page-news";

        $id = $request->id;

        $detail = Articles::where( 'id', $id )
                ->select('id', 'title', 'slug', 'description', 'image_url', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text')
                ->first();
        if(!$detail){
            return redirect()->route('home');
        }

        if( $detail ){
            $cateArr = $cateActiveArr = $moviesActiveArr = [];
        
            
            $title = trim($detail->meta_title) ? $detail->meta_title : $detail->title;

            $hotArr = Articles::where( ['cate_id' => 1, 'is_hot' => 1] )->where('id', '<>', $id)->orderBy('id', 'desc')->limit(5)->get();

            return view('frontend.news-detail', compact('title', 'settingArr', 'hotArr', 'layout_name', 'page_name', 'detail'));
        }else{
            return view('erros.404');
        }     

        
    }

}
