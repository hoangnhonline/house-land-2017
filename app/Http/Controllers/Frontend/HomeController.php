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

use App\Models\CateParent;
use App\Models\Cate;
use App\Models\Pages;
use App\Models\Member;

use Helper, File, Session, Auth, Hash;

class HomeController extends Controller
{
    
    public static $loaiSpArrKey = [];    

    public function __construct(){
        
       

    }    
    public function loadSlider(){
        return view('frontend.home.ajax-slider');
    }
    public function index(Request $request)
    {         
        $articlesArr = [];
        $articlesCateHot = (object) [];
        $productCateHot = $productParentHot = [];
        $bannerArr = [];          
        $articlesCateHot = ArticlesCate::where('is_hot', 1)->orderBy('display_order')->get();
        foreach($articlesCateHot as $cateHot){
            $articlesArr[$cateHot->id] = Articles::where('is_hot', 1)
                                    ->where('cate_id', $cateHot->id)
                                    ->orderBy('display_order')
                                    ->orderBy('id', 'desc')->limit(5)->get();
        }

        $cateParentHot = CateParent::where('is_hot', 1)->orderBy('display_order')->get();
        $cateHot = Cate::where('is_hot', 1)->orderBy('display_order')->get();
        if($cateParentHot){
            foreach($cateParentHot as $parent)
            {
                $productParentHot[$parent->id] =Product::where('parent_id', $parent->id)
                                    ->where('is_hot', 1)
                                    ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                                    ->select('product_img.image_url', 'product.*')        
                                    ->orderBy('product.display_order')
                                    ->limit(10)->get();
            }
        }
        if($cateHot){
            foreach($cateHot as $cate)
            {
                $productCateHot[$cate->id] =Product::where('cate_id', $cate->id)
                                    ->where('is_hot', 1)
                                    ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                                    ->select('product_img.image_url', 'product.*')        
                                    ->orderBy('product.display_order')
                                    ->limit(10)->get();
            }
        }
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $seo = $settingArr;
        $seo['title'] = $settingArr['site_title'];
        $seo['description'] = $settingArr['site_description'];
        $seo['keywords'] = $settingArr['site_keywords'];
        $socialImage = $settingArr['banner'];

        return view('frontend.home.index', compact('articlesCateHot', 'articlesArr', 'socialImage', 'seo', 'cateParentHot', 'cateHot', 'productParentHot', 'productCateHot'));

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
        $query = Product::where('product.alias', 'LIKE', '%'.$tu_khoa.'%');
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
