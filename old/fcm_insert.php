<?php

require "init.php";


$fcm_token = $_POST["fcm_token"];
$sql = "insert into fcm_info values ('" . $fcm_token . "');";
//$sql = "insert into fcm_info values ('asdasd');";
mysqli_query($con, $sql);
mysqli_close($con);
