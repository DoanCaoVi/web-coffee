@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trở về Trang Chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php 
					$content = Cart::content();
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Sản Phẩm</td>
							<td class="description">Tên</td>
							<td class="price">Giá Tiền</td>
							<td class="quantity">Số Lượng</td>
							<td class="total">Tổng Tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					@foreach($content as $value_content)
						
						<tr>
							<td class="cart_product">
							
							<a href="#"><img src="{{URL::to('public/uploads/product/'.$value_content->options->image)}}" 
							width="100px" height="100px" alt="" /></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$value_content->name}}</a></h4>
								<p>{{$value_content->product_id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($value_content->price)}} VNĐ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-quantity')}}" method="post">
										{{ csrf_field() }}
										<input class="cart_quantity_input" type="text" name="quantity_cart" 
										value="{{$value_content->qty}}" size="2">
										<input type ="hidden" value="{{$value_content->rowId}}" name="rowId_cart" class="form-control">
										<input type ="submit" value="cập nhật" name="update_qty" class="btn btn-default btn-sm">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
								<?php 
									$subtotal = $value_content->price*$value_content->qty;
									echo number_format($subtotal).' '.'VNĐ';

								?>
								</p> <!--  hàm tính tổng được hổ trợ Cart::subtotal() -->
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$value_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						
					@endforeach
				
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<!-- <div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div> -->
			<div class="row">
		<!-- 		<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>  -->
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng Tiền<span>{{Cart::total()}} VNĐ</span></li>
						<!-- 	<li>Thuế<span>{{Cart::tax() }} VNĐ</span></li> -->
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total()}} VNĐ</span></li>
						</ul>
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
		</div>
						</section><!--/#do_action-->
@endsection