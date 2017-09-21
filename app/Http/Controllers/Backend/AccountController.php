<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Mail;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\UserMod;
use Helper, File, Session, Auth;

class AccountController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {         
        if(Auth::user()->role < 3){
            return redirect()->route('product.index');
        }
        $role = $leader_id = 0;
        $role = Auth::user()->role;
        $query = Account::where('status', '>', 0);

        if( $role == 2){
            $leader_id = Auth::user()->id;
            $query->where('role',1);
                $query->join('user_mod', 'user_mod.user_id', '=', 'users.id')
                    ->where('user_mod.mod_id', $leader_id);
        }else{
            $role = $request->role ? $request->role : 0;
            if($role > 0){
                $query->where('role', $role);
            }
            $leader_id = $request->leader_id ? $request->leader_id : 0;
            if($leader_id > 0){
                $query->join('user_mod', 'user_mod.user_id', '=', 'users.id')
                    ->where('user_mod.mod_id', $leader_id);
            }
        }
        $items = $query->orderBy('id', 'desc')->get();
        $modList = Account::where(['role' => 2, 'status' => 1])->get();
        return view('backend.account.index', compact('items', 'role', 'leader_id', 'modList'));
    }
    public function create()
    {        
        if(Auth::user()->role < 3){
            return redirect()->route('product.index');
        }
        $modList = Account::where(['role' => 2, 'status' => 1])->get();
        
        return view('backend.account.create', compact('modList'));
    }
    public function changePass(){
        return view('backend.account.change-pass');   
    }

    public function storeNewPass(Request $request){
        $user_id = Auth::user()->id;
        $detail = Account::find($user_id);
        $old_pass = $request->old_pass;
        $new_pass = $request->new_pass;
        $new_pass_re = $request->new_pass_re;
        if( $old_pass == '' || $new_pass == "" || $new_pass_re == ""){
            return redirect()->back()->withErrors(["Chưa nhập đủ thông tin bắt buộc!"])->withInput();
        }
       
        if(!password_verify($old_pass, $detail->password)){
            return redirect()->back()->withErrors(["Nhập mật khẩu hiện tại không đúng!"])->withInput();
        }
        
        if($new_pass != $new_pass_re ){
            return redirect()->back()->withErrors("Xác nhận mật khẩu mới không đúng!")->withInput();   
        }

        $detail->password = Hash::make($new_pass);
        $detail->save();
        Session::flash('message', 'Đổi mật khẩu thành công');

        return redirect()->route('account.change-pass');

    }
    public function store(Request $request)
    {
       
        if(Auth::user()->role < 3){
            return redirect()->route('product.index');
        }
        $dataArr = $request->all();
         
        $this->validate($request,[
            'full_name' => 'required',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|digits_between:6,30',
            're_password' => 'required|same:password|digits_between:6,30',
            'role' => 'required'
        ],
        [
            'full_name.required' => 'Bạn chưa nhập họ tên',
            'email.required' => 'Bạn chưa nhập email',
            'email.unique' => 'Email đã được sử dụng.',
            'email.email' => 'Bạn nhập email không hợp lệ',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            're_password.required' => 'Bạn chưa nhập lại mật khẩu',
            're_password.digits_between' => 'Mật khẩu phải từ 6 đến 30 ký tự',
            're_password.same' => 'Mật khẩu nhập lại không giống',
            'password.digits_between' => 'Nhập lại mật khẩu phải từ 6 đến 30 ký tự',
            'role.required' => 'Bạn chưa chọn role'
        ]);       
        
        $tmpPassword = str_random(10);
                
        $dataArr['password'] = Hash::make($dataArr['password']);
        
        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;

        $rs = Account::create($dataArr);       
        /*
        if ( $rs->id > 0 ){
            Mail::send('backend.account.mail', ['full_name' => $request->full_name, 'password' => $tmpPassword, 'email' => $request->email], function ($message) use ($request) {
                $message->from( config('mail.username'), config('mail.name'));

                $message->to( $request->email, $request->full_name )->subject('Mật khẩu đăng nhập hệ thống');
            });   
        }*/

        Session::flash('message', 'Tạo mới thành công');

        return redirect()->route('account.index');
    }
    public function destroy($id)
    {
        if(Auth::user()->role < 3){
            return redirect()->route('product.index');
        }
        // delete
        $model = Account::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa thành công');
        return redirect()->route('account.index');
    }
    public function edit($id)
    {
        if(Auth::user()->role < 3){
            return redirect()->route('product.index');
        }
        $detail = Account::find($id);
        
        return view('backend.account.edit', compact( 'detail'));
    }
    public function update(Request $request)
    {
        if(Auth::user()->role < 3){
            return redirect()->route('product.index');
        }
        $dataArr = $request->all();
        
        $this->validate($request,[
            'full_name' => 'required',            
            'role' => 'required'
        ],
        [
            'full_name.required' => 'Bạn chưa nhập họ tên',            
            'role.required' => 'Bạn chưa chọn role'
        ]);      

        $model = Account::find($dataArr['id']);

        $dataArr['updated_user'] = Auth::user()->id;

        $model->update($dataArr);       

        Session::flash('message', 'Cập nhật thành công');

        return redirect()->route('account.index');
    }
    public function updateStatus(Request $request)
    {       
        if(Auth::user()->role < 3){
            return redirect()->route('product.index');
        }
        $model = Account::find( $request->id );

        
        $model->updated_user = Auth::user()->id;
        $model->status = $request->status;

        $model->save();
        $mess = $request->status == 1 ? "Mở khóa thành công" : "Khóa thành công";
        Session::flash('message', $mess);

        return redirect()->route('account.index');
    }
}
