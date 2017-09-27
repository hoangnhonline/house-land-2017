<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Location;
use App\Models\Articles;
use App\Models\ArticlesCate;
use App\Models\Customer;
use App\Models\Newsletter;
use App\Models\Settings;
use App\Models\HotCate;
use App\Models\CateParent;
use App\Models\Cate;
use App\Models\Pages;
use App\Models\Member;
use App\Models\Rating;

use Helper, File, Session, Auth, Hash, Response;

class HomeController extends Controller
{
    
    public static $loaiSpArrKey = [];    

    public function __construct(){
        
       

    }    
    public function rss(Request $request){
        $productList = Product::where('status', 1)->orderBy('id', 'desc')->get();  
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $articlesList = Articles::where('status', 1)->where('cate_id', '<>', 7)->orderBy('id', 'desc')->get();  
        return Response::view('frontend.home.rss', compact('productList', 'settingArr', 'articlesList'))->header('Content-Type', 'text/xml');
    }
    public function insertRating(Request $request){
        $score = $request->score;
        $object_id = $request->object_id;
        $object_type = $request->object_type;
        if($score){
            $rs = Rating::where(['score' => $score, 'object_id' => $object_id, 'object_type' => $object_type])->first();
            if($rs){
                $rs->amount = $rs->amount + 1;
                $rs->save();
            }else{
                Rating::create(['score' => $score, 'object_id' => $object_id, 'object_type' => $object_type, 'amount' => 1]);
            }
        }
        return view('frontend.partials.rating', compact('object_id', 'object_type'));
    }
    public function index(Request $request)
    {         
        $articlesArr = [];
        $articlesCateHot = (object) [];
        $productCateHot = $productParentHot = [];
        $bannerArr = [];          
        
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');

        $articlesCateHot = ArticlesCate::where('is_hot', 1)->orderBy('display_order')->get();
        foreach($articlesCateHot as $cateHot){
            $articlesArr[$cateHot->id] = Articles::where('status', 1)
                                    ->where('cate_id', $cateHot->id)
                                    ->orderBy('is_hot', 'desc')
                                    ->orderBy('id', 'desc')
                                    ->orderBy('display_order')
                                    ->limit(5)->get();
        }

        $cateParentHot = CateParent::where('is_hot', 1)->orderBy('display_order')->get();
        $cateHot = Cate::where('is_hot', 1)->orderBy('display_order')->get();

        //hotCate
        $parentArr = $cateArr = [];
        $hotCateList = HotCate::orderBy('display_order')->get();
        if($hotCateList){
            foreach($hotCateList as $hotCate)
            {                
                $query = Product::where('status', 1);
                    if($hotCate->type == 1){
                        $parentArr[$hotCate->object_id] = CateParent::find($hotCate->object_id);
                        $query->where('parent_id', $hotCate->object_id);
                    }else{
                        $cateArr[$hotCate->object_id] = Cate::find($hotCate->object_id);
                        $query->where('cate_id', $hotCate->object_id);
                    }                                 
                    $query->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                    ->select('product_img.image_url', 'product.*')        
                    ->orderBy('product.is_hot', 'desc')
                    ->orderBy('product.id', 'desc')
                    ->orderBy('product.display_order');
                                    
                $productHot[$hotCate->id]  = $query->limit($settingArr['hot_homepage'])->get();
            }
        }
        
        
        $seo = $settingArr;
        $seo['title'] = $settingArr['site_title'];
        $seo['description'] = $settingArr['site_description'];
        $seo['keywords'] = $settingArr['site_keywords'];
        $socialImage = $settingArr['banner'];

        return view('frontend.home.index', compact('articlesCateHot', 'articlesArr', 'socialImage', 'seo', 'productHot', 'hotCateList', 'parentArr', 'cateArr'));

    }
    public function getChild(Request $request){
        $module = $request->mod;
        $id = $request->id;
        $column = $request->col;
        return Helper::getChild($module, $column, $id);
    }
    public function pages(Request $request){
        $slug = $request->slug;

        $detailPage = Pages::where('slug', $slug)->first();
         
        if(!$detailPage){
            return redirect()->route('home');
        }
        $seo['title'] = $detailPage->meta_title ? $detailPage->meta_title : $detailPage->title;
        $seo['description'] = $detailPage->meta_description ? $detailPage->meta_description : $detailPage->title;
        $seo['keywords'] = $detailPage->meta_keywords ? $detailPage->meta_keywords : $detailPage->title;      
        
        $memberList = Member::orderBy('display_order', 'asc')->get();

        return view('frontend.pages.index', compact('detailPage', 'seo', 'memberList', 'slug'));    
    }

    public function services(Request $request){
        $servicesList = Articles::where('cate_id', 7)->orderBy('display_order')->orderBy('id')->get();
        
        $seo['title'] =  $seo['description'] = $seo['keywords'] = "Dịch vụ";           

        return view('frontend.pages.services', compact('servicesList', 'seo'));    
    }

    
    public function getNoti(){
        $countMess = 0;
        if(Session::get('userId') > 0){
            $countMess = CustomerNotification::where(['customer_id' => Session::get('userId'), 'status' => 1])->count();    
        }
        return $countMess;
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function search(Request $request)
    {
        $tu_khoa = $request->keyword;
        $parent_id = $request->cid ? $request->cid : null;
        $tu_khoa_find = Helper::stripUnicode($tu_khoa);
        $query = Product::where('product.alias', 'LIKE', '%'.$tu_khoa_find.'%')->orWhere('product.code', 'LIKE', '%'.$tu_khoa_find.'%');
            if($parent_id > 0){
                $query->where('parent_id', $parent_id);
            }
                    $query->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                    ->select('product_img.image_url', 'product.*')                                                  
                    ->orderBy('product.id', 'desc');
                   $productList = $query->paginate(15);
        $seo['title'] = $seo['description'] =$seo['keywords'] = "Tìm kiếm sản phẩm theo từ khóa '".$tu_khoa."'";
       
        return view('frontend.cate.search', compact('productList', 'tu_khoa', 'seo', 'parent_id'));
    }
    public function ajaxTab(Request $request){
        $table = $request->type ? $request->type : 'category';
        $id = $request->id;

        $arr = Film::getFilmHomeTab( $table, $id);

        return view('frontend.index.ajax-tab', compact('arr'));
    }
    public function contact(Request $request){        

        $seo['title'] = 'Liên hệ';
        $seo['description'] = 'Liên hệ';
        $seo['keywords'] = 'Liên hệ';
        $socialImage = '';
        $servicesList = Articles::where('cate_id', 7)->orderBy('display_order')->orderBy('id')->get();
        return view('frontend.contact.index', compact('seo', 'socialImage', 'servicesList'));
    }

    

    public function registerNews(Request $request)
    {

        $register = 0; 
        $email = $request->email;
        $newsletter = Newsletter::where('email', $email)->first();
        if(is_null($newsletter)) {
           $newsletter = new Newsletter;
           $newsletter->email = $email;
           $newsletter->is_member = 0;
           $newsletter->save();
           $register = 1;
        }

        return $register;
    }

}
