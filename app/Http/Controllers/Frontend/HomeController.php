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
use App\Models\CateType;
use App\Models\CateParent;
use App\Models\Cate;
use App\Models\Pages;

use Helper, File, Session, Auth, Hash;

class HomeController extends Controller
{
    
    public static $loaiSp = []; 
    public static $loaiSpArrKey = [];    

    public function __construct(){
        
       

    }    
    public function loadSlider(){
        return view('frontend.home.ajax-slider');
    }
    public function index(Request $request)
    {         
        $productArr = [];
        $hoverInfo = [];
        $loaiSp = CateType::where('status', 1)->orderBy('display_order')->get();
        $bannerArr = [];          
        $articlesArr = Articles::where(['cate_id' => 1])->orderBy('id', 'desc')->get();
        $hotProduct = Product::where('product.slug', '<>', '')                    
                    ->where('product.status', 1)
                    ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')            
                    ->join('cate_type', 'cate_type.id', '=','product.type_id')      
                    ->join('cate_parent', 'cate_type.id', '=','product.type_id')      
                    ->select('product_img.image_url as image_url', 'product.*', 'cate_type.slug as slug_type')
                    ->where('product_img.image_url', '<>', '')                                         
                    ->orderBy('product.is_hot', 'desc')                  
                    ->orderBy('product.id', 'desc')->limit(5)->get();

        $cateParentHot = CateParent::where('is_hot', 1)->orderBy('display_order')->get();
        $cateHot = Cate::whereRaw('1=2')->get();
        if($cateParentHot){
            foreach($cateParentHot as $parent)
            {
                $cateHot[$parent->id] = Cate::where('is_hot', 1)->where('parent_id', $parent->id)->orderBy('display_order')->get();
            }
        }
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $seo = $settingArr;
        $seo['title'] = $settingArr['site_title'];
        $seo['description'] = $settingArr['site_description'];
        $seo['keywords'] = $settingArr['site_keywords'];
        $socialImage = $settingArr['banner'];

     
        return view('frontend.home.index', compact('articlesArr', 'socialImage', 'seo', 'cateParentHot', 'cateHot'));

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
        return view('frontend.pages.index', compact('detailPage', 'seo'));    
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

        $productArr = Product::where('product.alias', 'LIKE', '%'.$tu_khoa.'%')->where('so_luong_ton', '>', 0)->where('price', '>', 0)->where('estate_type.status', 1)                        
                        ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')                        
                        ->join('estate_type', 'estate_type.id', '=', 'product.estate_type_id')
                        ->select('product_img.image_url', 'product.*', 'thuoc_tinh')
                        ->orderBy('id', 'desc')->paginate(20);
        $seo['title'] = $seo['description'] =$seo['keywords'] = "Tìm kiếm sản phẩm theo từ khóa '".$tu_khoa."'";
        $hoverInfo = [];
        if($productArr->count() > 0){
            $hoverInfoTmp = HoverInfo::orderBy('display_order', 'asc')->orderBy('id', 'asc')->get();
            foreach($hoverInfoTmp as $value){
                $hoverInfo[$value->estate_type_id][] = $value;
            }
        }
        //var_dump("<pre>", $hoverInfo);die;
        return view('frontend.search.index', compact('productArr', 'tu_khoa', 'seo', 'hoverInfo'));
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
        return view('frontend.contact.index', compact('seo', 'socialImage'));
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
