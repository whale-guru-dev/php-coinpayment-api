<?php
require_once('./config.php');

if(isset($_POST["username"])&&isset($_POST["password"])){
	$username=$_POST["username"];
	$password=$_POST["password"];
	$mdpass = md5($password);


    $data = $db->query("SELECT password FROM user WHERE email='" . $username . "'")->fetch();

    if ($data[0] == $mdpass) {

        $_SESSION['username'] = $username;

        echo "ok"; // log in

    } else {

        echo "Combination of Username And Password is Wrong";

    }  
}

exit();

?>