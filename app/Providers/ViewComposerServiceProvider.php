<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Hash;
use App\Models\Settings;
use App\Models\EstateType;
use App\Models\ArticlesCate;
use App\Models\Articles;
use App\Models\District;
use App\Models\CustomLink;
use App\Models\LandingProjects;
use App\Models\ProContent;
use App\Models\Price;
use App\Models\Support;
use App\Models\Area;
use App\Models\Menu;
use App\Models\City;
use App\Models\Direction;

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
			$banList = $thueList = [];	
			$tmp = EstateType::where('status', 1)->get();
			foreach($tmp as $est){
				if($est->type == 1){
					$banList[] = $est;
				}else{
					$thueList[] = $est;
				}
			}
	        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
	        $articleCate = ArticlesCate::orderBy('display_order', 'desc')->get();	     
	        $cityList = City::whereIn('id', [1, 6])->get();
	        $districtList = District::where('city_id', 1)->where('status',1)->get();
	        $tinRandom = Articles::whereRaw(1);
	        if($tinRandom->count() > 0){
	        	$tinRandom = $tinRandom->limit(5)->get();
	        }
	        $customLink = CustomLink::where('block_id', 1)->orderBy('display_order', 'asc')->get();	        	        
        	$footerLink = CustomLink::where('block_id', 2)->orderBy('display_order', 'asc')->get();
        	$supportList = Support::orderBy('display_order', 'asc')->get();
        	$menuList = Menu::where('menu_id', 1)->orderBy('display_order', 'asc')->get();
			$view->with( ['settingArr' => $settingArr, 
			'banList' => $banList, 'thueList' => $thueList, 'articleCate' => $articleCate, 'districtList' => $districtList, 'tinRandom' => $tinRandom, 'customLink' => $customLink, 'footerLink' => $footerLink, 'supportList' => $supportList,
			'menuList' => $menuList,
			'cityList' => $cityList
			] );
			
		});
	}
	
}
