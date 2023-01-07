<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Login;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite


session_start();

class AdminController extends Controller
{
   // Sau đó mở controller LoginController copy cái này vào 
public function login_google(){
        return Socialite::driver('google')->redirect();
   }
public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        return redirect('/admin_managers')->with('message', 'Đăng nhập Admin thành công');
      
       
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){

            return $authUser;
        }
      
        $caovi = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = Login::where('admin_email',$users->email)->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $users->name,
                    'admin_email' => $users->email,
                    'admin_password' => '',
                    'admin_phone' => '',
                    'admin_status' => 1
                ]);
            }
        $caovi->login()->associate($orang);
        $caovi->save();

        $account_name = Login::where('admin_id',$caovi->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        return redirect('/admin_managers')->with('message', 'Đăng nhập Admin thành công');


    }



    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('login_nomal',true);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/admin_managers')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $vi = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => ''

                ]);
            }
            $vi->login()->associate($orang);
            $vi->save();

            $account_name = Login::where('admin_id',$vi->user)->first();

            Session::put('admin_name',$account_name->admin_name);
             Session::put('admin_id',$account_name->admin_id);
            return redirect('/admin_managers')->with('message', 'Đăng nhập Admin thành công');
        } 
    }


    public function AuthLogin(){
            $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin_managers');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
        return view('Admin_login');
    }

    public function admin_managers(){
        $this->AuthLogin();
        return view('Admin.admin_managers');
    }

    public function dashboard(Request $request){
        $data = $request->all();
        $email = $data['admin_email'];
        $password = $data['admin_password'];//ko có md5
        $login = Login::where('admin_email',$email)->where('admin_password',$password)->first(); //first() có nghĩa là lấy ra một sản phẩm thôi 
        if($login){
        $login_count = $login->count();
        //Ctrl + /
        // echo '<pre>';
        // print_r($result);//in thử ra dữ liệu data
        // echo '<pre>'; 
        if($login_count>0){
            Session::put('admin_name',$login->admin_name);//lấy admin_name từ biến result
            Session::put('admin_id',$login->admin_id);//lấy admin_id từ biến result   
            return Redirect::to('/admin_managers');//đưa 2 admin_name và admin_id và gán vào trang /admin_managers
            //return view là trả về một trang nhưng ko kèm thông bào,redirect là trả về một prefix url của trang và kèm theo thông báo
        }

      }else{
            Session::put('message','Mật khẩu hoặc tài khoản bị sai');
            return Redirect::to('/admin');
    }

/*         $email = $request->admin_email;
        $password = ($request->admin_password);//ko có md5

        $result = DB::table('tbl_admin')
        ->where('admin_email',$email)
        ->where('admin_password',$password)->first();//first() có nghĩa là lấy ra một sản phẩm thôi 
        //Ctrl + /
        // echo '<pre>';
        // print_r($result);//in thử ra dữ liệu data
        // echo '<pre>'; 
        if($result){
            Session::put('admin_name',$result->admin_name);//lấy admin_name từ biến result
            Session::put('admin_id',$result->admin_id);//lấy admin_id từ biến result   
            return Redirect::to('/admin_managers');//đưa 2 admin_name và admin_id và gán vào trang /admin_managers
            //return view là trả về một trang nhưng ko kèm thông bào,redirect là trả về một prefix url của trang và kèm theo thông báo
        }else{
            Session::put('message','Mật khẩu hoặc tài khoản bị sai');
            return Redirect::to('/admin');
        } */
    }

    public function log_out(){
        $this->AuthLogin();
        Session::put('admin_name',null);//lấy admin_name từ biến result 
        Session::put('admin_id',null);//lấy admin_id từ biến result 
        return Redirect::to('/admin');
    }
}
