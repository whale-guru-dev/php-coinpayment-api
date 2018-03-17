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
	<title>Test Ether Transaction Site</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<link rel="stylesheet prefetch" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
	
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Test For Ether Transaction</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="logout.php">LOG OUT</a></li>
    </ul>
  </div>
</nav>
<div class="row">
    <div class="top-title text-center">
        <h2>Deposits & Withdrawals</h2>
        <h4>The rate of ETH is <span id="etha"></span> USD</h4>
        <h4>The rate of LTCT is <span id="ltcta"></span> USD</h4>
        <h4>Your Wallet Ballance ETH : <?php echo number_format($USER['eth'],8,'.',''); ?></h4>
        <h4>Your Wallet Ballance LTCT: <?php echo number_format($USER['ltct'],8,'.',''); ?></h4>
        <br><br>
    

        <div id="loading_spinner" style="display:none;">
        
            <h4>Generating Deposit Addresses...</h4>

        </div>
        
        <div id="loading_spinner_with" style="display:none;">
        
            <h4>Pending Withdrawal Request...</h4>

        </div>
        <div class="my_update_panel"></div>
    </div>

</div>

<div class="row margin-top" id="enaxa" style="display:none;">
    <div class="col-sm-12">
        <div class="box dashboard-table">
            <div class="box-content">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th class="text-center">Coin</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Total Amount</th>
                        <th class="text-center">Total USD</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>ETH</td>
                        <td>Ethereum</td>
                        <td><?php echo number_format($USER['eth'],8,'.',''); ?> ETH</td>
                        <td><?php echo number_format($preteth,2,'.',','); ?> USD</td>
                        <td>

                            <button class="makeDeposit" data-balance="<?php echo number_format($USER['eth'],8,'.',''); ?>" data-shortn="ETH"    data-toggle="modal" data-address="<?php echo $totxa['eth'];?>" data-target="#diposit" >Deposit</button>
                            <button class="makeWithdrawal" data-toggle="modal" data-shortn="ETH" data-target="#withdrow">Withdraw</button>

                        </td>
                    </tr>
                    <tr>
                        <td>LTCT</td>
                        <td>Litecoin Testnet</td>
                        <td><?php echo number_format($USER['ltct'],8,'.',''); ?> LTCT</td>
                        <td><?php echo number_format($pretltct,2,'.',','); ?> USD</td>
                        <td>

                            <button class="makeDeposit" data-balance="<?php echo number_format($USER['ltct'],8,'.',''); ?>" data-shortn="LTCT"    data-toggle="modal" data-address="<?php echo $totxa['ltct'];?>" data-target="#diposit" >Deposit</button>
                            <button class="makeWithdrawal" data-toggle="modal" data-shortn="LTCT" data-target="#withdrow">Withdraw</button>

                        </td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>

<?php if(!empty($totxa['eth'])&& !empty($totxa['ltct'])) {
?>
    <script>
        $('#enaxa').show();
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
                $('.my_update_panel').html(data);
//Moved the hide event so it waits to run until the prior event completes
//It hide the spinner immediately, without waiting, until I moved it here
                $('#loading_spinner').hide();
               // location.reload();
                $('#enaxa').show();

            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    </script>
<?php } ?>
<script>
	$(document).on("click", ".makeDeposit", function () {
	        var adresa = $(this).data('address');
	        var nume = $(this).data('shortn');
	        var balance = $(this).data('balance');
	        $("#adresix").text( adresa );
	        $("#namex").text( nume );
	        $("#namexx").text( nume );
	        $("#balancex").text( balance );
    	});
    	
    	$(document).on("click", ".makeWithdrawal", function () {
	        
	        var coin = $(this).data('shortn');
	        
	        $("#coin").val(coin);

    	});
    	
    	function withdraw(){
    		$('#withdrow').modal('hide');
    		$('#loading_spinner_with').show();
	    	$.ajax({
	            url: 'withdrawal.php',
	            type: 'POST',
	            data:{
	                'cax': '<?php echo $USER['email']; ?>',
	                'addr': $("#wAddr").val(),
	                'amount': $("#wAmount").val(),
	                'coin': $("#coin").val(),
	                'ca$libri': 'no$libri'
	            },
	            dataType: 'html',
	            success: function(data) {
	                $('.my_update_panel').html(data);
	//Moved the hide event so it waits to run until the prior event completes
	//It hide the spinner immediately, without waiting, until I moved it here
	                $('#loading_spinner_with').hide();
	                
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
            document.getElementById('ltcta').innerHTML = data['ltct'];
            
        });
    }, 3000);
    
</script>
</body>
</html>
