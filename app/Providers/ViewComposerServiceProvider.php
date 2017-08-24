<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Hash;
use App\Models\Settings;
use App\Models\ArticlesCate;
use App\Models\Articles;
use App\Models\District;
use App\Models\CustomLink;
use App\Models\Support;
use App\Models\Menu;
use App\Models\CateType;

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
	        $customLink = CustomLink::where('block_id', 1)->orderBy('display_order', 'asc')->get();	        	        
        	$footerLink = CustomLink::where('block_id', 2)->orderBy('display_order', 'asc')->get();
        	$supportList = Support::orderBy('display_order', 'asc')->get();
        	$menuList = Menu::where('menu_id', 1)->orderBy('display_order', 'asc')->get();
        	
        	$cateTypeList = CateType::orderBy('display_order')->get();

			$view->with( [
					'settingArr' => $settingArr, 
					'articleCate' => $articleCate, 
					'tinRandom' => $tinRandom, 
					'customLink' => $customLink, 
					'footerLink' => $footerLink, 
					'supportList' => $supportList,
					'menuList' => $menuList,
					'cateTypeList' => $cateTypeList		
			] );
			
		});
	}
	
}
