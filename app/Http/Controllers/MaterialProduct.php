<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Material;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Slider;
session_start();

class MaterialProduct extends Controller
{   
    public function AuthLogin(){
            $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin_managers');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_material_product(){//tên hàm gạch dưới
        $this->AuthLogin();
        return view('admin.add_material_product');
    }
    public function all_material_product(){//tên hàm gạch dưới
        $this->AuthLogin();
        //---------- Cách thông thường sử dụng controller ------------------
        // $all_material_product = DB::table('tbl_material')->get(); //static hướng đối tượng
        
        // ----------Cách sử dụng model------------------
        /* $all_material_product = Material::all();//lấy ra tất cả dữ liệu có trong table_Material */
        $all_material_product = Material::orderBy('material_id','DESC')->take(50)->get();//take() có nghĩa như limit() có thể lấy trong khoản giới hạn nhất định 
        //lấy ra tất cả dữ liệu có trong table_Material và sắp xếp theo chiều giảm dần theo material_id
        $manager_material_product = view('admin.all_material_product')->with('all_material_product',$all_material_product);
        return view('admin_layout')->with('admin.all_material_product',$manager_material_product);
    }
    public function save_material_product(Request $request){/* truyền tham số vào là một biến $request(yêu cầu) */
        $this->AuthLogin();
/*      ----------Cách thông thường sử dụng controller ------------------
       $data = array();//cho biến bằng 1 chuổi và lưu dữ liệu
        $data ['material_name'] = $request->material_product_name;  //$data ['tên trường trong cơ sở dữ liệu'] = $request->tên name trong thẻ input(tự đặt);
        $data ['material_desc'] = $request->material_product_desc;
        $data ['material_status'] = $request->material_product_status;

        DB::table('tbl_material')->insert($data); //vào cơ sở dữ liệu 'tbl_material_product' và dùng insert() để insert cột material_name,.... vào dữ liệu material_product_name,...
        ----------Cách thông thường sử dụng controller------------------
        */

        // ----------Cách sử dụng model------------------
        $data = $request->all();//lấy hết tất cả dữ liệu data
        $material = new Material();//lấy ra được class Material trong model
        $material->material_name = $data['material_product_name'];
        $material->material_desc = $data['material_product_desc'];
        $material->material_status = $data['material_product_status'];
        $material->save();//có nghĩa tương tự như cách thông tường

        Session::put('message','Thêm chất liệu thành công');//tạo một session có tên là message để in ra thông báo
        return Redirect::to('Add-material-product');
/*      echo '<pre>';
        print_r($data); ing thử ra dữ liệu data
        echo '<pre>';  */
    }

    public function unactive_material_product($material_product_id){//truyền tham số vào
        $this->AuthLogin();
        DB::table('tbl_material')->where('material_id',$material_product_id)->update(['material_status'=>1]);
        Session::put('message','không kích hoạt chất liệu sản phẩm');
        return Redirect::to('All-material-product');
    }

    public function active_material_product($material_product_id){
        $this->AuthLogin();
        DB::table('tbl_material')->where('material_id',$material_product_id)->update(['material_status'=>0]);
        Session::put('message','kích hoạt chất liệu sản phẩm thành công');
        return Redirect::to('All-material-product');
    }
    
    public function edit_material_product($material_product_id){
        $this->AuthLogin();
/*        ----------Cách thông thường sử dụng controller------------------
         $edit_material_product = DB::table('tbl_material')
        ->where('material_id',$material_product_id)->get();//truy vấn vào cơ sở dữ liệu lấy ra category_id */
        
        // ----------Cách sử dụng model------------------
        //(trong trường hợp này khỏi cần sử dụng foreach)
        $edit_material_product = Material::where('material_id',$material_product_id)->get();//tìm kiếm chất liệu dựa trên $material_product_id
        
        $manager_material_product = view('admin.edit_material_product')->with('edit_material_product',$edit_material_product);//with trong đây có nghĩa là gửi kèm theo cái gì đó
        return view('admin_layout')->with('admin.edit_material_product',$manager_material_product);

    }
    public function update_material_product(Request $request, $material_product_id){
       $this->AuthLogin();
       /*  ----------Cách thông thường sử dụng controller------------------
       $data = array();
       $data ['material_name'] = $request->material_product_name; // $data ['tên trường trong cơ sở dữ liệu'] = $request->tên name trong thẻ input(tự đặt);
       $data ['material_desc'] = $request->material_product_desc;
       DB::table('tbl_material')->where('material_id',$material_product_id)->update($data); */
       //vào cơ sở dữ liệu 'tbl_category_product' và dùng update() để update cột category_name,.... vào dữ liệu category_product_name,...
       //----------Cách thông thường sử dụng controller------------------

       // ----------Cách sử dụng model------------------
       $data = $request->all();//lấy hết tất cả dữ liệu data
       $material = Material::find($material_product_id);//lấy ra được class Material trong model
       $material->material_name = $data['material_product_name'];
       $material->material_desc = $data['material_product_desc'];
       $material->save();// có nghĩa tương tự như cách thông tường

       Session::put('message','Cập nhật chất liệu thành công');
       return Redirect::to('All-material-product');
    }
    public function delete_material_product($material_product_id){
        $this->AuthLogin();
        DB::table('tbl_material')->where('material_id',$material_product_id)->delete();
        Session::put('message','Xoá chất liệu thành công');
        return Redirect::to('All-material-product');
    }

     //End fuction Admin Page xem chất liệu sản phẩm
     public function show_material_home(Request $request, $material_id){
                         //thẻ seo----
                         $meta_desc = "chuyên bán đồ nội thất, đồ dùng trong nhà, hay trang trí nhà cửa";
                         $meta_keywords = "đồ nội thất, đồ trong nhà";
                         $meta_title = "Home | Trang bán đồ nội thất";
                         $url_canonical = $request->url();
                         //thẻ seo----
        $category_product = DB::table('tbl_category_product')
        ->where('category_status','0')->orderby('category_id','desc')->get();//lấy ra hết tất cả các danh mục
        $material_product = DB::table('tbl_material')
        ->where('material_status','0')->orderby('material_id','desc')->get();
        $all_slider = Slider::orderBy('slider_id','DESC')->get();
        $material_by_id = DB::table('tbl_product')
        ->join('tbl_material','tbl_product.material_id','=','tbl_material.material_id')->where('tbl_product.material_id',$material_id)->get();//get() để lấy
        $material_name = DB::table('tbl_material')
        ->where('tbl_material.material_id',$material_id)->limit(1)->get();

        return view('/pages.material.show_material')
        ->with('category',$category_product)
        ->with('material',$material_product)
        ->with('material_by_id',$material_by_id)
        ->with('material_name',$material_name)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);
    }
}
