@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trở về Trang Chủ</a></li>
				  <li class="active"><a>Sản phẩm cần đưa vào kho</a></li>
				</ol>
			</div>
			<?php
                 $message = Session::get('message');//lấy cái key message bên routes trong web.php qua và hiển thị nội dung của nó
                    if($message){
						 echo '<span class = "text-alert" style="color:#0400ff;font-size:2.9rem;">',$message,'</span>';
                          Session::put('message', null);
                           }
                     ?>
			<div class="table-responsive cart_info" >
			
				<form action="{{url('/update-cart')}}" method="post">
				@csrf
				<table class="table table-condensed"  style="width: 85%;">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>							
							<td class="quantity">Số lượng hàng tồn</td>
							<td class="quantity">Số lượng hàng xuất</td>
							<td class="total">Thành Tiền</td>
						</tr>
					</thead>
					<tbody>

						   	@if(Session::get('cart')==true)	
							@php
								$total = 0;
							@endphp
				@foreach(Session::get('cart') as $key1 => $cart)
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
									<h4>{{$cart['product_name']}}</h>
								</td>
								<td class="cart_price">
									<h3>{{number_format($cart['product_price'],0,',','.')}}.VNĐ</h>
								</td>
								<td class="cart_price">
									<h4>{{number_format($cart['product_quantity')]}}</h>
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
									<input type ="submit" value="cập nhật số lượng nhập" name="update_qty" class="btn btn-default check_out btn-sm">
								</td>
								<td>
									<a class="btn btn-default check_out" href="{{url('/delete-all')}}">xoá tất cả sản phẩm</a>
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
										<!-- <li>Thành tiền: {{number_format($subtotal,0,',','.')}}.VNĐ <span></span></li> -->
									</ul>
								</td>
							</tr>

						   @else
						   <tr>
								<td colspan="5">
									@php
										echo 'Vui lòng thêm sản phẩm cần nhập kho';
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
				
				<div class="col-sm-6">
					<div class="total_area">
						<?php 
									$customer_id = Session::get('customer_id');
									if($customer_id!=null){									
								?>
								 <button style="background: #ddcfcf;">
								    <a class="box" href="{{URL::to('/checkout')}}">Nhập kho</a>
								 </button>
								
								<?php 
									}else{
										?>		
								   <button style="background: #ddcfcf;">
								   		<a class="box" href="{{URL::to('/login-checkout')}}">Nhập kho</a>
								   </button>
									
									<?php

									}
										?>
						</div>
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
    @endsection