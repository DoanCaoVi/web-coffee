<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function AuthLogin(){
            $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin_managers');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function confirm_order(Request $request){
        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;
        $checkout_code = substr(md5(microtime()),rand(0,26),5);
        //tự dộng tạo ra tự động 5 chữ số ngẩu nhiên cho vào biến $checkout_code
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        $order->created_at = now();
        $order->save();



        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon = $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }
        }
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
    }
    public function del_fee(){
        Session::forget('fee');
        return Redirect()->back();
    }
    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])
            ->where('fee_maqh',$data['maqh'])
            ->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
            if($count_feeship>0){
                    foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{
                        Session::put('fee',30000);
                        Session::save();

                }
            } 
        }
    }
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                $output.='<option value>~~~~~~ chọn Quận Huyện ~~~~~~</option>';
                foreach($select_province as $key => $province){
                $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }
            }else{

                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option value>~~~~~~ chọn xã phường ~~~~~~</option>';
                foreach($select_wards as $key => $wards){
                $output.= '<option value="'.$wards->xaid.'">'.$wards->name_xaphuongthitran.'</option>';
                 }
            }
            
        }
        echo $output; 
    }
    public function delete_order($order_id){
/*         $coupon = Coupon::find($order_id);
        $coupon->delete();
         Session::put('message','Xoá Thành Công');
        return redirect::to(''); */
    }

    public function login_checkout(Request $request){
         //thẻ seo----
         $meta_desc = "chuyên bán đồ nội thất, đồ dùng trong nhà, hay trang trí nhà cửa";
         $meta_keywords = "đồ nội thất, đồ trong nhà";
         $meta_title = "Home | Trang bán đồ nội thất";
         $url_canonical = $request->url();
        //thẻ seo----  
        $all_slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->get();
        $category_product = DB::table('tbl_category_product')
        ->where('category_status','0')->orderby('category_id','desc')->get();//lấy ra hết tất cả các danh mục
        $material_product = DB::table('tbl_material')
        ->where('material_status','0')->orderby('material_id','desc')->get();
        return view('pages.checkout.login_checkout')
        ->with('category',$category_product)
        ->with('material',$material_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);
    }
    public function add_customer(Request $request){

        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);//md5 mã hoá mật khẩu
        $data['customer_phone'] = $request->customer_phone;
        //insertGetId()--lấy lun giữ liệu vừa mới insert
        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        //$customer_id-- chứa tất cả các giử liệu vừa mói insert    
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect::to('/checkout');
    }
    public function checkout(Request $request){
                 //thẻ seo----
                 $meta_desc = "chuyên bán đồ nội thất, đồ dùng trong nhà, hay trang trí nhà cửa";
                 $meta_keywords = "đồ nội thất, đồ trong nhà";
                 $meta_title = "Home | Trang bán đồ nội thất";
                 $url_canonical = $request->url();
                //thẻ seo----  
        $all_slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->get();
        $category_product = DB::table('tbl_category_product')
        ->where('category_status','0')->orderby('category_id','desc')->get();//lấy ra hết tất cả các danh mục
        $material_product = DB::table('tbl_material')
        ->where('material_status','0')->orderby('material_id','desc')->get();
        $city = City::orderby('matp','ASC')->get();
        return view('pages.checkout.show_checkout')
        ->with('category',$category_product)
        ->with('material',$material_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('city',$city)
        ->with('all_slider',$all_slider);
    }

    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        //insertGetId()--lấy lun giữ liệu vừa mới insert
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        //$shipping_id-- chứa tất cả các giử liệu vừa mói insert    
        Session::put('shipping_id',$shipping_id);
        return Redirect::to('/payment');
    }
    public function payment(Request $request){
       //thẻ seo----
            $meta_desc = "chuyên bán đồ nội thất, đồ dùng trong nhà, hay trang trí nhà cửa";
            $meta_keywords = "đồ nội thất, đồ trong nhà";
            $meta_title = "Home | Trang bán đồ nội thất";
            $url_canonical = $request->url();
         //thẻ seo----  
         $all_slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->get();
        $category_product = DB::table('tbl_category_product')
        ->where('category_status','0')->orderby('category_id','desc')->get();//lấy ra hết tất cả các danh mục
        $material_product = DB::table('tbl_material')
        ->where('material_status','0')->orderby('material_id','desc')->get();
        return view('pages.checkout.payment')
        ->with('category',$category_product)
        ->with('material',$material_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);
    }

    public function logout_checkout(){
        Session::flush();

        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);//md5 mã hoá mật khẩu

        $result = DB::table('tbl_customers')
        ->where('customer_email',$email)
        ->where('customer_password',$password)->first();
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }
        Session::put('customer_id',$result->customer_id);
    }
    public function order_place(Request $request){
        //insert payment method
            //thẻ seo----
            $meta_desc = "chuyên bán đồ nội thất, đồ dùng trong nhà, hay trang trí nhà cửa";
            $meta_keywords = "đồ nội thất, đồ trong nhà";
            $meta_title = "Home | Trang bán đồ nội thất";
            $url_canonical = $request->url();
           //thẻ seo----  
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý......';
        //insertGetId()--lấy lun giữ liệu vừa mới insert
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        //$payment_id-- chứa tất cả các giử liệu vừa mói insert 

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý......';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        
        //insert ordert_details
        $content = Cart::content();
        foreach($content as $value_content){//nếu bỏ ngoài vòng lặp này mặc định nó sẽ lấy sản phẩm cuối cùng
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $value_content->id;
            $order_d_data['product_name'] = $value_content->name;
            $order_d_data['product_price'] = $value_content->price;
            $order_d_data['product_sales_quantity'] = $value_content->qty;
            DB::table('tbl_order_details')->insertGetId($order_d_data);
        }
        if($data['payment_method']==1){
            echo 'bạn đã đặt hàng';
        }else{//thanh toán bằng tiền mặt
            Cart::destroy();
            $category_product = DB::table('tbl_category_product')
            ->where('category_status','0')->orderby('category_id','desc')->get();//lấy ra hết tất cả các danh mục
            $material_product = DB::table('tbl_material')
            ->where('material_status','0')->orderby('material_id','desc')->get();
            return view('pages.checkout.handcash')
            ->with('category',$category_product)
            ->with('material',$material_product)
            ->with('meta_desc',$meta_desc)
            ->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)
            ->with('url_canonical',$url_canonical);
        }

    }
    public function manage_order(){
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_customers.customer_id','=','tbl_order.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();//join() có nghĩa là cho hai bảng giao nhau với 1 số điều điện //->orderby('tbl_product.product_id','desc')->get();/* nghĩa là sắp xếp theo product_id */

        $manager_order = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }
    public function view_order($orderId){
        $this->AuthLogin();
      
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_customers.customer_id','=','tbl_order.customer_id')
        ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')->first();
        //tbl_order.*','tbl_customers.* có nghĩa là chọn tất cả 
        //join() có nghĩa là cho hai bảng giao nhau với 1 số điều điện 
        //->orderby('tbl_product.product_id','desc')->get();/* nghĩa là sắp xếp theo product_id */
        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')
        ->with('manager.view_order',$manager_order_by_id);//trả về như foreach
    }
}
