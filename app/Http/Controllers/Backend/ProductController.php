<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CateType;
use App\Models\CateParent;
use App\Models\Cate;
use App\Models\ProductImg;
use App\Models\MetaData;
use App\Models\Tag;
use App\Models\TagObjects;
use App\Models\ThongSo;
use App\Models\Rating;

use Helper, File, Session, Auth, Hash, URL, Image;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {   
        $arrSearch['status'] = $status = isset($request->status) ? $request->status : 1; 
        $arrSearch['is_hot'] = $is_hot = isset($request->is_hot) ? $request->is_hot : null;                   
        $arrSearch['parent_id'] = $parent_id = isset($request->parent_id) ? $request->parent_id : null;
        $arrSearch['cate_id'] = $cate_id = isset($request->cate_id) ? $request->cate_id : null;

        $arrSearch['title'] = $title = isset($request->title) && trim($request->title) != '' ? trim($request->title) : '';
        $arrSearch['code'] = $code = isset($request->code) && trim($request->code) != '' ? trim($request->code) : '';

        $query = Product::where('product.status', $status);        
        $cateParentList = CateParent::orderBy('display_order')->get();        
        $cateList = Cate::whereRaw('1=2');
        if( $parent_id ){
            $query->where('product.parent_id', $parent_id);
            $cateList = Cate::where('parent_id', $parent_id)->get();
        }        
        if( $cate_id ){
            $query->where('product.cate_id', $cate_id);
        }
        if( $is_hot ){
            $query->where('product.is_hot', $is_hot);
        }        
        if(Auth::user()->role == 1){
            $query->where('product.created_user', Auth::user()->id);
        }
        if( $title != ''){
            $query->where('product.title', 'LIKE', '%'.$title.'%');            
        }
        if( $code != ''){
            $query->where('product.code', $code);            
        }
        //$query->join('users', 'users.id', '=', 'product.created_user');        
        $query->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id');         
        $query->join('cate_parent', 'cate_parent.id', '=', 'product.parent_id');
        $query->leftJoin('cate', 'cate.id', '=', 'product.cate_id');        
        if($is_hot == 1){
            $query->orderBy('product.display_order', 'asc'); 
        }        
        $query->orderBy('product.is_hot', 'desc');
        $query->orderBy('product.id', 'desc');   
        $items = $query->select(['product_img.image_url as image_urls','product.*'])->paginate(50);

        return view('backend.product.index', compact( 'items', 'arrSearch', 'cateParentList', 'cateList'));        
    }

   
    public function ajaxGetTienIch(Request $request){
        $district_id = $request->district_id;
        $tienIchLists = Tag::where(['type' => 3])->get();
        return view('backend.product.ajax-get-tien-ich', compact( 'tienIchLists'));   
    }
    public function saveOrderHot(Request $request){
        $data = $request->all();
        if(!empty($data['display_order'])){
            foreach ($data['display_order'] as $id => $display_order) {
                $model = Product::find($id);
                $model->display_order = $display_order;
                $model->save();
            }
        }
        Session::flash('message', 'Cập nhật thứ tự tin HOT thành công');

        return redirect()->route('product.index', ['is_hot' => 1]);
    }
    public function ajaxSearch(Request $request){    
        $search_type = $request->search_type;        
        $arrSearch['cate_id'] = $cate_id = isset($request->cate_id) ? $request->cate_id : -1;
        $arrSearch['name'] = $name = isset($request->name) && trim($request->name) != '' ? trim($request->name) : '';
        
        $query = Product::whereRaw('1');        
        
        if( $cate_id ){
            $query->where('product.cate_id', $cate_id);
        }
        if( $name != ''){
            $query->where('product.title', 'LIKE', '%'.$name.'%');
            $query->orWhere('name_extend', 'LIKE', '%'.$name.'%');
        }
        $query->join('users', 'users.id', '=', 'product.created_user');
        $query->join('estate_type', 'estate_type.id', '=', 'product.type_id');
        $query->join('cate', 'cate.id', '=', 'product.cate_id');
        $query->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id');        
        $query->orderBy('product.id', 'desc');
        $items = $query->select(['product_img.image_url','product.*','product.id as product_id', 'full_name' , 'product.created_at as time_created', 'users.full_name', 'estate_type.name as ten_loai', 'cate.name as ten_cate'])
        ->paginate(1000);

        $estateTypeArr = CateParent::all();  
        

        return view('backend.product.content-search', compact( 'items', 'arrSearch', 'estateTypeArr',  'search_type'));
    }

   
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {
        $tagList = Tag::where('type', 1)->get();        
        
        $cateList = Cate::whereRaw('1=2')->get();
        $parent_id = $request->parent_id ? $request->parent_id : null;
        $cateParentList = CateParent::select('id', 'name')
                        ->orderBy('display_order', 'asc')
                        ->get();                        
        
        $thongsoList = ThongSo::orderBy('display_order')->get();
        return view('backend.product.create', compact('cateTypeList', 'cateParentList', 'tagList', 'cateList', 'thongsoList', 'parent_id'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store(Request $request)
    {
        $dataArr = $request->all();        
        
        $this->validate($request,[            
            'parent_id' => 'required',
            'cate_id' => 'required',   
            'code' => 'required',              
            'title' => 'required',
            'slug' => 'required'     
        ],
        [   
            'parent_id.required' => 'Bạn chưa chọn danh mục cha',
            'cate_id.required' => 'Bạn chưa chọn danh mục con',
            'code.required' => 'Bạn chưa nhập mã sản phẩm',
            'title.required' => 'Bạn chưa nhập tên sản phẩm',
            'slug.required' => 'Bạn chưa nhập slug'           
        ]);
           
        $dataArr['slug'] = str_replace(".", "-", $dataArr['slug']);
        $dataArr['slug'] = str_replace("(", "-", $dataArr['slug']);
        $dataArr['slug'] = str_replace(")", "", $dataArr['slug']);
        $dataArr['alias'] = Helper::stripUnicode($dataArr['title']);
        $dataArr['is_hot'] = isset($dataArr['is_hot']) ? 1 : 0; 
        $dataArr['is_slider'] = isset($dataArr['is_slider']) ? 1 : 0;  
        $dataArr['status'] = 1;
        $dataArr['created_user'] = Auth::user()->id;
        $dataArr['updated_user'] = Auth::user()->id;              
        $is_have = 0;
        foreach($dataArr['thong_so_chi_tiet'] as $a){
            if($a != ''){
                $is_have = 1;
            }
        }      
        if($is_have == 1){
            $dataArr['thong_so_chi_tiet'] = json_encode($dataArr['thong_so_chi_tiet']);
        }else{
            $dataArr['thong_so_chi_tiet'] = '';
        }

        $rs = Product::create($dataArr);
        $product_id = $rs->id;       

        $this->storeImage( $product_id, $dataArr);
        $this->storeMeta($product_id, 0, $dataArr);
        $this->processRelation($dataArr, $product_id);

        // store Rating
        for($i = 1; $i <= 5 ; $i++ ){
            $amount = $i == 5 ? 1 : 0;
            Rating::create(['score' => $i, 'object_id' => $product_id, 'object_type' => 1, 'amount' => $amount]);
        }

        Session::flash('message', 'Tạo mới thành công');

        return redirect()->route('product.index', ['parent_id' => $dataArr['parent_id'], 'cate_id' => $dataArr['cate_id']]);
    }
    private function processRelation($dataArr, $object_id, $type = 'add'){
    
        if( $type == 'edit'){          
            TagObjects::deleteTags( $object_id, 1);
        }
        // xu ly tags
        if( !empty( $dataArr['tags'] ) && $object_id ){
            foreach ($dataArr['tags'] as $tag_id) {
                TagObjects::create(['object_id' => $object_id, 'tag_id' => $tag_id, 'type' => 1]);
            }
        }      
      
    }
    public function storeMeta( $id, $meta_id, $dataArr ){
       
        $arrData = ['title' => $dataArr['meta_title'], 'description' => $dataArr['meta_description'], 'keywords'=> $dataArr['meta_keywords'], 'custom_text' => $dataArr['custom_text'], 'updated_user' => Auth::user()->id];
        if( $meta_id == 0){
            $arrData['created_user'] = Auth::user()->id;
            //var_dump(MetaData::create( $arrData ));die;
            $rs = MetaData::create( $arrData );
            $meta_id = $rs->id;
            //var_dump($meta_id);die;
            $modelSp = Product::find( $id );
            $modelSp->meta_id = $meta_id;
            $modelSp->save();
        }else {
            $model = MetaData::find($meta_id);           
            $model->update( $arrData );
        }              
    }
    public function storeThuocTinh($id, $dataArr){
        
        SpThuocTinh::where('product_id', $id)->delete();

        if( !empty($dataArr['thuoc_tinh'])){
            foreach( $dataArr['thuoc_tinh'] as $k => $value){
                if( $value == ""){
                    unset( $dataArr['thuoc_tinh'][$k]);
                }
            }
            
            SpThuocTinh::create(['product_id' => $id, 'thuoc_tinh' => json_encode($dataArr['thuoc_tinh'])]);
        }
    }

    public function storeImage($id, $dataArr){        
        //process old image
        $imageIdArr = isset($dataArr['image_id']) ? $dataArr['image_id'] : [];
        $hinhXoaArr = ProductImg::where('product_id', $id)->whereNotIn('id', $imageIdArr)->lists('id');
        if( $hinhXoaArr )
        {
            foreach ($hinhXoaArr as $image_id_xoa) {
                $model = ProductImg::find($image_id_xoa);
                $urlXoa = config('houseland.upload_path')."/".$model->image_url;
                if(is_file($urlXoa)){
                    unlink($urlXoa);
                }
                $model->delete();
            }
        }       

        //process new image
        if( isset( $dataArr['thumbnail_id'])){
            $thumbnail_id = $dataArr['thumbnail_id'];

            $imageArr = []; 

            if( !empty( $dataArr['image_tmp_url'] )){

                foreach ($dataArr['image_tmp_url'] as $k => $image_url) {
                    
                    $origin_img = base_path().$image_url;
                    if( $image_url ){

                        $imageArr['is_thumbnail'][] = $is_thumbnail = $dataArr['thumbnail_id'] == $image_url  ? 1 : 0;

                        $img = Image::make($origin_img);
                        $w_img = $img->width();
                        $h_img = $img->height();
                        $tile1 = 354/236;        
                        //dd('b', $origin_img);                  
                        $new_img = str_replace('/uploads/images/', '/uploads/images/thumbs/', $origin_img);
                       
                        if($w_img/$h_img <= $tile1){

                            Image::make($origin_img)->resize(354, null, function ($constraint) {
                                    $constraint->aspectRatio();
                            })->crop(354, 236)->save($new_img, 100);
                        }else{
                            Image::make($origin_img)->resize(null, 236, function ($constraint) {
                                    $constraint->aspectRatio();
                            })->crop(354, 236)->save($new_img, 100);
                        }                                        

                        $imageArr['name'][] = $image_url;
                        
                    }
                }
            }
            if( !empty($imageArr['name']) ){
                foreach ($imageArr['name'] as $key => $name) {
                    $rs = ProductImg::create(['product_id' => $id, 'image_url' => $name, 'display_order' => 1]);                
                    $image_id = $rs->id;
                    if( $imageArr['is_thumbnail'][$key] == 1){
                        $thumbnail_id = $image_id;
                    }
                }
            }
            $model = Product::find( $id );
            $model->thumbnail_id = $thumbnail_id;
            $model->save();
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
    //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {        
        $tagList = Tag::where('type', 1)->get();
        $hinhArr = (object) [];
        $detail = Product::find($id);
       
        $hinhArr = ProductImg::where('product_id', $id)->lists('image_url', 'id');             
        $cateParentList = CateParent::orderBy('display_order')->get();
        $cateList = Cate::where('parent_id', $detail->parent_id)->get();

        $meta = (object) [];
        if ( $detail->meta_id > 0){
            $meta = MetaData::find( $detail->meta_id );
        }               
        
        $tagSelected = Product::productTag($id);
        
        $thongsoList = ThongSo::orderBy('display_order')->get();

        $arrThongSo = json_decode($detail->thong_so_chi_tiet, true);

        return view('backend.product.edit', compact( 'detail', 'hinhArr',  'meta', 'cateParentList', 'cateList', 'tagList', 'tagSelected', 'thongsoList', 'arrThongSo'));
    }
    public function ajaxDetail(Request $request)
    {       
        $id = $request->id;
        $detail = Product::find($id);
        return view('backend.product.ajax-detail', compact( 'detail' ));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  Request  $request
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request)
    {
        $dataArr = $request->all();
        
         $this->validate($request,[            
            'parent_id' => 'required',
            'cate_id' => 'required',   
            'code' => 'required',              
            'title' => 'required',
            'slug' => 'required'     
        ],
        [   
            'parent_id.required' => 'Bạn chưa chọn danh mục cha',
            'cate_id.required' => 'Bạn chưa chọn danh mục con',
            'code.required' => 'Bạn chưa nhập mã sản phẩm',
            'title.required' => 'Bạn chưa nhập tên sản phẩm',
            'slug.required' => 'Bạn chưa nhập slug'           
        ]);
           
        $dataArr['slug'] = str_replace(".", "-", $dataArr['slug']);
        $dataArr['slug'] = str_replace("(", "-", $dataArr['slug']);
        $dataArr['slug'] = str_replace(")", "", $dataArr['slug']);
        $dataArr['alias'] = Helper::stripUnicode($dataArr['title']);
        $dataArr['is_hot'] = isset($dataArr['is_hot']) ? 1 : 0;     
        $dataArr['is_slider'] = isset($dataArr['is_slider']) ? 1 : 0;             
        $dataArr['updated_user'] = Auth::user()->id;        
        $is_have = 0;
        foreach($dataArr['thong_so_chi_tiet'] as $a){
            if($a != ''){
                $is_have = 1;
            }
        }      
        if($is_have == 1){
            $dataArr['thong_so_chi_tiet'] = json_encode($dataArr['thong_so_chi_tiet']);
        }else{
            $dataArr['thong_so_chi_tiet'] = '';
        }

        $model = Product::find($dataArr['id']);

        $model->update($dataArr);
        
        $product_id = $dataArr['id'];
        
        $this->storeMeta( $product_id, $dataArr['meta_id'], $dataArr);
        $this->storeImage( $product_id, $dataArr);
        $this->processRelation($dataArr, $product_id, 'edit');

        Session::flash('message', 'Cập nhật thành công');

        return redirect()->route('product.edit', $product_id);
        
    }
    public function ajaxSaveInfo(Request $request){
        
        $dataArr = $request->all();

        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        
        $dataArr['updated_user'] = Auth::user()->id;
        
        $model = Product::find($dataArr['id']);

        $model->update($dataArr);
        
        $product_id = $dataArr['id'];        

        Session::flash('message', 'Chỉnh sửa thành công');

    }    

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        // delete
        $model = Product::find($id);        
        $model->delete();
        ProductImg::where('product_id', $id)->delete();
        TagObjects::deleteTags( $id, 1);
        TagObjects::deleteTags( $id, 3);
        // redirect
        Session::flash('message', 'Xóa thành công');
        
        return redirect(URL::previous());//->route('product.short');
        
    }
}
