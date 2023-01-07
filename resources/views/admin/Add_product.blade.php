@extends('Admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Sản Phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data"">
                                {{ csrf_field() }} <!-- tự động tạo ra 1 cái input hidden token để bảo mật hệ thống -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                    <input type="text" data-validation="length" data-validation-length="min3"
                                    data-validation-error-msg="vui lòng nhập ít nhất 10 ký tự" name ="product_name" class="form-control"
                                     id="exampleInputEmail1" placeholder="Enter email" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="text" data-validation="number"
                                    data-validation-error-msg="vui lòng nhập số tiền" name ="product_price" class="form-control" id="exampleInputEmail1" placeholder="nhập giá" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng tồn kho</label>
                                    <input type="text" data-validation="number"
                                    data-validation-error-msg="vui lòng nhập số lượng" name ="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="nhập số lượng" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Xuất xứ</label>
                                    <textarea style="Resize: none" rows ="3" name = "product_origin" class="form-control " 
                                    placeholder="Xuất xứ" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name ="product_image" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Enter email" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="Resize: none" rows ="6" name = "product_desc" class="form-control " 
                                    placeholder="Mô Tả Sản Phẩm" required=""></textarea>
                                </div>
                                <div class="form-group" required="">
                                    <label for="exampleInputPassword1">Nội dung</label>
                                    <textarea style="Resize: none" rows ="6" name = "product_content" class="form-control" 
                                    placeholder="Nội Dung Sản Phẩm" ></textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($category_product as $key => $cate) <!-- lấy biến $category_product từ ProductController qua --> 
                                            <option value = "{{$cate->category_id}}">{{$cate->category_name}}</option> <!-- lấy tên từ bản danh mục  -->
                                        @endforeach
                                    </select>
                        
                                <label for="exampleInputEmail1">Loại hàng</label>
                                    <select name="product_material" class="form-control input-sm m-bot15">
                                         @foreach($material_product as $key => $mate) <!-- lấy biến $material_product từ ProductController qua --> 
                                            <option value = "{{$mate->material_id}}">{{$mate->material_name}}</option>
                                        @endforeach
                                    </select>

                                <label for="exampleInputEmail1">Hiển Tthị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value = "1">Ẩn</option>
                                        <option value = "0">Hiển thị</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection          