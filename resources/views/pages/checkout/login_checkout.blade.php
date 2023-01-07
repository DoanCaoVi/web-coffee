@extends('layout')
@section('content')
	<section id="form" style="
    background-image: linear-gradient(0,rgb(51 51 51),rgb(210 218 208));
    border-radius: 15px;
    border: 15px solid #d3ec9f;
	padding-bottom:20px;
	color:#fff;"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1" >
					<div class="login-form"><!--login form-->
						<h2 style="margin-left: 51px;color:#fff;font-weight:bold;">Đăng Nhập Tài Khoản</h2>
						<form action="{{URL::to('/login-customer/')}}" method="post" style="margin-left: 51px;">
						{{ csrf_field() }}
							<input type="text" name = "email_account" placeholder="Tài Khoản" />
							<input type="password" name = "password_account" placeholder="Mật Khẩu" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Nhớ Tài Khoản
							</span>
							<button type="submit" class="btn btn-default" >Đăng Nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2 style="color:#fff;font-weight:bold;">Đăng ký Tài Khoản!</h2>
						<form action="{{URL::to('/add-customer/')}}" method="post">
                            {{ csrf_field() }}
							<input type="text" name="customer_name" placeholder="Họ Và Tên"/>
							<input type="email" name="customer_email" placeholder="Tài Khoản"/>
							<input type="password" name="customer_password" placeholder="Mật Khẩu"/>
                            <input type="text" name="customer_phone" placeholder="Số điện thoại"/> 
							<button type="submit" class="btn btn-default">Đăng Ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

    @endsection