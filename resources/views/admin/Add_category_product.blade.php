@extends('Admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Danh Mục Sản Phẩm
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                {{ csrf_field() }} <!-- tự động tạo ra 1 cái input hidden token để bảo mật hệ thống -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                                    <input type="text" 
                                    name ="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Danh Mục</label>
                                    <textarea style="Resize: none" rows ="6" 
                                    name = "category_product_desc" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ khoá Danh Mục</label>
                                    <textarea style="Resize: none" rows ="6" 
                                    name = "category_product_keywords" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Hiển Thị</label>
                                    <select name="category_product_status" class="form-control input-sm m-bot15">
                                        <option value = "1">Ẩn</option>
                                        <option value = "0">Hiển Thị</option>
                                    </select>
                                </div>

                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection          