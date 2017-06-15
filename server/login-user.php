<?php
include 'DB.php';
// get content input and create json object to parse it
$data = file_get_contents("php://input");
$obj = json_decode($data);
// create db instance to use marei db queris 
$db = DB::getInstance();
// set type of header response to application/json for respone 
header('Content-Type: application/json');
// check if id and password sent from client
if (!isset($obj->{'id'})) {
    print "{\"status\":0,\"message\":\"id is Missing !\"}";
} else if (!isset($obj->{'password'})) {
    print "{\"status\":0,\"message\":\"Password is Missing !\"}";
} else {
    // store user name and password in variables
    $userid = $obj->{'id'};
    $userpassword = $obj->{'password'};
    // make query using marei db 
    $check_id_password = $db->table('users')
        ->where('id', '=', $userid)
        ->where("password", "=", $userpassword)
        ->select('_id,user_name, id')
        ->get()->first();

    // check count of found results
    if ($db->getCount() > 0) {
        print "{\"status\":1,\"message\":\"Welcome !\",\"user\":$check_id_password}";

    } else {
        print "{\"status\":0,\"message\":\"Error in id or Password\",\"user\":null}";
    }
}









