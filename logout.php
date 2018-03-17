<?php 
require_once('./config.php');

if(session_destroy())

    redirect("index.php");

exit;
?>