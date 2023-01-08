<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//fontend

Route::get('/','HomeController@index');//sử dụng hàm trong controller
Route::get('/trang-chu','HomeController@index');//sử dụng hàm trong controller 
Route::post('/tim-kiem','HomeController@search');

//send mail
Route::get('/send-mail','HomeController@send_mail');
//facebook
Route::get('/login-facebook','AdminController@login_facebook');
Route::get('/admin/callback','AdminController@callback_facebook');
//google
Route::get('/login-google','AdminController@login_google');
Route::get('/google/callback','AdminController@callback_google');


//danh mục sản phẩm trang chủ-->show tất cả danh mục có liên quan
Route::get('/danh-muc/{category_id}','categoryProduct@show_category_home');//sử dụng hàm trong controller
//chất liệu trang trủ-->show tất cả chất liệu có liên quan
Route::get('/chat-lieu/{product_id}','MaterialProduct@show_material_home');//sử dụng hàm trong controller  
//chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{material_id}','ProductController@details_product');//sử dụng hàm trong controller
//backend
Route::get('/admin','AdminController@index');//sử dụng hàm trong controller
Route::get('/admin_managers','AdminController@admin_managers');//sử dụng hàm trong controller 
Route::get('/logout','AdminController@log_out');//sử dụng hàm trong controller 
Route::post('/admin-dashboard','AdminController@dashboard');//sử dụng hàm trong controller

//category product
Route::get('/Add-category-product','categoryProduct@add_category_product');//sử dụng hàm trong controller 
Route::get('/edit-category-product/{category_product_id}','categoryProduct@edit_category_product');//sử dụng hàm trong controller //truyền category_product_id hàm cần sửa
Route::get('/delete-category-product/{category_product_id}','categoryProduct@delete_category_product');//truyền category_product_id hàm cần xoá
Route::get('/update-category-product/{category_product_id}','categoryProduct@update_category_product');
Route::get('/All-category-product','categoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}','categoryProduct@unactive_category_product');//truyền vô 1 biến tự đặt tên
Route::get('/active-category-product/{category_product_id}','categoryProduct@active_category_product');//truyền vô 1 biến tự đặt tên

Route::post('/save-category-product','categoryProduct@save_category_product');//sử dụng hàm trong controller 
Route::post('/update-category-product/{category_product_id}','categoryProduct@update_category_product');

/* import excel */
Route::post('/import-csv','CategoryProduct@import_csv');
/* export excel */ 
Route::post('/export-csv','CategoryProduct@export_csv');

//Material product
Route::get('/Add-material-product','MaterialProduct@add_material_product');//sử dụng hàm trong controller 
Route::get('/edit-material-product/{material_product_id}','MaterialProduct@edit_material_product');//sử dụng hàm trong controller //truyền material_product_id hàm cần sửa
Route::get('/delete-material-product/{material_product_id}','MaterialProduct@delete_material_product');//truyền material_product_id hàm cần xoá
Route::get('/update-material-product/{material_product_id}','MaterialProduct@update_material_product');
Route::get('/All-material-product','MaterialProduct@all_material_product');

Route::get('/unactive-material-product/{material_product_id}','MaterialProduct@unactive_material_product');//truyền vô 1 biến tự đặt tên
Route::get('/active-material-product/{material_product_id}','MaterialProduct@active_material_product');//truyền vô 1 biến tự đặt tên

Route::post('/save-material-product','MaterialProduct@save_material_product');//sử dụng hàm trong controller 
Route::post('/update-material-product/{material_product_id}','MaterialProduct@update_material_product');

//Product
Route::get('/Add-product','ProductController@add_product');//sử dụng hàm trong controller 
Route::get('/edit-product/{product_id}','ProductController@edit_product');//sử dụng hàm trong controller //truyền product_id hàm cần sửa
Route::get('/delete-product/{product_id}','ProductController@delete_product');//truyền product_id hàm cần xoá
Route::get('/update-product/{product_id}','ProductController@update_product');
Route::get('/All-product','ProductController@all_product');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');//truyền vô 1 biến tự đặt tên
Route::get('/active-product/{product_id}','ProductController@active_product');//truyền vô 1 biến tự đặt tên

Route::post('/save-product','ProductController@save_product');//sử dụng hàm trong controller 
Route::post('/update-product/{product_id}','ProductController@update_product');

Route::post('/import-product','ProductController@import_product');
/* export excel */ 
Route::post('/export-product','ProductController@export_product');

//giỏ hàng
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/update-cart','CartController@update_cart');
Route::post('/luu-gio-hang','CartController@save_cart');
Route::post('/add-cart-ajax ','CartController@add_cart_ajax');
Route::get('/xem-gio-hang','CartController@show_cart');
Route::post('/show-cart-ajax','CartController@show_cart_ajax');
Route::get('/show-cart-ajax','CartController@show_cart_ajax');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::get('/xoa-san-pham/{session_id}','CartController@xoa_san_pham');
Route::get('/delete-all','CartController@delete_all');

//coupon(giảm giá)
Route::post('/check-coupon','CartController@check_coupon');
Route::get('/insert-coupon','CouponController@insert_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::post('/insert-coupon-code','CouponController@insert_coupon_code');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');


//check-out
Route::get('/del-fee','CheckoutController@del_fee');
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::get('/checkout','CheckoutController@checkout');
Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/login-customer','CheckoutController@login_customer');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');
Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::post('/calculate-fee','CheckoutController@calculate_fee');

Route::post('/confirm-order','CheckoutController@confirm_order');



//order
Route::get('/manage-order','OrderController@manage_order');
Route::get('/print-order/{checkout_code}','OrderController@print_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::get('/delete-order/{order_code}','OrderController@delete_order');

Route::post('/update-order-qty','OrderController@update_order_qty');
//cập nhật số lượng của đơn hàng
Route::post('/update-qty','OrderController@update_qty');
/* export excel */ 
Route::post('/export-orderdetails','OrderController@export_orderdetails');
/* Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/view-order/{orderId}','CheckoutController@view_order');
Route::get('/delete-order/{order_Id}','CheckoutController@delete_order'); */

//delivery
Route::get('/delivery','DeliveryController@delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');


//Banner
Route::get('/manage-slider','SliderController@manage_slider');
Route::get('/add-slider','SliderController@add_slider');
Route::post('/insert-slider','SliderController@insert_slider');
Route::get('/unactive-slider/{slider_id}','SliderController@unactive_slider');
Route::get('/active-slider/{slider_id}','SliderController@active_slider');
//fontend
/* Route::get('/', function () {
    return view('layout');// thay đổi tên cho welcome.blade.php
});

Route::get('/trang-chu', function () {
    return view('layout');// thay đổi tên cho welcome.blade.php
});

//backend
Route::get('/admin', function () {
    return view('Admin_login');// thay đổi tên cho Admin_login.blade.php
});

Route::get('/admin_managers', function () {
    return view('Admin_layout');// thay đổi tên cho Admin_layout.blade.php
});

Route::get('/logout', function () {//phương thức post lấy cái admin đăng nhập
    return view('admin_login');// thay đổi tên cho Admin_layout.blade.php
});

Route::post('/dashboard', function () {//phương thức post lấy cái admin đăng nhập
    return view('Admin_layout');// thay đổi tên cho Admin_layout.blade.php
}); */


