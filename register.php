<?php 
require_once('./config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Test Ether Transaction Site</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<link rel="stylesheet prefetch" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
	
</head>
<body>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <div class="portlet light portlet-fit" style="margin-top: 40px;">


            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject bold uppercase basecolor">Registration Form</span>
                </div>

            </div>


            <div class="portlet-body">


                <?php
                    if ($_POST) {
                        $email = $_POST["email"];

                        $password = $_POST["password"];
                        $password2 = $_POST["password2"];


                        $eee = $db->query("SELECT COUNT(*) FROM user WHERE email='" . $email . "'")->fetch();
			
			if($eee[0] != 0) {?>
				<div class="alert alert-danger alert-dismissable">
					Email Already Exist in our database... Please Use another Email!!
				</div>
			<?php }		

                        if($password != $password2 ) { ?>
                        	<div class="alert alert-danger alert-dismissable">
					Password and Confirm Password not match!!!
				</div>
                        <?php } ?>
			
			<?php 
                        if (($eee[0] == 0)&&($password == $password2)) {
                            $passmd = md5($password);
                            $res = $db->query("INSERT INTO user SET  email='" . $email . "', password='" . $passmd . "'");
                            if ($res) { 
                           
                                $_SESSION['username'] = $email;

                                echo "<meta http-equiv=\"refresh\" content=\"2; url=dashboard.php\" />";


                            } else { ?>
                                	<div class="alert alert-danger alert-dismissable">
					Some Problem Occurs, Please Try Again. 
					</div>
                           <?php }
                        }
                       } 

                    ?>


                    <form method="post" action="" id="reg">

                        <div class="row">

                            <br><br>
                            <div class="col-md-12">
                                <h4 class="block">Your E-mail:</h4>
                                <div class="input-group">
					<span class="input-group-addon">
					<i class="fa fa-envelope fa-2x"></i>
					</span>
                                    <input name="email" id="email" class="form-control input-lg"
                                           placeholder="Email Address" type="email" required="">
                                </div>
                            </div>

                        </div><!-- row -->


                        <div class="row">

                            <br><br>
                            <div class="col-md-6">
                                <h4 class="block">Create a Password:</h4>
                                <div class="input-group">
					<span class="input-group-addon">
					<i class="fa fa-lock fa-2x"></i>
					</span>
                                    <input name="password" id="password" class="form-control input-lg" type="password">
                                </div>



                            </div>


                            <div class="col-md-6">
                                <h4 class="block">Confirm Password:</h4>
                                <div class="input-group">
					<span class="input-group-addon">
					<i class="fa fa-lock fa-2x"></i>
					</span>
                                    <input name="password2" id="confirmPassword" class="form-control input-lg"
                                           type="password">
                                </div>


                                <span id="noti6" class="fa fa-times" style="color:red; display:none;">Comfirm Password Must Match With Password</span>


                            </div>

                        </div><!-- row -->


                        <div class="row">

                            <br><br>
                            <div class="col-md-12">

                                <button type="submit" class="btn btn-primary btn-lg btn-block">Create Account</button>

                            </div>

                        </div><!-- row -->


                    </form>

            </div>
        </div>


    </div>
</div>
<!-- row -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script>


    $(document).ready(function () {

        $("#location").val('<?php echo $cc; ?>');



        $("#password").focusin(function () {
            $('#password').addClass('error');
            $("#info").show();
        });


        $("#confirmPassword").focusin(function () {
            $("#noti6").show();
            $('#confirmPassword').addClass('error');
        });


        $('#confirmPassword').on('input', function (e) {

            var pswd = $('#password').val();
            var pscn = $('#confirmPassword').val();


            if (pswd == pscn) {
                $('#noti6').removeClass('fa fa-times').addClass('fa fa-check');
                $('#noti6').css('color', 'green');
                err6 = 0;
                $('#confirmPassword').removeClass('error').addClass('valid');
            } else {

                $('#noti6').removeClass('fa fa-check').addClass('fa fa-times');
                $('#noti6').css('color', 'red');
                err6 = 1;
                $('#confirmPassword').removeClass('valid').addClass('error');
            }


        });


        $("form").submit(function (e) {


            err = err6;

            if (err != 0) {
                e.preventDefault();
            }
        });


    });


</script>
	
</body>
</html>