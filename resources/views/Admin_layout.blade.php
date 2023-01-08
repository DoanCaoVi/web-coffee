<!DOCTYPE html>
<head>
<title>Trang Quản Lý Người Dùng Của Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>
<link href="{{asset('public/fontend/css/sweetalert.css')}}" rel="stylesheet">


<style>
.back{
	background-size: cover;
	list-style: none;
	width: 70px;
  height: 60px;
  background: #fff;
  border-radius:5px;
  padding-top: 20px;
  font-weight:bold;
/*   margin-left: 180px; */
  -webkit-transition: width 2s, height 2s, -webkit-transform 2s; /* Safari */
  transition: width 2s, height 2s, transform 2s;

}
.back span{
	padding: 15px;

}

.back:hover {
  width: 70px;
  height: 55px;
  padding-top: 20px;
  background:#fff;
  -webkit-transform: rotate(180deg); /* Safari */
  transform: rotate(360deg);
   color: #000000;
   border-radius: 5px;
   box-shadow: 0 0  5px #6cd2ef,
                0 0  25px #6cd2ef,
                0 0  50px #6cd2ef,
                0 0  100px #6cd2ef;
}

</style>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="" class="logo">
        Admin
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>

<!---------------------------------->
<!---------------------------------->
<!---------------------------------->
<!---------------------------------->
<!---------------------------------->
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">
 
        </li>
        <!-- settings end -->
        <!-- inbox dropdown start-->
        <li id="header_inbox_bar" class="dropdown">
            
        </li>
        <!-- inbox dropdown end -->
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
           
        </li>
        <ul role="menu" class="sub-menu">
		        <li class="back" ><a href="{{URL::to('/')}}" ><span>BACK</span></a></li> 
        </ul>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div> 
<!--  ------------------------------ -->
<!--  ------------------------------ -->
<!--  ------------------------------ -->
<!--  ------------------------------ -->
<!--  ------------------------------ -->
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <!-- <input type="text" class="form-control search" placeholder=" Search"> -->
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/backend/images/My_picture.jpg')}}">
                <span class="username">
                <?php
                    $name = Session::get('admin_name');//lấy cái key admin_name bên routes trong web.php qua và hiển thị nội dung của nó
                    if($name){
                        echo $name;
                    }
	            ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
<!--                 <li><a href="#"><i class=" fa fa-suitcase"></i>Thông Tin</a></li>
                <li><a href="#"><i class="fa fa-cog"></i>Cài Đặt</a></li> -->
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i>Đăng Xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation" 
        style="
                background: black;
                box-shadow: 0 0  5px #6cd2ef,
                0 0  10px #6cd2ef,
                0 0  15px #6cd2ef,
                0 0  30px #6cd2ef;
                text-shadow: 0 0 5px #6cd2ef, 0 0 5px #6cd2ef, 0 0 10px #6cd2ef, 0 0 15px #6cd2ef;
                font-size: 45px;
                ">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/admin_managers')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng Quan</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Kho Hàng Xuất</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order')}}">Quản lý kho hàng xuất</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Kho hàng nhập</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/Add-product')}}">Thêm hàng nhập</a></li>
						<li><a href="{{URL::to('/All-product')}}">Danh sách Kho hàng nhập</a></li>
                    </ul>
                </li>
                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã Giảm Giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/insert-coupon')}}">Thêm mã Giảm Giá</a></li>
                        <li><a href="{{URL::to('/list-coupon')}}">Danh sách mã Giảm Giá</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Vận Chuyển</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/delivery')}}">Quản lý Vận Chuyển</a></li>
                    </ul>
                </li> -->
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh Mục</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/Add-category-product')}}">Thêm Danh Mục</a></li>
						<li><a href="{{URL::to('/All-category-product')}}">Danh Sách Danh Mục</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Loại hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/Add-material-product')}}">Thêm Loại hàng</a></li>
						<li><a href="{{URL::to('/All-material-product')}}">Danh Sách Loại hàng</a></li>
                    </ul>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->

    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		
		@yield('admin_content')
        
	</section>
 <!-- footer -->
<!-- 		  <div class="footer">
			<div class="wthree-copyright">
			  <p>Được thiết kế bởi <a href="">Cao Vĩ</a></p>
			</div>
		  </div> -->	
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script src="//cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/formvalidation/0.6.2-dev/js/formValidation.min.js"></script> -->
<script src="{{asset('public/fontend/js/sweetalert.min.js')}}"></script>
<script src="{{asset('public/backend/js/validation.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_' + order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url : '{{url('/update-qty')}}',
            method: 'POST',
            data:{_token:_token, order_product_id:order_product_id, order_qty:order_qty, order_code:order_code},
            success: function(data){
                alert("Cập nhật số lượng của sản phẩm thành công!!")
                location.reload();
            }
        });
    });
</script>
<script type="text/javascript">
    $('.order_details').change(function(){
        var order_status = $(this).val();//lấy value của option
        var order_id = $(this).children(":selected").attr("data-id");
        var _token = $('input[name="_token"]').val();
        //lấy ra sồ lượng
        quantity = []
        $('input[name="product_sales_quantity"]').each(function(){
            quantity.push($(this).val())
        });
        //lấy ra product id
        order_product_id = [];
        $('input[name="order_product_id"]').each(function(){
            order_product_id.push($(this).val())
        });
        j=0
        for(i=0;i<order_product_id.length;i++){
            //số lượng order
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            //số lượng tồn kho
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j + 1;
                if(j==1){
                    alert("Số lượng tồn kho không đủ!!")
                }
                $('.color_qty_' + order_product_id[i]).css('background','#DF1C23');
            }
        }
        if(j==0){
            $.ajax({
                url : '{{url('/update-order-qty')}}',
                method: 'POST',
                data:{_token:_token, order_status:order_status, order_id:order_id, quantity:quantity, order_product_id:order_product_id},
                success: function(data){
                    alert("Cập nhật trạng thái order thành công!!")
                    location.reload();
                }
            });
        }

        // alert(order_status);
    });
</script>
<script type="text/javascript">
        $.validate({

        });
</script>
<script>
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor2');
    CKEDITOR.replace('ckeditor3');
    CKEDITOR.replace('ckeditor4');
    CKEDITOR.replace('ckeditor5');
    CKEDITOR.replace('ckeditor6');
    CKEDITOR.replace('ckeditor7');
    CKEDITOR.replace('ckeditor8');
    CKEDITOR.replace('ckeditor9');
</script>
<script type="text/javascript">
$(document).ready(function(){
    fetch_delivery();
    function fetch_delivery(){
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url : '{{url('/select-feeship')}}',
            method: 'POST',
            data:{_token:_token},
            success: function(data){
                $('#load_delivery').html(data);
            }
        });
    }
    $(document).on('blur','.fee_feeship_edit',function(){
        var feeship_id = $(this).data('feeship_id');
        var fee_value = $(this).text();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url : '{{url('/update-delivery')}}',
            method: 'POST',
            data:{feeship_id:feeship_id,fee_value:fee_value,_token:_token},
            success: function(data){
                fetch_delivery();
                swal("^____^", "cập nhật thành công!", "success");
            }
        });
    });
    $('.add_delivery').click(function(){
        var city = $('.city').val();
        var province = $('.province').val();
        var wards = $('.wards').val();
        var fee_ship = $('.fee_ship').val();
        var _token = $('input[name="_token"]').val();
/*         alert(city);
        alert(province);
        alert(wards);
        alert(fee_ship); */
        $.ajax({
            url : '{{url('/insert-delivery')}}',
            method: 'POST',
            data:{city:city,province:province,wards:wards,_token:_token,fee_ship:fee_ship},
            success: function(data){
                fetch_delivery();
                swal("^____^", "Thêm phí vận chuyển thành công!", "success");
            }
        });
    });
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
            url : '{{url('/select-delivery')}}',
            method: 'POST',
            data:{action:action,ma_id:ma_id,_token:_token},
            success: function(data){
                $('#'+result).html(data);
            }
        });
    });
})
</script>

<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{('public/backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
