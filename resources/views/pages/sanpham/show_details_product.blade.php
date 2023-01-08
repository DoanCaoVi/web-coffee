
@extends('layout')<!-- gọi từ welcome.blade.php qua -->
@section('content')

@foreach($product_details as $key => $details)
<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('/public/uploads/product/'.$details->product_image)}}" alt="" />
								<!-- <h3>ZOOM</h3> -->
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
									<div class="carousel-inner">
										<!-- <div class="item active">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div> -->
										
									</div>
								  <!-- Controls -->
						<!-- 		  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a> -->
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<h3>CHI TIẾT SẢN PHẨM</h3>
							<h3>-----~~~~~~~~-----</h3>
								<!-- <img src="images/product-details/new.jpg" class="newarrival" alt="" /> -->

						<form action="{{URL::to('/show-cart-ajax')}}" method="post">
								{{ csrf_field() }} <!-- đây là 1 cái token -->
								<h2>Tên sản phẩm: {{$details->product_name}}</h2> <!-- biến details lấy tên từ product_name trong cơ sở dữ liệu ra -->
								<h2>Mã ID: {{$details->product_id}}</h2>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span>Giá: {{number_format($details->product_price)}}.VNĐ </span>
									<!-- <label>Số Lượng: </label> -->
									<!-- <input name = "qty" type="number" min="1" max= "1000" value="1" /> -->
									<input name = "product_id_hidden" type="hidden" min="1" max= "1000" value="{{$details->product_id}}" />
									<a href="{{URL::to('/chi-tiet-san-pham/'.$details->product_id)}}">
									<div class="overlay-content">
									<input type="hidden" value="{{$details->product_id}}" class="cart_product_id_{{$details->product_id}}">
									<input type="hidden" value="{{$details->product_name}}" class="cart_product_name_{{$details->product_id}}">
									<input type="hidden" value="{{$details->product_image}}" class="cart_product_image_{{$details->product_id}}">
									<input type="hidden" value="{{$details->product_price}}" class="cart_product_price_{{$details->product_id}}">
									<input type="hidden" value="1" class="cart_product_qty_{{$details->product_id}}">
									</a>
											
								<button type="button" class="btn btn-1 btn-default custom-btn add-to-cart" data-id_product="{{$details->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
								</span>
								<h2><b>Kho hàng còn: </b> {{$details->product_quantity}}</h>
								<h2><b>Xuất xứ: </b> {{$details->product_origin}}</h>
								<h2><b>Danh mục: </b> {{$details->category_name}}</h>
								<h2><b>Loại: </b> {{$details->material_name}}</h>
								<!-- <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a> -->
							</div><!--/product-information-->
						</form>


						</div>
					</div><!--/product-details-->
@endforeach

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
	     <!-- class="active" --><li class="active"><a href="#details" data-toggle="tab">Mô Tả Sản Phẩm</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi Tiết Sản Phẩm</a></li>

								<!-- <li ><a href="#reviews" data-toggle="tab">Lượt Đánh Giá</a></li> -->
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
							<p style="padding-left: 20px;">{!!$details->product_desc!!}</p> <!--có thể in ra ký tự đặc biệt -->
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
							<p style="padding-left: 20px;">{!!$details->product_content!!}</p>
							</div>
							
							

							<div class="tab-pane fade " id="reviews" >
								<div class="col-sm-12">
									<!-- <ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
									sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim
									ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip 
									ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate
									 velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form> -->
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<p class="title-text-center text-center">Sản Phẩm liên quan</p>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
								@foreach($relate as $key => $lienquan)
								<a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_id)}}">
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
												<form action="{{URL::to('/show-cart-ajax')}}" method="post">
													{{ csrf_field() }} <!-- đây là 1 cái token -->
													<img src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
													<input type="hidden" value="{{$details->product_id}}" class="cart_product_id_{{$details->product_id}}">
													<input type="hidden" value="{{$details->product_name}}" class="cart_product_name_{{$details->product_id}}">
													<input type="hidden" value="{{$details->product_image}}" class="cart_product_image_{{$details->product_id}}">
													<input type="hidden" value="{{$details->product_price}}" class="cart_product_price_{{$details->product_id}}">
													<input type="hidden" value="1" class="cart_product_qty_{{$details->product_id}}">
													<h2>{{number_format($lienquan->product_price)}}.VNĐ</h2>
													<h5>{{$lienquan->product_name}}</h>
												</form>
												</div>
											</div>
										</div>
									</div>
								</a>
								@endforeach	
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
	


@endsection<!-- kết thúc section-->