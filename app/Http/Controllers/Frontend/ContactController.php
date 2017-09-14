<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Articles;
use App\Models\BaoGia;
use App\Models\Settings;

use Helper, File, Session, Auth, Mail;

class ContactController extends Controller
{ 
   
    public function store(Request $request)
    {
       

        $dataArr = $request->all();
        
        $this->validate($request,[                       
            'email' => 'email|required',
            'full_name' => 'required',
            'content' => 'required',
            'phone' => 'required'         
        ],
        [            
            'full_name.required' => 'Bạn chưa nhập họ và tên.',
            'email.required' => 'Bạn chưa nhập email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'phone.required' => 'Bạn chưa nhập số điện thoại.',
            'content.required' => 'Bạn chưa nhập nội dung.'            
        ]);       
         $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $rs = Contact::create($dataArr);
        Mail::send('frontend.contact.email',
            [                   
                'dataArr'             => $rs
            ],
            function($message) use ($dataArr, $settingArr) {                    
                $message->subject('Khách hàng gửi liên hệ');
                $message->to([$settingArr['admin_email']]);
                $message->from('web.0917492306@gmail.com', 'Admin Website Houseland');
                $message->sender('web.0917492306@gmail.com', 'Admin Website Houseland');
        });
        Session::flash('message', 'Gửi liên hệ thành công.');

        return redirect()->route('contact');
    }
    public function storeThiCong(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[ 
            'full_name' => 'required',
            'address' => 'required',            
            'phone' => 'required',         
            'email' => 'email|required',
            'kien_truc_thi_cong' => 'required',
            'loai_kien_truc_thi_cong' => 'required',
            'loai_kien_truc_thi_cong' => 'required',
            'hinh_thuc_thi_cong' => 'required',
            'tong_dien_tich' => 'required',
            'so_tang' => 'required',
            'chieu_dai' => 'required',
            'chieu_rong' => 'required',
        ]);       
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $detail = Articles::find($dataArr['id'] );
        $dataArr['type'] = 2;
        $rs = BaoGia::create($dataArr);
        if($rs->id){
            Mail::send('frontend.services.email',
                [                   
                    'dataArr'             => $rs
                ],
                function($message) use ($dataArr, $settingArr) {                    
                    $message->subject('Khách hàng yêu cầu báo giá: Thi công xây dựng');
                    $message->to([$settingArr['admin_email']]);
                    $message->from('web.0917492306@gmail.com', 'Admin Website Houseland');
                    $message->sender('web.0917492306@gmail.com', 'Admin Website Houseland');
            });
        }
        Session::flash('message', 'Gửi yêu cầu báo giá thành công.');

        return redirect()->route('services-detail', [ $detail->slug, $detail->id ]);
    }
    public function storeThietKe(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[ 
            'full_name' => 'required',                   
            'phone' => 'required',         
            'email' => 'email|required',
            'kien_truc_thiet_ke' => 'required',
            'hinh_thuc_kien_truc' => 'required',
            'so_tang_thiet_ke' => 'required',
            'mat_tien' => 'required',           
            'chieu_dai' => 'required',
            'chieu_rong' => 'required',
        ]);      
        $settingArr = Settings::whereRaw('1')->lists('value', 'name'); 
        $detail = Articles::find($dataArr['id'] );
        $dataArr['type'] = 1;
        $rs = BaoGia::create($dataArr);
        if($rs->id){
            Mail::send('frontend.services.email',
                [                   
                    'dataArr'             => $rs
                ],
                function($message) use ($dataArr, $settingArr) {                    
                    $message->subject('Khách hàng yêu cầu báo giá: thiết kế kiến trúc');
                    $message->to([$settingArr['admin_email']]);
                    $message->from('web.0917492306@gmail.com', 'Admin Website Houseland');
                    $message->sender('web.0917492306@gmail.com', 'Admin Website Houseland');
            });
        }
        Session::flash('message', 'Gửi yêu cầu báo giá thành công.');

        return redirect()->route('services-detail', [ $detail->slug, $detail->id ]);
    }
    
}
