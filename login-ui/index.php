<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="admin, dashboard" />
	<meta name="author" content="DexignZone" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Assesment Protrol" />
	<meta property="og:title" content="Assesment Protrol" />
	<meta property="og:description" content="Assesment Protrol" />
	<meta property="og:image" content="social-image.png"/>
	<meta name="format-detection" content="telephone=no">
    <title>Assesment Protrol </title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	<link href="assets/login-assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="assets/login-assets/css/style.css" rel="stylesheet">

</head>


<style>
    .sidebar-right {
  display: none;
}

.btn-buy-now {
  display: none;
}

.dz-demo-panel .dz-demo-trigger {

    display: none;
}
</style>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="images/logo-full.png" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4">Student Account</h4>


                                    <form method="post" id="examineeLoginFrm" class="login100-form validate-form">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input class="input100 form-control" type="text" name="username" placeholder="Please Enter your username">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                           
                                            <input class="input100 form-control" type="password" name="pass" placeholder="Please Enter your password">
                                        </div>
                                    
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block login100-form-btn">Sign Me In</button>
                                        </div>
                                    </form>
                             


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="assets/login-assets/vendor/global/global.min.js"></script>
	<script src="assets/login-assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="assets/login-assets/js/custom.min.js"></script>
	<script src="assets/login-assets/js/deznav-init.js"></script>
	<script src="assets/login-assets/js/demo.js"></script>
    <script src="assets/login-assets/js/styleSwitcher.js"></script>
 


    <script src="login-ui/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="login-ui/vendor/animsition/js/animsition.min.js"></script>
	<script src="login-ui/vendor/bootstrap/js/popper.js"></script>
	<script src="login-ui/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="login-ui/vendor/select2/select2.min.js"></script>
	<script src="login-ui/vendor/daterangepicker/moment.min.js"></script>
	<script src="login-ui/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="login-ui/vendor/countdowntime/countdowntime.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>

	<script src="login-ui/js/main.js"></script>

    <script>
        // Admin Log in
$(document).on("submit","#examineeLoginFrm", function(){



 $.post("query/loginExe.php", $(this).serialize(), function(data){
    if(data.res == "invalid")
    {
      Swal.fire(
        'Invalid',
        'Please input valid email / password',
        'error'
      )
    }
    else if(data.res == "success")
    {
      $('body').fadeOut();
      window.location.href='home.php';
    }
 },'json');

 return false;
});
    </script>
</body>

</html>