<html lang="en" class="">
<head>
<link rel="stylesheet prefetch" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
<style class="cp-pen-styles">
body {
  background: #eee !important;
}

.wrapper {
  margin-top: 80px;
  margin-bottom: 80px;
}

.form-signin {
  max-width: 380px;
  padding: 15px 35px 45px;
  margin: 0 auto;
  background-color: #fff;
  border: 1px solid rgba(0, 0, 0, 0.1);
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 30px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 20px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
</head>
<body>
  <div class="wrapper">
    <form class="form-signin" id="login-form">       
      <h2 class="form-signin-heading">Please login</h2>
      <input type="text" class="form-control" name="username" id="username" placeholder="Email Address" required="" =""="">
      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="">      
      <label class="checkbox">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
      </label>
      <div id="working"></div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
      <br>
	<br>
	<div id="error"></div>
    </form>
  </div>
	<p style="text-align: center; font-weight: bold;">
	Don't Have An Account? <a href="register.php"> Register Now </a> 
	</p>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>


<script>
  
$('document').ready(function()
{ 
     /* validation */
  $("#login-form").validate({
      rules:
   {
   password: {
   required: true,
   },
   username: {
            required: true,

            },
    },
       messages:
    {
            password:{
                      required: ""
                     },
            username: "",
       },
    submitHandler: submitForm 
       });  
    /* validation */
    
    /* login submit */
    function submitForm()
    {  
   var data = $("#login-form").serialize();
    
   $.ajax({
    
   type : 'POST',
   url  : 'checklogin.php',
   data : data,
   beforeSend: function()
   { 
    $("#error").fadeOut();
    $("#working").html('<div class="btn btn-success btn-lg uppercase btn-block abir" style=" text-align: center;"><strong class="block" style="font-weight: bold;">  <i class = "fa fa-spinner fa-spin"></i>  Validating Your Data.... </strong></div>');
   },
   success :  function(response)
      {      
     if(response=="ok"){
         
      $("#working").html('<div class="alert alert-success alert-dismissable"><h4 class="block"> <i class="fa fa-check"></i> &nbsp; Success! Redirecting to Dashboard...</h4></div>');
      setTimeout(' window.location.href = "dashboard.php"; ',4000);
     }
     else{
         
      $("#error").fadeIn(1000, function(){      
    $("#error").html('<div class="alert alert-danger"> <i class="fa fa-times"></i> &nbsp; '+response+' !</div>');
           $("#working").html('');
         });
     }
     }
   });
    return false;
  }
    /* login submit */
});

</script>
</body>
</html>