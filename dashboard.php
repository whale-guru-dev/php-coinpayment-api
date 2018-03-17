<?php 

require_once('./config.php');

$user = $_SESSION['username'];
$USER= $db->query("SELECT * FROM user WHERE email='".$user."'")->fetch();
$totxa = $db->query("SELECT * FROM address WHERE who=".$USER['id'])->fetch();

$json = file_get_contents('http://ns1-216-198.superdnsserver.net/ajax.php');
$obj = json_decode($json);

$preteth=str_replace(',','',$obj->eth)*$USER['eth'];
$pretltct=str_replace(',','',$obj->ltct)*$USER['ltct'];

$total_usd=$preteth+$pretltct;
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<title>Deposit</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
<link rel="stylesheet" href="assets/plugins/morrisjs/morris.min.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="assets/plugins/multi-select/css/multi-select.css">
<!-- Bootstrap Spinner Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<!-- noUISlider Css -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/color_skins.css">
</head>
<body class="theme-cyan">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/logo.svg" width="48" height="48" alt="sQuare"></div>
        <p>Please wait...</p>        
    </div>
</div>
<div class="overlay_menu">
    <button class="btn btn-primary btn-icon btn-icon-mini btn-round"><i class="zmdi zmdi-close"></i></button>
    
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- Top Bar -->
<nav class="navbar">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html"><img src="assets/images/logo.svg" width="30" alt="sQuare"><span class="m-l-10">Admin</span></a>
            </div>
        </li>        
        <li>
            <a href="javascript:void(0);" class="menu-sm" data-close="true">
                <i class="zmdi zmdi-arrow-left"></i>
                <i class="zmdi zmdi-arrow-right"></i>
            </a>
        </li>
        
        
        <li class="dropdown task"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-flag"></i>
            <span class="label-count">3</span>
            </a>
            <ul class="dropdown-menu pullDown">
                <li class="header">Project</li>
                <li class="body">
                    <ul class="menu tasks list-unstyled">
                        <li>
                            <a href="javascript:void(0);">
                                <span class="text-muted">Project 1 <span class="float-right">29%</span></span>
                                <div class="progress">
                                    <div class="progress-bar l-turquoise" role="progressbar" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100" style="width: 29%;"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <span class="text-muted">Project 2 <span class="float-right">78%</span></span>
                                <div class="progress">
                                    <div class="progress-bar l-slategray" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%;"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <span class="text-muted">Project 3 <span class="float-right">45%</span></span>
                                <div class="progress">
                                    <div class="progress-bar l-parpl" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <span class="text-muted">Project 4 <span class="float-right">68%</span></span>
                                <div class="progress">
                                    <div class="progress-bar l-coral" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <span class="text-muted">Project 5 <span class="float-right">21%</span></span>
                                <div class="progress">
                                    <div class="progress-bar l-amber" role="progressbar" aria-valuenow="21" aria-valuemin="0" aria-valuemax="100" style="width: 21%;"></div>
                                </div>
                            </a>
                        </li>                        
                    </ul>
                </li>
                <li class="footer"><a href="javascript:void(0);">View All</a></li>
            </ul>
        </li>        
        
        <li class="float-right">            
            <a href="javascript:void(0);" class="fullscreen hidden-md-down hidden-sm-down" data-provide="fullscreen"><i class="zmdi zmdi-fullscreen"></i></a>            
           
            <a href="logout.php" class="mega-menu"><i class="zmdi zmdi-power"></i></a>
        </li>        
    </ul>
</nav>
<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="menu">        
        <ul class="list">
            <li>
                <div class="user-info m-b-20">
                    <div class="image"><a href="profile.html"><img src="assets/images/profile_av.jpg" alt="User"></a></div>
                    <div class="detail">
                        <h4>Michael</h4>
                        <p class="m-b-0">Manager</p>
                       
                        <a href="" title="Inbox"><i class="zmdi zmdi-edit"></i></a>
                        <a href="logout.php" title="Contact List"><i class="zmdi zmdi-power"></i></a>
                        
                    </div>
                </div>
            </li>
           
            <li class="active open"> <a href="index.html"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-gamepad"></i><span>Wallet</span></a>
               
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Tutorial</span></a>
               
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-swap-alt"></i><span>Other</span></a>
               
            </li>
            
        </ul>
    </div>
</aside>
<!-- Right Chatbar -->

<!-- Right Sidebar -->

<!-- Main Content -->
<section class="content home">
    <div id="loading_spinner" style="display:none;">
        <img src="assets/img/fluid-loader.gif">
        <h4>Processing...</h4>
    </div>
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Dashboard</h2>
                
            </div>            
            
        </div>
    </div>
    <div class="container-fluid" id="enaxa" style="display:none;">
        <div class="row clearfix">
			<div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="header">
                        <h2><strong>ETH-USD</strong> </h2>                        
                    </div>
                    <div class="body">
                        <h3 class="m-b-0"> $ <span class="m-b-0" id='etha'></span></h3>
                        
                        <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222"
                        data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(120, 184, 62)" data-spot-Color="rgb(63, 81, 181, 0.7)"
                        data-offset="90" data-width="100%" data-height="60px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)"
                        data-fill-Color="rgba(44,168,255, 0.2)">1,5,9,3,5,7,8,5,2,3,5,7</div>
                    </div>
                </div>
                
            </div> 
			<div class="col-lg-6 col-md-6">
                
                <div class="card">
                    <div class="header">
                        <h2><strong>ETH-EUR</strong> </h2>                        
                    </div>
                    <div class="body">
                        <h3 class="m-b-0">€ <span class="m-b-0" id='eth_eur'></span> </h3>
                        
                        <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222"
                        data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(120, 184, 62)" data-spot-Color="rgb(63, 81, 181, 0.7)"
                        data-offset="90" data-width="100%" data-height="60px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)"
                        data-fill-Color="rgba(128,133,233, 0.2)"> 4,5,2,8,4,8,7,4,8,5</div>
                    </div>
                </div>
            </div>
		</div>
		<div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-dark">
                    <div class="body text-center">
                        <div class="sparkline m-b-20" data-type="bar" data-width="97%" data-height="40px" data-bar-Width="1" data-bar-Spacing="8" data-bar-Color="#edbae7">1,2,3,4,5,4,3,2,1,2,3,4,5,6,7,8,7,6,5,4</div>
                        <h3 class="m-b-0 col-white"><?php echo number_format($USER['eth'],8,'.',''); ?> ETH</h3>
                        <small class="displayblock text-muted col-white">ETHEREUM - ERC20 </small>
                    </div>
					
                </div>
				<div class="text-center">
				<button class="btn btn-raised btn-primary btn-flat waves-effect makeDeposit" data-balance="<?php echo number_format($USER['eth'],8,'.',''); ?>" data-shortn="ETH"    data-toggle="modal" data-address="<?php echo $totxa['eth'];?>" data-target="#diposit" >DEPOSITE</button>
				</div>
            </div>
			<div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-dark">
                    <div class="body text-center">
                        <div class="sparkline m-b-20" data-type="bar" data-width="97%" data-height="40px" data-bar-Width="1" data-bar-Spacing="8" data-bar-Color="#edbae7">1,2,3,4,5,4,3,2,1,2,3,4,5,6,7,8,7,6,5,4</div>
                        <h3 class="m-b-0 col-white">$ <?php echo number_format($preteth,2,'.',','); ?></h3>
                        <small class="displayblock text-muted  col-white">AVAILABLE BALANCE</small>
                    </div>
                </div>
				
            </div>
			
			
        </div>
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>ETH DEPOSITE ADDRESS:</strong></h2>
                        
                    </div>
                    <div class="body">
                        
                            
                            <div class="form-group">                                
                                <input type="text" id="eth_address" class="form-control" value="<?php echo $totxa['eth'];?>"  readonly>
                            </div>
                           
                            <button id="btn-copy" data-clipboard-action="copy"  data-clipboard-target="#eth_address" class="btn ref-btn btn-raised btn-primary btn-round waves-effect pull-left">COPY</button>
                             <button type="button"  style="float: right" class="btn btn-raised btn-primary btn-round waves-effect pull-right">SCAN QR-CODE</button>
                             <div class="text-center">
                                 <span id="qrCod"></span>
                             </div>
                       
                    </div>
                    <div class="text-center">
                <button class="btn btn-raised m-b-10 btn-info btn-lg waves-effect makeWithdrawal" type="submit" data-toggle="modal" data-shortn="ETH" data-target="#withdrow">WITHDRAW</button>
                </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>ETH DEPOSITE ADDRESS:</strong></h2>
                        
                    </div>
                    <div class="body text-center">
                                <i class="material-icons">account_balance_wallet</i>
                                <h2><strong><?php echo number_format($USER['eth'],8,'.',''); ?> ETH</strong></h2>
                                <span>ETHEREUM WALLET</span>
                            </div>
                    <div class="text-center">
                <button class="btn btn-raised m-b-10 btn-info btn-lg waves-effect makeWithdrawal" type="submit" data-toggle="modal" data-shortn="ETH" data-target="#withdrow">WITHDRAW</button>
                </div>
                </div>

            </div>
        </div>
		<div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Withdraw</strong></h2>
                        
                    </div>
                    <div class="my_update_panel"></div>
                    <div class="body">
                        <form>
                            <label for="wAddr1">ETH Withdrawal Address:</label>
                            <div class="form-group">                                
                                <input type="text" id="wAddr1" class="form-control" placeholder="Enter address">
                            </div>
                            <label for="wAmount1">Amount</label>
                            <div class="form-group">                                
                                <input type="text" id="wAmount1" class="form-control" placeholder="Enter your max amount">
                            </div>
                            <div class="text-center">
                            <button type="button" onclick="withdraw_1()" class="text-center btn btn-raised btn-primary btn-round waves-effect">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
              
        

        
        
    </div>
</section>
<div id="diposit" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Deposit Now</h4>
            </div>
            <div class="modal-body">
                <div class="portlet box blue">

                    <div class="portlet-body">


                        <h4 style="text-align: center;"> SEND HOW MANY
                            <strong id="namex">BTC </strong> YOU WANT TO <strong id="adresix" style="word-wrap: break-word;"></strong><br>
                           <span id="qrCod_modal"></span>
                         Current Balance: <span id="balancex">0.000000</span>  <span id="namexx"></span>          <br>
                            <strong style="color: red;">Note: 2 confirmations required
                                to fund your account.</strong>
                        </h4>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="withdrow" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Withdrawal</h4>
            </div>
            <div class="modal-body">
                <p class="bg-success">Withdrawal function </p>
                <input type="hidden" name="coin" id="coin">
                <input type="text" class="form-control" name="wAddr" id="wAddr" placeholder="Enter Address to withdrawal">
                <br>
                <input type="text" class="form-control" name="wAmount" id="wAmount" placeholder="Enter Amount to withdrawal">
                <br>
                <button type="submit" onclick="withdraw()" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </div>
    </div>
</div>

<style>
    #qrCod > img{
        border:1px solid white;
    }
</style>

<script src="assets/js/qrcode.min.js"></script>
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="assets/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->
<script src="assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
<script src="assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js --> 
<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/js/pages/index.js"></script>
<script src="assets/js/pages/forms/advanced-form-elements.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>

<script src="assets/js/clipboard.min.js"></script>
<script>
    var clipboard = new Clipboard('#btn-copy', {
        text: function (trigger) {
            $('#btn-copy').blur();
            return trigger.getAttribute('aria-label');
        }
    });


    clipboard.on('success', function (e) {
        $('#btn-copy').html('Copied').attr('disabled', true);
        setTimeout(function () {
            $('#btn-copy').html('Copy').removeAttr('disabled');
        }, 5000);
    });

</script>

<?php if(!empty($totxa['eth'])) {
?>
    <script>
        $('#enaxa').show();
        
        var qrcode1 = new QRCode(document.getElementById("qrCod"), 'dashboard');


	qrcode1.clear(); // clear the code.
	var adresa1 = $('#eth_address').val();
	qrcode1.makeCode(adresa1);
    </script>
    
    

    <?php
}else{ ?>
    <script>

        $('#loading_spinner').show();

        $.ajax({
            url: 'generate_addr.php',
            type: 'POST',
            data:{
                'cax': '<?php echo $USER['email']; ?>',
                'ca$libri': 'no$libri'
            },
            dataType: 'html',
            success: function(data) {
                // $('.my_update_panel').html(data);
//Moved the hide event so it waits to run until the prior event completes
//It hide the spinner immediately, without waiting, until I moved it here
                $('#loading_spinner').hide();
                location.reload();
                $('#enaxa').show();

            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    </script>
<?php } ?>
<script>
var qrcode = new QRCode(document.getElementById("qrCod_modal"), 'dashboard');
    $(document).on("click", ".makeDeposit", function () {
    	qrcode.clear(); // clear the code.
            var adresa = $(this).data('address');
            var nume = $(this).data('shortn');
            var balance = $(this).data('balance');
            $("#adresix").text( adresa );
            $("#namex").text( nume );
            $("#namexx").text( nume );
            $("#balancex").text( balance );
             qrcode.makeCode(adresa);
        });
        


	function withdraw_1(){

            $('#loading_spinner').show();
            $.ajax({
                url: 'withdrawal.php',
                type: 'POST',
                data:{
                    'cax': '<?php echo $USER['email']; ?>',
                    'addr': $("#wAddr1").val(),
                    'amount': $("#wAmount1").val(),
                    'coin': 'ETH',
                    'ca$libri': 'no$libri'
                },
                dataType: 'html',
                success: function(data) {
                    $('.my_update_panel').html(data);
    //Moved the hide event so it waits to run until the prior event completes
    //It hide the spinner immediately, without waiting, until I moved it here
                    $('#loading_spinner').hide();
                    
                    $('#enaxa').show();
    
                },
                error: function() {
                    alert("Something went wrong!");
                }
            });
        }
        
        function withdraw(){
            $('#withdrow').modal('hide');
            $('#loading_spinner').show();
            $.ajax({
                url: 'withdrawal.php',
                type: 'POST',
                data:{
                    'cax': '<?php echo $USER['email']; ?>',
                    'addr': $("#wAddr").val(),
                    'amount': $("#wAmount").val(),
                    'coin': 'ETH',
                    'ca$libri': 'no$libri'
                },
                dataType: 'html',
                success: function(data) {
                    $('.my_update_panel').html(data);
    //Moved the hide event so it waits to run until the prior event completes
    //It hide the spinner immediately, without waiting, until I moved it here
                    $('#loading_spinner').hide();
                    
                    $('#enaxa').show();
    
                },
                error: function() {
                    alert("Something went wrong!");
                }
            });
        }
        
        setInterval(function () {

        $.getJSON('ajax.php', function(data) {
            
            document.getElementById('etha').innerHTML = data['eth'];
            document.getElementById('eth_eur').innerHTML = data['eth_eur'];
            // document.getElementById('ltcta').innerHTML = data['ltct'];
            
        });
    }, 3000);
    
</script>
</body>

</html>