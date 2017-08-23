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
                            'slug', 
                            'description', 
                            'type_id', 
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
                            'updated_user'
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
    
}
