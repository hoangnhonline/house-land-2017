<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CateType extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cate_type';	

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
    protected $fillable = [ 'name', 'slug', 'description', 'display_order', 'meta_id', 'status'];

    public function cateParents()
    {
        return $this->hasMany('App\Models\CateParent', 'type_id');
    }  

}
