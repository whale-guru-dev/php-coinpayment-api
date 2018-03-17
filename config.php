<?php
$dbname = "";
$dbhost = "";
$dbuser = "";
$dbpass = "";


try{

$db =new PDO( "mysql:host=$dbhost; dbname=$dbname; charset=utf8", "$dbuser", "$dbpass");

} catch(Exception $e){
    echo ($e);
  echo "Problem with the database connection";
}

session_start();

function redirect($url)
{
echo "<meta http-equiv=\"refresh\" content=\"0; url=$url\" />";
exit;
}
?>
