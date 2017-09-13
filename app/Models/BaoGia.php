<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BaoGia extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bao_gia';

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
    protected $fillable = ['full_name', 
                            'phone', 
                            'email', 
                            'type', 
                            'kien_truc_thi_cong', 
                            'loai_kien_truc_thi_cong', 
                            'hinh_thuc_thi_cong', 
                            'kien_truc_thiet_ke', 
                            'hinh_thuc_kien_truc', 
                            'so_tang', 
                            'so_tang_thiet_ke',
                            'mat_tien', 
                            'tong_dien_tich', 
                            'chieu_dai', 
                            'chieu_rong', 
                            'address',
                            'notes', 
                            'chieu_dai', 
                            'chieu_rong', 
                            'address'];    
}
