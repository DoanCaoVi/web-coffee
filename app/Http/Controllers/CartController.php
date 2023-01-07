<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Coupon;
use Cart;
use App\Models\Slider;
session_start();


class CartController extends Controller
{
    

    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if($coupon){
            $cout_coupon = $coupon->count();
            if($cout_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                            Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                        Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công ^___^');
            }
            
        }else{
            return redirect()->back()->with('message','Thêm mã giảm giá Không đúng >__<');
        }
        
    }
    public function show_cart_ajax(Request $request){
                    //thẻ seo----
        $meta_desc = "chuyên bán đồ nội thất, đồ dùng trong nhà, hay trang trí nhà cửa";
            $meta_keywords = "đồ nội thất, đồ trong nhà";
         $meta_title = "Home | Trang bán đồ nội thất";
           $url_canonical = $request->url();
                    //thẻ seo----
           $all_slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->get();       
            $category_product = DB::table('tbl_category_product')
            ->where('category_status','0')
            ->orderby('category_id','desc')->get();//lấy ra hết tất cả các danh mục
            $material_product = DB::table('tbl_material')
            ->where('material_status','0')
            ->orderby('material_id','desc')->get();//lấy ra hết tất cả các chất liệu
            $all_product = DB::table('tbl_product')
            ->where('product_status','0')
            ->orderby('product_id','desc')
            ->limit(10)->get();
            return view('pages.giohang.cart_ajax')
            ->with('category',$category_product)
            ->with('material',$material_product)
            ->with('all_product',$all_product)
            ->with('meta_desc',$meta_desc)
            ->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)
            ->with('url_canonical',$url_canonical)
            ->with('all_slider',$all_slider);//trong laravel dấu . như dấu /
         }

    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){ //kiểm tra xem có tồn tại get cart ko
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id'] == $data['cart_product_id']){//đã sai từng ghi cart_product_id
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
        }
        Session::put('cart',$cart);
        Session::save();
    }

    public function xoa_san_pham($session_id){
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','xoá sản phẩm thành công');
        }else{
            return redirect()->back()->with('message','xoá sản phẩm thất bại');
        }
    }

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = session::get('cart');
        if($cart==true){
            foreach($data['cart_qty'] as $key =>$qty){
                foreach($cart as $session => $val){
                    if($val['session_id']==$key){
                        $cart[$session]['product_qty'] =$qty;
                    }
                }
            }
                Session::put('cart',$cart);
                return redirect()->back()->with('message','cập nhật sản phẩm thành công');
            }else{
                return redirect()->back()->with('message','cập nhật sản phẩm thất bại');
            }
    }
    public function delete_all(){
        $cart =Session::get('cart');
        if($cart==true){
            Session::forget('cart');
            return redirect()->back()->with('message','Xoá thành công!!');
        }
    }
    public function save_cart(Request $request){
        $productID = $request->product_id_hidden;//lấy ra biến product_id_hidden dòng 52 trong trang show_details_product.blade.php
        $quantity = $request->qty;//lấy ra biến qty(số lượng) dòng 51 trong trang show_details_product.blade.php
        
        $product_info = DB::table('tbl_product')->where('product_id',$productID)->first();//lấy ra hết tất cả các id sản phẩm
        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        //lấy ra các trường trong cơ sở dữ liệu
        $data['id'] = $product_info->product_id;//product_id phải lấy đúng trường trên cơ sở dữ liệu
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        
        // echo '<pre>';
        // print_r($data);
        // echo '<pre>';
        return redirect::to('/xem-gio-hang');
          //Cart::destroy();
    }

    public function show_cart(Request $request){

                //thẻ seo----
                $meta_desc = "chuyên bán đồ nội thất, đồ dùng trong nhà, hay trang trí nhà cửa";
                $meta_keywords = "đồ nội thất, đồ trong nhà";
                $meta_title = "Home | Trang bán đồ nội thất";
                $url_canonical = $request->url();
                //thẻ seo----
                
        $category_product = DB::table('tbl_category_product')
        ->where('category_status','0')
        ->orderby('category_id','desc')->get();//lấy ra hết tất cả các danh mục
        $material_product = DB::table('tbl_material')
        ->where('material_status','0')
        ->orderby('material_id','desc')->get();//lấy ra hết tất cả các chất liệu

        return view('pages.giohang.show_cart')
        ->with('category',$category_product)
        ->with('material',$material_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);//trong laravel dấu . như dấu /
    }

    public function delete_to_cart($rowId){
        Cart::update($rowId,0);//cập nhật sản phẩm bằng 0 dựa vào rowId 
        return redirect::to('/xem-gio-hang');
    }

    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty =$request->quantity_cart;
        Cart::update($rowId,$qty);//cập nhật sản phẩm bằng biến $qty(số lượng) dựa vào rowId 
        return redirect::to('/xem-gio-hang');
    }
}
