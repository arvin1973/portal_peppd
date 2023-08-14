<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?=base_url();?>assets/login_v1/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login_v1/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login_v1/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login_v1/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login_v1/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login_v1/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login_v1/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login_v1/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login_v1/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login_v1/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login_v1/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100" style="background-image: url('<?=base_url();?>assets/login_v1/images/bg-01.jpg'); background-repeat: no-repeat; background-size: cover;">
				<form class="login100-form validate-form" action="<?=base_url();?>auth/C_loginController/login_action" method="POST" style="width: 485px; background-color: rgba(255, 255, 255, 0.5);">

                    <?php if($this->session->flashdata('message') == TRUE) { ?>
                        <div class="alert alert-warning" role="alert">
                            <?php echo $this->session->flashdata('message'); ?>
                        </div>
                    <?php } ?>
                    
					<div class="card m-b-20" style="background-image: linear-gradient(to left, #DF0241 30%, #0017ba 100%);">
					  <div class="card-body">
					    <span class="login100-form-title text-light">
							<b>PEPPD ADMIN LOGIN</b>
						</span>
					  </div>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Email is required">
						<input class="input100" type="email" name="email" required="">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>				
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Don't have an account? <a href="#">Register here</a>
						</span>
					</div>
				</form>

				<!-- <div class="login100-more" style="background-image: url('login_v1/images/bg-01.jpg'); width: calc(100% - 485px);">
				</div> -->
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="<?=base_url();?>assets/login_v1/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url();?>assets/login_v1/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url();?>assets/login_v1/vendor/bootstrap/js/popper.js"></script>
	<script src="<?=base_url();?>assets/login_v1/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url();?>assets/login_v1/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url();?>assets/login_v1/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?=base_url();?>assets/login_v1/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url();?>assets/login_v1/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url();?>assets/login_v1/js/main.js"></script>

</body>
</html>