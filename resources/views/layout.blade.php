<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
	<meta name="keywords" content="{{$meta_keywords}}"/>
	<meta name="robots" content="INDEX,FOLLOW"/>
	<link  rel="icon" type="image/x-icon" href="" />
    <link  rel="canonical"  href="{{$url_canonical}}" />


    <meta property="og:site_name" content="http://localhost/coffee-Trang/trang-chu" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{$url_canonical}}" />
    <meta property="og:type" content="website" />

	<title>{{$meta_title}}</title>
    <link href="{{asset('public/fontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/fontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/fontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/fontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/fontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/fontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/fontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/fontend/css/sweetalert.css')}}" rel="stylesheet">
	<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
	<!-- css rieng -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="{{asset('public/fontend/css/basef8.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/mainf8.css')}}">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/fontend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    
	<link rel="stylesheet" href="{{asset('public/fontend/css/paging.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<style>
		body {
			background-size: 200px;
			background-repeat:repeat;
		} 
		.right-sidebar:hover{
			cursor: pointer;
		}
		.right-sidebar:active {
			transform: translateY(4px);
		}
		.got{
			color:#fff;
			font-size: 1.8rem;
			background-color:#fe980f;
		}
		.got:active {
			box-shadow: 0 5px #666;
			transform: translateY(4px);
		}
	
		.got1{
			transition: .7s;
			 /* hiệu ứng của cái bảng*/
		}
		.got1:active {
			box-shadow: 0 5px #666;
			transform: translateY(18px);
			text-shadow: 0 0  5px #6cd2ef,
                0 0  10px #6cd2ef,
                0 0  15px #6cd2ef,
                0 0  30px #6cd2ef;
			
		}
		.got2:active {
			transform: translateY(8px);
			box-shadow: 0 0  5px #6cd2ef,
                0 0  10px #6cd2ef,
                0 0  15px #6cd2ef,
				0 0  30px #6cd2ef;
		}

		.add-to-cart:active {
			color:back;
			font-weight:bold;
			background-color: #101215;
			box-shadow: 0 5px #666;
			transform: translateY(4px);
		}
		.brands-name:active {
			background-color: #101215;
			box-shadow: 0 5px #666;
			transform: translateY(4px);
			box-shadow: 0 0  5px #6cd2ef,
                0 0  10px #6cd2ef,
                0 0  15px #6cd2ef,
                0 0  30px #6cd2ef;

		}
		#back{
			/* background-size: cover; */
			list-style: none;
			height: 50px;
			border-radius:5px;
			padding-top: 20px;
			font-weight:bold;
			margin-top: -21px;
		/*   margin-left: 180px; */


		}

		#back:hover {
		width: 70px;
		height: 55px;
		padding-top: 20px;
		border-radius: 5px;
		background: #35e3f5b0;
		box-shadow: 0 0  5px #6cd2ef,
						0 0  25px #6cd2ef,
						0 0  50px #6cd2ef,
						0 0  100px #6cd2ef;
		}

    </style>
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0355188888</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> caovi@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle" style="background-image: linear-gradient(0,rgb(47 44 44),rgb(148 134 134));"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
<!-- 							<a href="index.html"><img src="{{asset('public/fontend/images/logo.png')}}" alt="" /></a> -->
							<h2 style="
							text-shadow: 0 0  5px #6cd2ef,
										0 0  10px #6cd2ef,
										0 0  15px #6cd2ef,
							0 0  30px #6cd2ef;
							color: aliceblue;
						">
						<span >Website</span> Trang Coffee</h2>
						</div>


					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
							</a></li>
								<?php 
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
									if($customer_id!=Null && $shipping_id=Null){
								?>
								
									<li class="got1"><button><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Nhập Kho</a></li>
									<?php 
									}elseif($customer_id!=Null && $shipping_id!=Null){
									?>
										<li class="got1"><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Nhập Kho</a></li>
									<?php 
										}else{
											?>		
										
										<li class="got1"><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i>Nhập Kho</a></li>
										<?php

										}
											?>
									
								<li class="got1"><a href="{{URL::to('/show-cart-ajax')}}"><i class="fa fa-shopping-cart"></i>Kho đã chọn</a></li>
								<?php 
									$customer_id = Session::get('customer_id');
									if($customer_id!=Null){

									
								?>
								<!-- nếu có đăng ký rồi thì đăng xuất -->
								<li class="got1"><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng Xuất</a></li>
										<?php 
									}else{
										?>		
									<!-- ngược lại thì đăng nhập -->
									<li class="got1"	><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng Nhập</a></li>
									<?php

									}
										?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom" style="background-image: linear-gradient(0,rgb(108 111 107),rgb(39 39 39));"><!--header-bottom-->
			<div class="container">

				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" id="back" style="margin-left: 200px;" >HOME</a></li>
								<li class="dropdown"><a href="#">Admin<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
										<li><a href="{{URL::to('/admin')}}">Đăng Nhập->Admin</a></li> 
                                    </ul>
                                </li> 

                                </li> 
								<!-- <li><a href="{{('/show_cart')}}">Giỏ hàng</a></li> -->
								<!-- <li><a href="contact-us.html">Liên Hệ</a></li> -->
							</ul>
						</div>
					</div>
					<!-- <div class="col-sm-4">
					<form action="{{URL::to('/tim-kiem')}}" method="post">
					{{ csrf_field() }}
						<div class="search_box pull-right">
							<input type="text" name="keywords_submit" placeholder="Tìm kiếm theo ý của bạn"/>
							<input type="submit" style="margin-top:0px;color:#fff;" name="search_items" class="btn btn-primary btn-sm got2" value="Tìm Ngay"/>
						</div>
					</form>
					</div> -->
					<div aria-label="Orange and tan hamster running in a metal wheel" role="img" class="wheel-and-hamster">
						<div class="wheel"></div>
						<div class="hamster">
							<div class="hamster__body">
								<div class="hamster__head">
									<div class="hamster__ear"></div>
									<div class="hamster__eye"></div>
									<div class="hamster__nose"></div>
								</div>
								<div class="hamster__limb hamster__limb--fr"></div>
								<div class="hamster__limb hamster__limb--fl"></div>
								<div class="hamster__limb hamster__limb--br"></div>
								<div class="hamster__limb hamster__limb--bl"></div>
								<div class="hamster__tail"></div>
							</div>
						</div>
						<div class="spoke"></div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	<!-- <p> 
		<FONT face="Tme New Roman" size="6"color="black">
			<marquee onmouseover="this.stop();"onmouseout="this.start();" behavior="scroll" direction="left" scrollamount=10 style="background-image: linear-gradient(90deg,rgb(164 224 162),rgb(219 228 79));color: #ff0101;">
			Chào mừng bạn đến với website bán đố nội thất của chúng tôi, chúng tôi chuyên bán nội thất về Bàn, Ghế, Tủ,..và các loại vật dụng trong nhà.
			</marquee>
		</FONT>
	</p> -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh Mục</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach($category as $key => $cate)
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a href="{{URL::to('/danh-muc/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
									</div>
								</div>
							@endforeach
						</div><!--/category-products-->
						<h2>Loại hàng</h2>
						<div class="panel-group category-products" id="accordian">
							@foreach($material as $key => $mate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/chat-lieu/'.$mate->material_id)}}"> <span class="pull-right">(50)</span>{{$mate->material_name}}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
<!-- 							<h2>Chọn Giá</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div> -->
						</div><!--/price-range-->
						
					<!-- 	<div class="shipping text-center">
							<img src="images/home/shipping.jpg" alt="" />
						</div> -->
					
					</div>
					
				</div>
				<div class="col-sm-9 padding-right">
 				
				@yield('content')

				</div>
			</div>
		</div>
	</section>

	<footer id="footer"><!--Footer-->
		<div class="footer-top" style=" background-image: linear-gradient(0,rgb(35 31 31),rgb(196 245 189));">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span></span> </h2>
								<p></p>
							</div>
					</div>
					<div class="col-sm-7">

					</div>
					<div class="col-sm-3">
						<div class="address">
<!-- 							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">WEBSITE TRANG COFFEE</p>
					<p class="pull-right">ĐƯỢC THIẾT KẾ BỞI  <span><a target="_blank" href="">Đoàn Cao vỉ</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	
	
  
    <script src="{{asset('public/fontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/fontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/fontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/fontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/fontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/fontend/js/main.js')}}"></script>
	<script src="{{asset('public/fontend/js/sweetalert.min.js')}}"></script>

	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" 
	src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0" nonce="L67tCnbu"></script>
	<script type="text/javascript"> 
	
		$(document).ready(function(){
			$('.send_order').click(function(){
				var shipping_email = $('.shipping_email').val();
				var shipping_name = $('.shipping_name').val();
				var shipping_address = $('.shipping_address').val();
				var shipping_phone = $('.shipping_phone').val();
				var shipping_notes = $('.shipping_notes').val();
				// var shipping_method = $('.payment_select').val();
				// var order_fee = $('.order_fee').val();
				// var order_coupon = $('.order_coupon' ).val();
				var _token = $('input[name="_token"]').val();
				
				$.ajax({
					url: '{{url('/confirm-order')}}',
					method: 'POST',
					data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:
					shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token},
						success:function(){
							swal({
								title: "Bạn có chắc chắn xác nhận đơn hàng",
								text: "Bạn có thể sẽ liên hệ chúng tôi nếu muốn huỷ đơn hàng này!",
								type: "warning",
								showCancelButton: true,
								confirmButtonClass: "btn-danger",
								confirmButtonText: "vâng, Tôi đồng ý xác nhận đơn hàng!",
								cancelButtonText: "Đóng",
								closeOnConfirm: false
					           },
								function(){
									swal("^____^", "Đặt hàng thành công!", "success");
								});
								window.setTimeout(function(){
									location.reload();
								},3000);
						}

				});

		 });
	});
	</script>

	<script type="text/javascript"> 
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				var id = $(this).data('id_product');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();
				
				$.ajax({
					url: '{{url('/add-cart-ajax')}}',
					method: 'POST',
					data:{cart_product_id:cart_product_id,cart_product_name:
						cart_product_name,cart_product_image:cart_product_image,cart_product_price:
						cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
						success:function(data){
							
							 swal({
									title: "Đã thêm sản phẩm vào giỏ để nhập kho hàng bán",
									text: "Bạn có thể tiếp tục chọn sản phẩm hoặc tới giỏ để tiến hành gửi yêu cầu nhập kho hàng bán",
									showCancelButton: true,
									cancelButtonText: "Xem tiếp",
									confirmButtonClass: "btn-success",
									confirmButtonText: "Vào nhập Kho",
									closeOnConfirm: false,
								},
								function() {
									window.location.href = "{{url('/show-cart-ajax')}}";
								});
	
						}

			});

		 });
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
			$('.choose').on('change',function(){
			var action = $(this).attr('id');
			var ma_id = $(this).val();
			var _token = $('input[name="_token"]').val();
			var result = '';
	/*         alert(action);
			alert(ma_id);
			alert(ma_id); */
			if(action=='city'){
				result = 'province';
			}else{
				result = 'wards';
			}
			$.ajax({
				url : '{{url('/select-delivery-home')}}',
				method: 'POST',
				data:{action:action,ma_id:ma_id,_token:_token},
				success: function(data){
					$('#'+result).html(data);
				}
			});
		});
	});
	</script>
	<!-- <script type="text/javascript">
		$(document).ready(function(){
			$('.calculate_delivery').click(function(){
				var matp = $('.city').val();
				var maqh = $('.province').val();
				var xaid = $('.wards').val();
				var _token = $('input[name="_token"]').val();
				if(matp == '' && maqh == '' && xaid == ''){
					swal("vui lòng chọn địa chỉ giao hàng để tính phí vận chuyển!");
					}else{
						$.ajax({
							url : '{{url('/calculate-fee')}}',
							method: 'POST',
							data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
							success: function(){
								location.reload();
							}
						});
					}
			});
		});
	</script> -->


</body>
</html>