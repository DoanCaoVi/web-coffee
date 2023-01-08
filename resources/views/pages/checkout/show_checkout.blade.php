@extends('layout')
@section('content')

<section id="cart_items">
<div class="container"
 style=" background-image: linear-gradient(0,rgb(51 51 51),rgb(58 58 56));
		font-size: 20px;">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a class="got" style="background-color:#fe980f;color:white;"  href="{{URL::to('/')}}"> Trở Về trang chủ</a></li>
				  <li class="active" style="
									text-shadow: 0 0  5px #6cd2ef,
												0 0  10px #6cd2ef,
												0 0  15px #6cd2ef,
												0 0  30px #6cd2ef;
									color: white;
									font-weight: bold;
								">Điền thông tin người nhập</li>
				</ol>
				<div class="loader"></div>
			</div>

			<div class="register-req">
				<p>Vui lòng đăng ký tài khoản hoặc đăng nhập để bắt đầu nhập kho</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
				<div class="col-sm-15 clearfix">
						<?php
							$message = Session::get('message');//lấy cái key message bên routes trong web.php qua và hiển thị nội dung của nó
								if($message){
									echo '<span class = "text-alert">',$message,'</span>';
									Session::put('message', null);
									}
                     	?>
							<div class="cart_info">
								
								<form action="{{url('/update-cart')}}" method="post">
								@csrf
								<table class="table table-condensed" style="margin-left: 13%;">
									<thead>
										<tr class="cart_menu">
											<td class="image">Hình ảnh</td>
											<td class="description">Tên</td>
											<!-- <td class="description">Tồn kho</td> -->
											<td class="price">Giá</td>
											<td class="quantity">Số Lượng</td>
											<td class="total">Thành Tiền</td>
										</tr>
									</thead>
									<tbody>

											@if(Session::get('cart')==true)	
											@php
												$total = 0;
											@endphp
								@foreach(Session::get('cart') as $key => $cart)
											@php
												$subtotal = $cart['product_price']*$cart['product_qty'];
												$total+=$subtotal;
											@endphp
											<tr>
												<td class="cart_product">
												<a href="#"><img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" 
												width="100px" height="100px" alt="{{$cart['product_name']}}" /></a>
												</td>
												<td class="cart_description">
													<p>{{$cart['product_name']}}</p>
												</td>

												<td class="cart_price">
													<p>{{number_format($cart['product_price'],0,',','.')}}.VNĐ</p>
												</td>
												<td class="cart_quantity">
													<div class="cart_quantity_button">
														
														{{ csrf_field() }}
															<input class="cart_quantity_" type="text" name="cart_qty[{{$cart['session_id']}}]" 
															min="1" value="{{$cart['product_qty']}}" >
															<input type ="hidden" value="" name="rowId_cart" class="form-control">
															
													</div>
												</td>
												<td class="cart_total">
													<p class="cart_total_price">
													{{number_format($subtotal,0,',','.')}}.VNĐ
													</p> <!--  hàm tính tổng được hổ trợ Cart::subtotal() -->
												</td>
												<td class="cart_delete">
													<a class="cart_quantity_delete" href="{{url('/xoa-san-pham/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
												</td>
											</tr>
											
									@endforeach
											<tr>
												<td>
													<input type ="submit" value="cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out btn-sm">
												</td>
												<td>
													<a class="btn btn-default check_out" href="{{url('/delete-all')}}">xoá tất cả sản phẩm trong giỏ hàng</a>
												</td>

												<td colspan="2" style="color: white;">
													<p> Tổng Tiền: {{number_format($total,0,',','.')}}.VNĐ<span></span></p>
												</td>
											</tr>

										@else
										<tr>
												<td colspan="5" style="color: red;">
													@php
														echo 'Vui lòng thêm sản phẩm';
													@endphp
												</td>
										</tr>
										@endif
									</tbody>
									</form>	
										<!-- <tr>
												<td>

													<form method="POST" action="{{url('/check-coupon')}}">
														@csrf
														<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
														<input type="submit" class="btn btn-default check_out check_coupon" name="check_coupon" value="Tính mã giảm giá">
													</form>
												</td>
										</tr> -->	
								</table>
							</div>
					</div>		
					<div class="col-sm-15 clearfix">
						<div class="bill-to" style="display:flex;flex-direction:row;">
							
							<div class="form-one" style="flex:1;">
								<form method="POST" style="margin-left: 317px;">
								@csrf
									<input type="text" name="shipping_email" class="shipping_email" placeholder="Email:">
									<input type="text" name="shipping_name"class="shipping_name" placeholder="Họ và tên:">
									<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ:">
									<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại:">
									<p>Ghi chú</p>
									<textarea name="shipping_notes" class="shipping_notes" placeholder="Ghi chú cho người gửi" rows="5"></textarea>
									
									<!-- @if(Session::get('fee'))
									<input type="hidden" name="order_fee" class="order_fee" value="session::get('fee')">
									@else
									<input type="hidden" name="order_fee" class="order_fee" value="30000">
									@endif

									@if(Session::get('coupon'))
									@foreach(Session::get('coupon') as $key => $cou)
									<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}" >
									@endforeach
									@else
									<input type="hidden" name="order_coupon" class="order_coupon" value="no">
									@endif -->
									<!-- <div class="" style="display:flex;flex-direction:column;">
										<div class="form-group">
											<label for="exampleInputEmail1">chọn phương thức thanh toán</label>
											<select style="padding-left:250px;;" name="payment_select" class="form-control input-sm m-bot15 payment_select">
												<option value = "0">Thanh Toán Qua ATM(chuyển khoản)</option>
												<option style="background-color:#5bc0de;" value = "1">Thanh Toán Bằng Tiền Mặt</option>
											</select>
										</div>
									</div> -->
									
									<input type ="button"  style="background-color:#5bc0de;color:white;" value="Xác nhận gửi" name="send_order" class="btn btn-sm send_order">
								</form>
								
								<!-- <form role="form" style="flex:1;margin-left: 317px;" action="{{URL::to('/save-material-product')}}" method="post">
									@csrf tự động tạo ra 1 cái input hidden token để bảo mật hệ thống
								
									<div class="form-group" >
									<label for="exampleInputEmail1">Chọn Thành Phố</label>
										<select style="padding-left:250px;" name="city" id="city" class="form-control input-sm m-bot15 choose city">
											<option value = "">~~~~~~ Chọn hành Phố  ~~~~~~</option>
											@foreach ($city as $key => $ci)
											<option value ={{$ci->matp}} >{{$ci->name_city}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
									<label for="exampleInputEmail1">Chọn quận huyện</label>
										<select style="padding-left:250px;" name="province" id="province" class="form-control input-sm m-bot15 choose province">
											<option value = "">~~~~~~ Chọn quận huyện ~~~~~~</option>
										</select>
									</div>
									<div class="form-group">
									<label for="exampleInputEmail1">chọn xã phường</label>
										<select style="padding-left:250px;" name="wards" id="wards" class="form-control input-sm m-bot15 wards">
										<option value = "">~~~~~~ Chọn xã phường ~~~~~~</option>
										</select>
									</div>

									<input type ="button" style="background-color:#5bc0de;color:white;" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-sm calculate_delivery" >
								</form> -->
							</div>
						</div>
					</div>		
				</div>
			</div>

		</div>


@endsection