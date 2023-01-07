@extends('Admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập Nhật Danh Mục Sản Phẩm
                        </header>
                        <?php
                                $message = Session::get('message');//lấy cái key message bên routes trong web.php qua và hiển thị nội dung của nó
                                if($message){
                                    echo '<span class = "text-alert">',$message,'</span>';
                                    Session::put('message', null);
                                }
                           ?>

                        <div class="panel-body">
                            @foreach($edit_category_product as $key =>$edit_value) 
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                                {{ csrf_field() }} <!-- tự động tạo ra 1 cái input hidden token để bảo mật hệ thống -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                                    <input type="text" value = "{{$edit_value->category_name}}" name ="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Danh Mục</label>
                                    <textarea style="Resize: none" rows ="6" name = "category_product_desc" class="form-control" id="ckeditor4">{{$edit_value->category_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ khoá Danh Mục</label>
                                    <textarea style="Resize: none" rows ="6" 
                                    name = "category_product_keywords" class="form-control" id="ckeditor9" >{{$edit_value->meta_keywords}}</textarea>
                                </div>
                                <div class="form-group">

                                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật danh mục</button>
                            </form>
                            </div>
                                @endforeach
                        </div>
                    </section>

            </div>

@endsection          