@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trở về Trang Chủ</a></li>
				  <li class="active"
				  				style="
									text-shadow: 0 0  5px #6cd2ef,
												0 0  10px #6cd2ef,
												0 0  15px #6cd2ef,
												0 0  30px #6cd2ef;
									color: white;
									font-weight: bold;
								">Giỏ hàng của bạn</li>
				</ol>
			</div>
			<?php
                 $message = Session::get('message');//lấy cái key message bên routes trong web.php qua và hiển thị nội dung của nó
                    if($message){
						 echo '<span class = "text-alert" style="color:#0400ff;font-size:2.9rem;">',$message,'</span>';
                          Session::put('message', null);
                           }
                     ?>
			<div class="table-responsive cart_info" 				 
			style=" background-image: linear-gradient(0,rgb(51 51 51),rgb(58 58 56));
					border-radius: 15px;
					border: 15px solid #d3ec9f;
					color: #ffffff;
					font-size: 15px;
					margin-right: -168px;">
			
				<form action="{{url('/update-cart')}}" method="post">
				@csrf
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên</td>
							<td class="price">Giá sản phẩm</td>
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
									<h4><a href=""></a></h4>
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


								
								<td colspan="2">
								
									<ul>
										<li>Tổng Tiền: {{number_format($total,0,',','.')}}.VNĐ<span></span></li>
									<!-- 	<li>Thuế<span>{{Cart::tax() }} VNĐ</span></li> -->
										<li>
						   					@if(Session::get('coupon'))
											   @foreach(Session::get('coupon') as $key => $cou)
						   							@if($cou['coupon_condition'] == 1)
													   Mã giảm : {{$cou['coupon_number']}} %
													   <p>
						   									@php
															   $total_coupon = ($total=$cou['coupon_number'])/100;
															   echo '<p><li>Tổng giảm:'.number_format($total_coupon,0,',','.').'VNĐ</p></li>';
															@endphp
						   								</p>
														   <p>
						   									
															 {{ number_format($total-$total_coupon,0,',','.')}} VNĐ
															
						   									</p>
													@endif
												
											
													Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} VNĐ
													   <p>
						   									@php
															   $total_coupon = ($total-$cou['coupon_number']);
															@endphp
						   								</p>
														   <p>
														   		<li>
																	Tổng đã giảm:
																	{{number_format($total_coupon,0,',','.')}} VNĐ
															 
															   </li>
															</p>
															@endforeach
											@endif   
										 </li>
										<li>Phí vận chuyển <span>Free</span></li>
										<li>Thành tiền: {{number_format($subtotal,0,',','.')}}.VNĐ <span></span></li>
									</ul>
								</td>
							</tr>

						   @else
						   <tr>
								<td colspan="5">
									@php
										echo 'Vui long thêm sản phẩm vào giỏ hàng';
									@endphp
								</td>
						   </tr>
						@endif
					</tbody>
					</form>	
						   <tr>
						   		<td>

									<form method="POST" action="{{url('/check-coupon')}}">
										@csrf
										<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
										<input type="submit" class="btn btn-default check_out check_coupon" name="check_coupon" value="Tính mã giảm giá">
									</form>
								</td>
						   </tr>
						   
				</table>
				
				
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">

			<div class="row">

				<div class="col-sm-6">
					<div class="total_area">
						<?php 
									$customer_id = Session::get('customer_id');
									if($customer_id!=null){									
								?>
								<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh Toán</a>
								<?php 
									}else{
										?>		
									
									<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh Toán</a>
									<?php

									}
										?>
						</div>
				</div>
			</div>
	</section><!--/#do_action -->
    @endsection