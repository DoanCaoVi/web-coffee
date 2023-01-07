
@extends('layout')<!-- gọi từ welcome.blade.php qua -->
@section('content')

@foreach($product_details as $key => $details)
<div class="product-details" 
style=" background-image: linear-gradient(0,rgb(45 44 44),rgb(173 173 164));
    	border-radius: 15px;
		border: 15px solid #d3ec9f;"><!--product-details-->
<div class="fb-share-button" data-href="http://localhost/shopbanhang/trang-chu" 
data-layout="button_count" data-size="small"><a target="_blank" 
href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" 
class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
<div class="fb-like" style="top:8px;" data-href="{{$url_canonical}}"
 data-width="" data-layout="button_count" 
 data-action="like" data-size="small" data-share="false"></div>

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
								<h3 style="
									text-shadow: 0 0  5px #6cd2ef,
												0 0  10px #6cd2ef,
												0 0  15px #6cd2ef,
												0 0  30px #6cd2ef;
									color: white;
									font-weight: bold;
								" >CHI TIẾT SẢN PHẨM</h3>
							<h3 style="
									text-shadow: 0 0  5px #6cd2ef,
												0 0  10px #6cd2ef,
												0 0  15px #6cd2ef,
												0 0  30px #6cd2ef;
									color: white;
									font-weight: bold;
								">-----~~~~~~~~-----</h3>
								<!-- <img src="images/product-details/new.jpg" class="newarrival" alt="" /> -->

						<form action="{{URL::to('/show-cart-ajax')}}" method="post">
								{{ csrf_field() }} <!-- đây là 1 cái token -->
								<h2 style="
									color: white;
									font-weight: bold;
								">Tên sản phẩm: {{$details->product_name}}</h2> <!-- biến details lấy tên từ product_name trong cơ sở dữ liệu ra -->
								<p>Mã ID: {{$details->product_id}}</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span>Giá: {{number_format($details->product_price)}}.VNĐ </span>
									<label>Số Lượng: </label>
									<input name = "qty" type="number" min="1" max= "1000" value="1" />
									<input name = "product_id_hidden" type="hidden" min="1" max= "1000" value="{{$details->product_id}}" />
									<a href="{{URL::to('/chi-tiet-san-pham/'.$details->product_id)}}">
									<div class="overlay-content">
									<input type="hidden" value="{{$details->product_id}}" class="cart_product_id_{{$details->product_id}}">
									<input type="hidden" value="{{$details->product_name}}" class="cart_product_name_{{$details->product_id}}">
									<input type="hidden" value="{{$details->product_image}}" class="cart_product_image_{{$details->product_id}}">
									<input type="hidden" value="{{$details->product_price}}" class="cart_product_price_{{$details->product_id}}">
									<input type="hidden" value="1" class="cart_product_qty_{{$details->product_id}}">
									</a>
											
								<button type="button" class="btn btn-default add-to-cart" data-id_product="{{$details->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
								</span>
								<p><b>Tình Trạng: </b> Còn hàng</p>
								<p><b>Điều Kiện: </b> Còn Nguyên Si</p>
								<p><b>Chất Liệu: </b> {{$details->material_name}}</p>
								<p><b>Danh Mục: </b> {{$details->category_name}}</p>
								<!-- <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a> -->
							</div><!--/product-information-->
						</form>


						</div>
					</div><!--/product-details-->
@endforeach

					<div class="category-tab shop-details-tab" 
					style=" background-image: linear-gradient(0,rgb(51 51 51),rgb(210 218 208));
							border-radius: 15px;
							border: 5px solid #d3ec9f;
							color: #fff;
							"><!--category-tab-->
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
					
					<div class="recommended_items" 
					style=" background-image: linear-gradient(0,rgb(51 51 51),rgb(210 218 208));
							border-radius: 15px;
							border: 5px solid #d3ec9f;
							padding-bottom: 100px;
							"><!--recommended_items-->
						<h2 class="title text-center">Sản Phẩm Liên Quan</h2>
						
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
													<h2>{{number_format($lienquan->product_price)}}.VNĐ</h2>
													<p>{{$lienquan->product_name}}</p>
													<button type="button" class="btn btn-default add-to-cart" data-id_product="{{$lienquan->product_id}}" name="add-to-cart">
													<i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
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