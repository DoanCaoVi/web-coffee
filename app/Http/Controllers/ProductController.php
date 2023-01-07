<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
use App\Imports\ExcelImports;
use App\Exports\ExportsProduct;

use Excel;
use App\Models\Product;
session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin_managers');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){//tên hàm gạch dưới
        $this->AuthLogin();
        $category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();//lấy ra hết tất cả các danh mục
        $material_product = DB::table('tbl_material')->orderby('material_id','desc')->get();//lấy ra hết tất cả các chất liệu
        return view('admin.add_product')->with('category_product',$category_product)->with('material_product',$material_product);

    }
    public function all_product(){//tên hàm gạch dưới
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_material','tbl_material.material_id','=','tbl_product.material_id')
        ->orderby('tbl_product.product_id','desc')->get();//join() có nghĩa là cho hai bảng giao nhau với 1 số điều điện //->orderby('tbl_product.product_id','desc')->get();/* nghĩa là sắp xếp theo product_id */
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    public function save_product(Request $request){/* truyền tham số vào là một biến $request(yêu cầu) */
        $this->AuthLogin();
        $data = array();//cho biến bằng 1 chuổi và lưu dữ liệu
        $data ['product_name'] = $request->product_name;  /* $data ['tên trường trong cơ sở dữ liệu'] = $request->tên name trong thẻ input(tự đặt); */
        $data ['product_price'] = $request->product_price;
        $data ['product_quantity'] = $request->product_quantity;
        $data ['product_desc'] = $request->product_desc;
        $data ['product_content'] = $request->product_content;
        $data ['category_id'] = $request->product_cate;//tên name product_cate trong thẻ
        $data ['material_id'] = $request->product_material;
        $data ['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');// thường bị lổi hoặc ko thêm ảnh được do ko thêm enctype="multipart/form-data" vào form
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();//hàm getClientOriginalName() lấy tên của ảnh mà mình đặt
            $name_image = current(explode(".", $get_name_image));//hàm explode phân tách (anh-vi.jpg) thành anh-vi và jpg , hàm current sẽ lấy giá trị đầu tiên, tức là lấy tên anh-vi 
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); // hàm getClientOriginalExtension() lấy đuôi mở rộng của hình ảnh như: jpg,png,jpeg,...
            //$new_image = rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image ->move('public/uploads/product',$new_image);
            $data ['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);//vào cơ sở dữ liệu 'tbl_product' và dùng insert() để insert cột material_name,.... vào dữ liệu material_product_name,...
            Session::put('message','Thêm Sản Phẩm thành công');//tạo một session có tên là message để in ra thông báo
            return Redirect::to('Add-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);//vào cơ sở dữ liệu 'tbl_product' và dùng insert() để insert cột material_name,.... vào dữ liệu material_product_name,...
        Session::put('message','Thêm Sản Phẩm thành công');//tạo một session có tên là message để in ra thông báo
        return Redirect::to('Add-product');
/*      echo '<pre>';
        print_r($data); ing thử ra dữ liệu data
        echo '<pre>';  */
    }

    public function unactive_product($product_product_id){//truyền tham số vào
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_product_id)->update(['product_status'=>1]);
        Session::put('message','không kích hoạt sản phẩm');
        return Redirect::to('All-product');
    }

    public function active_product($product_product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_product_id)->update(['product_status'=>0]);
        Session::put('message','kích hoạt sản phẩm thành công');
        return Redirect::to('All-product');
    }

    public function edit_product($product_product_id){
        $this->AuthLogin();
        $category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $material_product = DB::table('tbl_material')->orderby('material_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_product_id)->get();//truy vấn vào cơ sở dữ liệu lấy ra product_id
        $manager_product = view('admin.edit_product')
        ->with('edit_product',$edit_product)//with trong đây có nghĩa là gửi kèm theo cái gì đó
        ->with('category_product',$category_product)
        ->with('material_product',$material_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);

    }
    public function update_product(Request $request, $product_product_id){
        $this->AuthLogin();
        $data = array();//cho biến bằng 1 chuổi và lưu dữ liệu
        $data ['product_name'] = $request->product_name;  /* $data ['tên trường trong cơ sở dữ liệu'] = $request->tên name trong thẻ input(tự đặt); */
        $data ['product_price'] = $request->product_price;
        $data ['product_quantity'] = $request->product_quantity;
        $data ['product_desc'] = $request->product_desc;
        $data ['product_content'] = $request->product_content;
        $data ['category_id'] = $request->product_cate;//tên name product_cate trong thẻ
        $data ['material_id'] = $request->product_material;
        $data ['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();//hàm getClientOriginalName() lấy tên của ảnh mà mình đặt
            $name_image = current(explode(".", $get_name_image));//hàm explode phân tách (anh-vi.jpg) thành anh-vi và jpg , hàm current sẽ lấy giá trị đầu tiên, tức là lấy tên anh-vi 
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); // hàm getClientOriginalExtension() lấy đuôi mở rộng của hình ảnh như: jpg,png,jpeg,...
            //$new_image = rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image ->move('public/uploads/product',$new_image);
            $data ['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_product_id)->update($data);//vào cơ sở dữ liệu 'tbl_product' và dùng insert() để insert cột material_name,.... vào dữ liệu material_product_name,...
            Session::put('message','Thêm Sản Phẩm thành công');//tạo một session có tên là message để in ra thông báo
            return Redirect::to('All-product');
        }
       DB::table('tbl_product')->where('product_id',$product_product_id)->update($data);//vào cơ sở dữ liệu 'tbl_product' và dùng update() để update cột product_name,.... vào dữ liệu product_name,...
       Session::put('message','Cập nhật Sản Phẩm thành công');
       return Redirect::to('All-product');
    }
    public function delete_product($product_product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_product_id)->delete();
        Session::put('message','Xoá Sản Phẩm thành công');
        return Redirect::to('All-product');
    }

    //End admin page
    public function details_product(Request $request, $product_id){
        $category_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();//lấy ra hết tất cả các danh mục
        $material_product = DB::table('tbl_material')->where('material_status','0')->orderby('material_id','desc')->get();
        //lấy ra tất cả chi tiết sàn phẩm bao gồm danh mục và chất liệu 
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')//lấy ra sản phẩm thuộc danh mục nào
        ->join('tbl_material','tbl_material.material_id','=','tbl_product.material_id')//lấy ra sản phẩm thuộc chất liệu nào
        ->where('tbl_product.product_id',$product_id)->get();//join() có nghĩa là cho hai bảng giao nhau(kết nối) với 1 số điều điện 
        $all_slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->get();
        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
            //thẻ seo----
            $meta_desc = $value->category_desc;
            $meta_keywords = $value->meta_keywords;
            $meta_title = $value->category_name;
            $url_canonical = $request->url();
            //thẻ seo----
        }

        
        //lấy ra tất cả các sản phẩm liên quan
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')//lấy ra sản phẩm thuộc danh mục nào
        ->join('tbl_material','tbl_material.material_id','=','tbl_product.material_id')//lấy ra sản phẩm thuộc chất liệu nào
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();//lấy ra tất cả các sản phẩm thuộc category_id
        //whereNoteIn() có nghĩa là trừ đi ra một trường mà mình ko muốn vd: lấy tất cả các sản phẩm liên quan đến 1 sản phẩm mà sẽ trừ đi chính nó
        //join() có nghĩa là cho hai bảng giao nhau(kết nối) với 1 số điều điện 
        ///* nghĩa là sắp xếp theo product_id */
        
        return view('pages.sanpham.show_details_product')
        ->with('category',$category_product)
        ->with('material',$material_product)
        ->with('product_details',$details_product)
        ->with('relate',$related_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);
    }

    public function import_product(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExportsProduct, $path);
        return back();

    }

    public function export_product(){
        return Excel::download(new ExportsProduct, 'product.xlsx');
    }
}
