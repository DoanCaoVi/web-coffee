@extends('Admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            cập Nhật Sản Phẩm
                        </header>
                        <div class="panel-body">

                            <?php
                                $message = Session::get('message');//lấy cái key message bên routes trong web.php qua và hiển thị nội dung của nó
                                if($message){
                                    echo '<span class = "text-alert">',$message,'</span>';
                                    Session::put('message', null);
                                }
                           ?>

                            <div class="position-center">
                                @foreach($edit_product as $key => $pro_pro) <!-- cho hàm foreach chạy để đổ dữ liệu vào  và lấy biến $edit_product gán cho biến $pro_pro để sử dụng-->
                                <form role="form" action="{{URL::to('/update-product/'.$pro_pro->product_id)}}" method="post" enctype="multipart/form-data"">
                                {{ csrf_field() }} <!-- tự động tạo ra 1 cái input hidden token để bảo mật hệ thống -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                    <input type="text" name ="product_name" class="form-control" 
                                    id="exampleInputEmail1" value="{{$pro_pro->product_name}}"> <!-- value="{{$pro_pro->product_name}} --> lấy ra tên sản phẩm -->
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="text" name ="product_price" class="form-control" 
                                    id="exampleInputEmail1" value="{{$pro_pro->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng tồn kho</label>
                                    <input type="text" data-validation="number" name ="product_quantity" class="form-control"
                                     id="exampleInputEmail1" value="{{$pro_pro->product_quantity}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Xuất xứ</label>
                                    <textarea style="Resize: none" rows ="3" name = "product_origin" class="form-control" 
                                    >{{$pro_pro->product_origin}}</textarea> <!-- gọi ở ngoài -->
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name ="product_image" class="form-control" 
                                    id="exampleInputEmail1" >
                                    <img src="{{URL::to('public/uploads/product/'.$pro_pro->product_image)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="Resize: none" rows ="6" name = "product_desc" class="form-control" 
                                    >{{$pro_pro->product_desc}}</textarea> <!-- gọi ở ngoài -->
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung</label>
                                    <textarea style="Resize: none" rows ="6" name = "product_content" class="form-control" 
                                    >{{$pro_pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($category_product as $key => $cate) <!-- lấy biến $category_product từ ProductController qua --> 
                                            @if($cate->category_id == $pro_pro->category_id)
                                            <option selected value = "{{$cate->category_id}}" >{{$cate->category_name}}</option> <!-- lấy tên từ bản danh mục  -->
                                            @else
                                            <option value = "{{$cate->category_id}}" >{{$cate->category_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                        
                                <label for="exampleInputEmail1">Loại hàng</label>
                                    <select name="product_material" class="form-control input-sm m-bot15">
                                         @foreach($material_product as $key => $mate) <!-- lấy biến $material_product từ ProductController qua --> 
                                         @if($mate->material_id == $pro_pro->material_id)
                                            <option selected value = "{{$mate->material_id}}" >{{$mate->material_name}}</option> <!-- lấy tên từ bản danh mục  -->
                                            @else
                                            <option value = "{{$mate->material_id}}" >{{$mate->material_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                <label for="exampleInputEmail1">Hiển thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value = "1">Ẩn</option>
                                        <option value = "0">Hiển Thị</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>

@endsection          