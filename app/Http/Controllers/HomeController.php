<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use Session;
use App\Models\Slider;

use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function send_mail(){
        $to_name = "Vi Doan";
        $to_email = "jacklatazz123@gmail.com ";


        $data = array("name"=>"Mail từ tài khoản khách hàng","body"=> "Mail gửi về vấn đề hàng hoá" );

        Mail::send('pages.send_mail',$data, function($message) use ($to_name, $to_email){
            $message->to($to_email)->subject('gửi mail chơi thôi');//gửi mail với chủ đề
            $message->from($to_email, $to_name); 
        });
        return Redirect::to('/')->with('message','');
    }
    public function index(Request $request){
        //thẻ seo----
        $meta_desc = "Kho hàng thuộc quyền quản lý của quán";
        $meta_keywords = "Quản lý các vật liệu thiết yếu của quán";
        $meta_title = "Home coffe-Trang | Quản lý kho Hàng";
        $url_canonical = $request->url();
        //thẻ seo----

        $category_product = DB::table('tbl_category_product')
        ->where('category_status','0')->orderby('category_id','desc')->get();//lấy ra hết tất cả các danh mục
        $material_product = DB::table('tbl_material')
        ->where('material_status','0')->orderby('material_id','desc')->get();

        $all_product = DB::table('tbl_product')
        ->where('product_status','0')
        ->orderby('product_id','desc')
        ->limit(10)->get();
        return view('pages.home')
        ->with('category',$category_product)
        ->with('material',$material_product)
        ->with('all_product',$all_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);//cách 1

        // return view(pages.home')->with(compact('category_product','material_product','all_product'));//cách 2
    }
    public function search(Request $request){
                //thẻ seo----
                $meta_desc = "Kho hàng thuộc quyền quản lý của quán";
                $meta_keywords = "Quản lý các vật liệu thiết yếu của quán";
                $meta_title = "Home coffe-Trang | Quản lý kho Hàng";
                $url_canonical = $request->url();
                //thẻ seo----
        $keywords = $request->keywords_submit;
        $category_product = DB::table('tbl_category_product')
        ->where('category_status','0')->orderby('category_id','desc')->get();//lấy ra hết tất cả các danh mục
        $material_product = DB::table('tbl_material')
        ->where('material_status','0')->orderby('material_id','desc')->get();
        $all_slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->get();
        $search_product = DB::table('tbl_product')
        ->where('product_name','like','%' .$keywords. '%')->get();
        return view('pages.sanpham.search')
        ->with('category',$category_product)
        ->with('material',$material_product)
        ->with('search_product',$search_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);
    }
}
