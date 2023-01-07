@extends('Admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm vận chuyển
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
                                <form role="form"  method="post">
                                {{ csrf_field() }} <!-- tự động tạo ra 1 cái input hidden token để bảo mật hệ thống -->
                            
                                <div class="form-group">
                                <label for="exampleInputEmail1">Chọn Thành Phố</label>
                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city" required="">
                                        <option value = "">~~~~~~ Chọn hành Phố  ~~~~~~</option>
                                        @foreach ($city as $key => $ci)
                                        <option value ={{$ci->matp}} >{{$ci->name_city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Chọn quận huyện</label>
                                    <select name="province" id="province" class="form-control input-sm m-bot15 choose province" required="">
                                        <option value = "">~~~~~~ Chọn quận huyện ~~~~~~</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards" required="">
                                    <option value = "">~~~~~~ Chọn xã phường ~~~~~~</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phí Vận Chuyển</label>
                                    <input type="text" name ="fee_ship" class="form-control fee_ship" id="exampleInputEmail1" placeholder="Enter email" required="">
                                </div>
                                <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm Phí Vận Chuyển</button>
                            </form>
                            </div>

                            <div id="load_delivery">
                            
                            </div>
                        </div>
                    </section>

            </div>

@endsection          