<!DOCTYPE html>
<head>
<title>Trang quản lý Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<link rel="shortcut icon" href="{{('public/backend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
<style>
.back{
	background-size: cover;
	list-style: none;
	width: 70px;
  height: 60px;
  color: #6c7d8b;
  background:#f8f8f4;
  border-radius:5px;
  -webkit-transition: width 2s, height 2s, -webkit-transform 2s; /* Safari */
  transition: width 2s, height 2s, transform 2s;

}
.back span{
	padding: 15px;
	color: #6c7d8b;
	font-weight: bold;

}
.back:hover {
  width: 70px;
  height: 55px;
  padding: 5px;
  background:#f8f8f4;
  -webkit-transform: rotate(180deg); /* Safari */
  transform: rotate(360deg);
   border-radius: 5px;
    box-shadow: 0 0  5px #6cd2ef,
                0 0  25px #6cd2ef,
                0 0  50px #6cd2ef,
                0 0  100px #6cd2ef;
}

/* .modal{
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: flex;
	animation: fadeIn linear 0.1s;
	z-index: 2;
}

.modal__overlay{
    position: absolute;
    width: 100%;
    height: 100%;
	background-color: rgba(0,0,0,0.5);
	z-index: 2;
} */
</style>
</head>
<body>
<div class="modal">
    	<div class="modal__overlay">

        </div>
 
		<div class="log-w3">
	<div class="w3layouts-main" style="box-shadow: 0 0 5px #6cd2ef, 0 0 2px #6cd2ef, 0 0 22px #6cd2ef, 0 0 57px #6cd2ef;">
	<h2>Đăng Nhập</h2>
	<ul role="menu" class="sub-menu">
		<li class="back"><a href="{{URL::to('/')}}" ><span>BACK</span></a></li> 
    </ul>
	<?php
		$message = Session::get('message');//lấy cái key message bên routes trong web.php qua và hiển thị nội dung của nó
		if($message){
			echo '<span class = "text-alert">',$message,'</span>';
			Session::put('message', null);
		}
	?>
		<form action="{{URL::to('/admin-dashboard')}}" method="post" id="form-1" >
			{{ csrf_field() }}
			<div class="form-group">
				<input id="email" type="text" class="ggg" name="admin_email" placeholder="Điền Email">
				<span class="form-message"></span>
			</div>
			<div class="form-group">
				<input id="fullname" type="password" class="ggg" name="admin_password" placeholder="Điền Mật Khẩu">
				<span class="form-message"></span>
			</div>
			
			<!-- <span><input type="checkbox" />Ghi Nhớ</span>
			<h6><a href="#">Quên Mật Khẩu</a></h6> -->
				<div class="clearfix"></div>
			<input type="submit" value="Đăng Nhập" name="login">

		                    
		</form>

</div>

		<!-- <p>Bạn Không có tài khoản ?<a href="registration.html">Tạo 1 tài khoản mới</a></p>  --><!-- biến thành chú thích -->

</div>
</div>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.j')}}s"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('public/backend/js/validator.js')}}"></script>
<script>
	Validator({
		form: '#form-1',
		errorSelector: '.form-message',
		rules: [
			Validator.isRequired('#fullname'),
			Validator.isEmail('#email'),
		]
	});
</script>
</body>
</html>
