<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'product';

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'code',
                            'title',
                            'alias',
                            'slug', 
                            'description',
                            'parent_id', 
                            'cate_id', 
                            'thong_so', 
                            'thong_so_chi_tiet', 
                            'tien_do', 
                            'hoi_dap', 
                            'content',
                            'thumbnail_id',                        
                            'video_url',                       
                            'status', 
                            'meta_id',                       
                            'is_hot',
                            'display_order',
                            'created_user',
                            'updated_user',
                            'layout',
                            'is_slider'
                        ];

    public static function productTag( $id )
    {
        $arr = [];
        $rs = TagObjects::where( ['type' => 1, 'object_id' => $id] )->lists('tag_id');
        if( $rs ){
            $arr = $rs->toArray();
        }
        return $arr;
    }    
   
    public static function getListTag($id){
        $query = TagObjects::where(['object_id' => $id, 'tag_objects.type' => 1])
            ->join('tag', 'tag.id', '=', 'tag_objects.tag_id')            
            ->get();
        return $query;
    }   
    public function cateParent()
    {
        return $this->belongsTo('App\Models\CateParent', 'parent_id');
    }
    public function cate()
    {
        return $this->belongsTo('App\Models\Cate', 'cate_id');
    }
    public function createdUser()
    {
        return $this->belongsTo('App\Models\Account', 'created_user');
    }
     public function updatedUser()
    {
        return $this->belongsTo('App\Models\Account', 'updated_user');
    }
}
