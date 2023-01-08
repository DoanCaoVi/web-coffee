@extends('Admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật loại sản phẩm
                        </header>
                        <?php
                                $message = Session::get('message');//lấy cái key message bên routes trong web.php qua và hiển thị nội dung của nó
                                if($message){
                                    echo '<span class = "text-alert">',$message,'</span>';
                                    Session::put('message', null);
                                }
                           ?>

                        <div class="panel-body">
                            @foreach($edit_material_product as $key =>$edit_value) 
                                <div class="position-center">
                                    <form role="form" action="{{URL::to('/update-material-product/'.$edit_value->material_id)}}" method="post">
                                    {{ csrf_field() }} <!-- tự động tạo ra 1 cái input hidden token để bảo mật hệ thống -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Thuộc loại hàng</label>
                                        <input type="text" value = "{{$edit_value->material_name}}" name ="material_product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô Tả</label>
                                        <textarea style="Resize: none" rows ="6" name = "material_product_desc" class="form-control">{{$edit_value->material_desc}}</textarea>
                                    </div>
                                    <div class="form-group">

                                    <button type="submit" name="update_material_product" class="btn btn-info">Cập nhật chất liệu</button>
                                </form>
                                </div>
                             @endforeach
                        </div>
                    </section>

            </div>

@endsection          