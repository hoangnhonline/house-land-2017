<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Product;
use App\Models\District;
use App\Models\Ward;
use App\Models\Street;
use App\Models\Project;
use App\Models\EstateType;
use App\Models\MetaData;
use App\Models\ProductImg;
use App\Models\Tag;
use App\Models\TagObjects;
use App\Models\Direction;
use App\Models\PriceUnit;
use App\Models\Articles;
use App\Models\ThongSo;

use Helper, File, Session, Auth, Image;

class DetailController extends Controller
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
        $slug = $request->slug;
        $detail = Product::where('slug', $slug)->first();
        if(!$detail){
            return redirect()->route('home');
        }
        $hinhArr = ProductImg::where('product_id', $detail->id)->get()->toArray();

      
        if( $detail->meta_id > 0){
           $meta = MetaData::find( $detail->meta_id )->toArray();
           $seo['title'] = $meta['title'] != '' ? $meta['title'] : $detail->title;
           $seo['description'] = $meta['description'] != '' ? $meta['description'] : $detail->title;
           $seo['keywords'] = $meta['keywords'] != '' ? $meta['keywords'] : $detail->title;
        }else{
            $seo['title'] = $seo['description'] = $seo['keywords'] = $detail->title;
        }               
        
        if($detail->thumbnail_id > 0){
            $socialImage = ProductImg::find($detail->thumbnail_id)->image_url;
        }

        $otherList = Product::where('product.slug', '<>', '')
                    ->where('product.cate_id', $detail->cate_id)                    
                    ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                    ->select('product_img.image_url as image_url', 'product.*')                    
                    ->where('product.id', '<>', $detail->id)  
                    ->orderBy('product.id', 'desc')
                    ->limit(6)
                    ->get();
        $tagSelected = Product::getListTag($detail->id);
        if($detail->layout == 1){
            $thongsoList = ThongSo::orderBy('display_order')->get();

            $arrThongSo = json_decode($detail->thong_so_chi_tiet, true);
            return view('frontend.detail.index-thong-so-rieng', compact('detail', 'hinhArr', 'seo', 'socialImage', 'otherList', 'tagSelected', 'thongsoList', 'arrThongSo'));
        }else{
            return view('frontend.detail.index', compact('detail', 'hinhArr', 'seo', 'socialImage', 'otherList', 'tagSelected'));    
        }
        
    }
    public function tagDetail(Request $request){
        $slug = $request->slug;
        $detail = Tag::where('slug', $slug)->first();
        //dd($detail->type);
        if($detail->type == 1 || $detail->type == 3){        
            $productList = (object)[];
            $listId = [];
            $listId = TagObjects::where(['type' => $detail->type, 'tag_id' => $detail->id])->lists('object_id');
            if($listId){
                $listId = $listId->toArray();
            }
            if(!empty($listId)){
            $query = Product::where('product.status', 1)            
                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                ->select('product_img.image_url as image_url', 'product.*')
                ->whereIn('product.id', $listId)               
                ->orderBy('product.id', 'desc');
                $productList  = $query->paginate(15);

            }
            
            if( $detail->meta_id > 0){
               $seo = MetaData::find( $detail->meta_id )->toArray();
               $seo['title'] = $seo['title'] != '' ? $seo['title'] : 'Tag - '. $detail->name;
               $seo['description'] = $seo['description'] != '' ? $seo['description'] : 'Tag - '. $detail->name;
               $seo['keywords'] = $seo['keywords'] != '' ? $seo['keywords'] : 'Tag - '. $detail->name;
               $seo['custom_text'] = $seo['custom_text'];
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = 'Tag - '. $detail->name;
                $seo['custom_text'] = "";
            }
            
            return view('frontend.cate.tag', compact('productList', 'socialImage', 'seo', 'detail'));
        }elseif($detail->type == 2){ // articles
            $articlesArr = (object)[];
            $listId = [];
            $listId = TagObjects::where(['type' => 2, 'tag_id' => $detail->id])->lists('object_id');
            if($listId){
                $listId = $listId->toArray();
            }
            if(!empty($listId)){
                $articlesArr = Articles::whereIn('id', $listId)->orderBy('id', 'desc')->where('cate_id', '<>', 999)->paginate(20);
            }  

            if( $detail->meta_id > 0){
               $seo = MetaData::find( $detail->meta_id )->toArray();
               $seo['title'] = $seo['title'] != '' ? $seo['title'] : 'Tag - '. $detail->name;
               $seo['description'] = $seo['description'] != '' ? $seo['description'] : 'Tag - '. $detail->name;
               $seo['keywords'] = $seo['keywords'] != '' ? $seo['keywords'] : 'Tag - '. $detail->name;
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = 'Tag - '. $detail->name;
            }  
                  
            return view('frontend.news.tag', compact('title', 'articlesArr', 'seo', 'socialImage', 'detail'));
        }
    }
    public function ajaxTab(Request $request){
        $table = $request->type ? $request->type : 'category';
        $id = $request->id;

        $arr = Film::getFilmHomeTab( $table, $id);

        return view('frontend.index.ajax-tab', compact('arr'));
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */    

    

}
