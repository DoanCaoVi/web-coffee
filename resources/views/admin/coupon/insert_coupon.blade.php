@extends('Admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Mã giảm giá
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
                                <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                                {{ csrf_field() }} <!-- tự động tạo ra 1 cái input hidden token để bảo mật hệ thống -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" 
                                    name ="coupon_name" class="form-control" id="exampleInputEmail1" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1" >Mã giảm giá</label>
                                    <input type="text" 
                                    name ="coupon_code" class="form-control" id="exampleInputEmail1" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số lượng Mã</label>
                                    <input type="text" 
                                    name ="coupon_times" class="form-control" id="exampleInputEmail1" required="">
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Tính năng mã</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15" required="">
                                        <option value = "0">~~~~~Chọn~~~~~</option>
                                        <option value = "1">Giảm theo phần trăm</option>
                                        <option value = "2">Giảm theo tiền</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhập số % hay số tiền giảm</label>
                                    <input style="text" 
                                    name = "coupon_number" class="form-control" id="exampleInputEmail1" required="">
                                </div>
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection          