<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Hash;
use App\Models\Settings;
use App\Models\ArticlesCate;
use App\Models\Articles;
use App\Models\District;
use App\Models\CustomLink;
use App\Models\Member;
use App\Models\Menu;
use App\Models\CateParent;
use App\Models\Text;
use Auth;
class ViewComposerServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//Call function composerSidebar
		$this->composerMenu();	
		
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Composer the sidebar
	 */
	private function composerMenu()
	{
		
		view()->composer( '*' , function( $view ){		
			
	        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
	        $articleCate = ArticlesCate::orderBy('display_order', 'desc')->get();	     
	       
	        $tinRandom = Articles::whereRaw(1);
	        if($tinRandom->count() > 0){
	        	$tinRandom = $tinRandom->limit(5)->get();
	        }
	        $footerLink1 = CustomLink::where('block_id', 1)->orderBy('display_order', 'asc')->get();	        	        
        	$footerLink2 = CustomLink::where('block_id', 2)->orderBy('display_order', 'asc')->get();        	
	       	$menuList = Menu::where('menu_id', 1)->orderBy('display_order', 'asc')->get();
	       	$cateParentList = CateParent::orderBy('display_order')->get();

	       	$textList = Text::whereRaw('1')->lists('content', 'id');
	        $routeName = \Request::route()->getName();	      
	        
	        $isEdit = Auth::check();	        

			$view->with( [
					'settingArr' => $settingArr, 
					'articleCate' => $articleCate, 
					'tinRandom' => $tinRandom, 					
					'footerLink1' => $footerLink1,
					'footerLink2' => $footerLink2,
					'menuList' => $menuList,
					'cateParentList' => $cateParentList,
					'routeName' => $routeName,
					'textList' => $textList,
					'isEdit' => $isEdit
			] );
			
		});
	}
	
}
