<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;

use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Excel;
use App\Models\CategoryProductModel;
session_start();

class categoryProduct extends Controller
{   

    public function AuthLogin(){
            $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin_managers');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){//tên hàm gạch dưới
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product(){//tên hàm gạch dưới
        //$this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){/* truyền tham số vào là một biến $request(yêu cầu) */
        $this->AuthLogin();
        $data = array();//cho biến bằng 1 chuổi và lưu dữ liệu
        $data ['category_name'] = $request->category_product_name;
        $data ['meta_keywords'] = $request->category_product_keywords;  /* $data ['tên trường trong cơ sở dữ liệu'] = $request->tên name trong thẻ input(tự đặt); */
        $data ['meta_desc'] = $request->category_product_desc;
        $data ['category_desc'] = $request->category_product_desc;
        $data ['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);//vào cơ sở dữ liệu 'tbl_category_product' và dùng insert() để insert cột category_name,.... vào dữ liệu category_product_name,...
        Session::put('message','Thêm danh mục sản phẩm thành công');//tạo một session có tên là message để in ra thông báo
        return Redirect::to('Add-category-product');
    /*      echo '<pre>';
        print_r($data); ing thử ra dữ liệu data
        echo '<pre>';  */
    }

    public function unactive_category_product($category_product_id){//truyền tham số vào
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','không kích hoạt danh mục sản phẩm');
        return Redirect::to('All-category-product');
    }

    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('All-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();//truy vấn vào cơ sở dữ liệu lấy ra category_id
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);

    }
    public function update_category_product(Request $request, $category_product_id){
       $this->AuthLogin();
        $data = array();
       $data ['category_name'] = $request->category_product_name;
       $data ['meta_keywords'] = $request->category_product_keywords;  /* $data ['tên trường trong cơ sở dữ liệu'] = $request->tên name trong thẻ input(tự đặt); */
       $data ['category_desc'] = $request->category_product_desc;
       DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);//vào cơ sở dữ liệu 'tbl_category_product' và dùng update() để update cột category_name,.... vào dữ liệu category_product_name,...
       Session::put('message','Cập nhật  danh mục sản phẩm thành công');
       return Redirect::to('All-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xoá danh mục sản phẩm thành công');
        return Redirect::to('All-category-product');
    }
    //End fuction Admin Page xem danh mục sản phẩm
    public function show_category_home(Request $request, $category_id){
        $all_slider = Slider::orderBy('slider_id','DESC')->get();

        $category_product = DB::table('tbl_category_product')
        ->where('category_status','0')->orderby('category_id','desc')->get();//lấy ra hết tất cả các danh mục
        $material_product = DB::table('tbl_material')
        ->where('material_status','0')->orderby('material_id','desc')->get();
        
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();//get() để lấy
        foreach($category_product as $key => $val){
                            //thẻ seo----
         $meta_keywords = $val->meta_keywords;
         $meta_title = $val->category_name;
         $url_canonical = $request->url();
                //thẻ seo----
        }
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        
        return view('/pages.category.show_category')
        ->with('category',$category_product)
        ->with('material',$material_product)
        ->with('category_by_id',$category_by_id)
        ->with('category_name',$category_name)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);
    }

    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();

    }

    public function export_csv(){
        return Excel::download(new ExcelExports , 'category_product.xlsx');
    }
}
