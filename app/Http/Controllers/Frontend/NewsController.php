<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ArticlesCate;
use App\Models\Articles;
use App\Models\CateParent;
use App\Models\Cate;
use App\Models\SettingBaogia;
use App\Models\Settings;
use App\Models\Product;

use Helper, File, Session, Auth;
use Mail;

class NewsController extends Controller
{
    public function newsList(Request $request)
    {
        $slug = $request->slug;
        $cateArr = $cateActiveArr = $moviesActiveArr = [];
       
        $cateDetail = ArticlesCate::where('slug' , $slug)->first();

        $title = trim($cateDetail->meta_title) ? $cateDetail->meta_title : $cateDetail->name;
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $articlesArr = Articles::where('cate_id', $cateDetail->id)->orderBy('is_hot', 'desc')->orderBy('id', 'desc')->paginate($settingArr['articles_per_page']);

        $hotArr = Articles::where( ['cate_id' => $cateDetail->id, 'is_hot' => 1] )->orderBy('id', 'desc')->limit(5)->get();
        $seo['title'] = $cateDetail->meta_title ? $cateDetail->meta_title : $cateDetail->title;
        $seo['description'] = $cateDetail->meta_description ? $cateDetail->meta_description : $cateDetail->title;
        $seo['keywords'] = $cateDetail->meta_keywords ? $cateDetail->meta_keywords : $cateDetail->title;
        $socialImage = $cateDetail->image_url; 
         //widget
        $widgetProduct = (object) [];        
        $wParent = CateParent::where('is_widget', 1)->first();
        if($wParent){

            $widgetProduct = Product::where('product.slug', '<>', '')
                    ->where('product.parent_id', $wParent->id)                    
                    ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                    ->select('product_img.image_url as image_url', 'product.*')->orderBy('is_hot', 'desc')->orderBy('id', 'desc')->limit($settingArr['product_widget'])->get();
            
        }else{
            $wCate = Cate::where('is_widget', 1)->first();
            $widgetProduct = Product::where('product.slug', '<>', '')
                    ->where('product.cate_id', $wCate->id)                    
                    ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                    ->select('product_img.image_url as image_url', 'product.*')->orderBy('is_hot', 'desc')->orderBy('id', 'desc')->limit($settingArr['product_widget'])->get();
        }      
        return view('frontend.news.index', compact('title', 'hotArr', 'articlesArr', 'cateDetail', 'seo', 'socialImage', 'widgetProduct'));
    }      

     public function newsDetail(Request $request)
    { 
        $id = $request->id;

        $detail = Articles::find($id);
        
        if( $detail ){           

            $title = trim($detail->meta_title) ? $detail->meta_title : $detail->title;
            $settingArr = Settings::whereRaw('1')->lists('value', 'name');
            $otherList = Articles::where( ['cate_id' => $detail->cate_id] )->where('id', '<>', $id)->orderBy('is_hot', 'desc')->orderBy('id', 'desc')->limit($settingArr['article_related'])->get();            
            $seo['title'] = $detail->meta_title ? $detail->meta_title : $detail->title;
            $seo['description'] = $detail->meta_description ? $detail->meta_description : $detail->title;
            $seo['keywords'] = $detail->meta_keywords ? $detail->meta_keywords : $detail->title;
            $socialImage = $detail->image_url; 
          
            $tagSelected = Articles::getListTag($id);
            $cateDetail = ArticlesCate::find($detail->cate_id);
            Helper::counter($id, 2);
            if($detail->type == 1){
                 $widgetProduct = (object) [];
                    $settingArr = Settings::whereRaw('1')->lists('value', 'name');
                    $wParent = CateParent::where('is_widget', 1)->first();
                    if($wParent){

                        $widgetProduct = Product::where('product.slug', '<>', '')
                                ->where('product.parent_id', $wParent->id)                    
                                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                                ->select('product_img.image_url as image_url', 'product.*')->orderBy('is_hot', 'desc')->orderBy('id', 'desc')->limit($settingArr['product_widget'])->get();
                        
                    }else{
                        $wCate = Cate::where('is_widget', 1)->first();
                        $widgetProduct = Product::where('product.slug', '<>', '')
                                ->where('product.cate_id', $wCate->id)                    
                                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                                ->select('product_img.image_url as image_url', 'product.*')->orderBy('is_hot', 'desc')->orderBy('id', 'desc')->limit($settingArr['product_widget'])->get();
                    } 
                return view('frontend.news.news-detail', compact('title',  'otherList', 'detail', 'otherArr', 'seo', 'socialImage', 'tagSelected', 'cateDetail', 'widgetProduct'));
            }else{
                 $servicesList = Articles::where('cate_id', 7)->orderBy('display_order')->orderBy('id')->get();
                 if($id == 100){
                    $settingBaogia = SettingBaogia::orderBy('type')->orderBy('display_order')->get();
                    foreach($settingBaogia as $value){
                        $arrSetting[$value->type][] = $value;
                    }                   
                    return view('frontend.services.thiet-ke', compact('title', 'detail', 'otherArr', 'seo', 'socialImage', 'tagSelected', 'cateDetail', 'servicesList', 'arrSetting', 'id'));    
                 }
                 if($id == 103){
                    $settingBaogia = SettingBaogia::orderBy('type')->orderBy('display_order')->get();
                    foreach($settingBaogia as $value){
                        $arrSetting[$value->type][] = $value;
                    }                   
                    return view('frontend.services.thi-cong', compact('title', 'detail', 'otherArr', 'seo', 'socialImage', 'tagSelected', 'cateDetail', 'servicesList', 'arrSetting', 'id'));    
                 }
                return view('frontend.pages.services-detail', compact('title', 'detail', 'otherArr', 'seo', 'socialImage', 'tagSelected', 'cateDetail', 'servicesList'));
            }
        }else{
            return view('erros.404');
        }
    }
}

