@extends('layout')
@section('content')

        <section id="cart_items">
        <div class="container">
                    <div class="breadcrumbs">
                        <ol class="breadcrumb">
                        <li><a href="{{URL::to('/')}}">Trở về Trang Chủ</a></li>
                        <li class="active">Thanh toán Giỏ hàng</li>
                        </ol>
                    </div>
            
            <div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
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
			<h4 style="margin:40px 0; font-size:20px;">----Vui lòng chọn hình thức bạn muốn thanh toán----</h4>
			<form action ="{{URL::to('/order-place')}}" method="post">
			{{ csrf_field() }}
			<div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Trả Bằng thẻ ATM</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="checkbox"> Trả khi nhận hàng</label>
					</span>
<!-- 					<span>
						<label><input type="checkbox"> Paypal</label>
					</span> -->
					<input type ="submit" value="Đặt hàng" name="send_order_place" class="btn btn-info btn-sm">
			</div>
			</form>
		</div>


@endsection