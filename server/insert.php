<?php
include 'DB.php';
// get content input and create json object to parse it

$db = DB::getInstance();
// set type of header response to application/json for respone
// check if data sent and available from
$username = 'username';
$email = 'email2';
$password = 'password';
$blood_type = 'B';


echo "hello   ";

//$reg = $db->table('users')
//    ->where('id', '=', '\'id2')
//    ->select('fcm_registration_token')
//    ->get()->first()->{'fcm_registration_token'};
//
//echo $reg;



$check_email_password = $db->table('users')
    ->where('id', '=', '003')
    ->where("password", "=", 'pass')
    ->select('_id,user_name, id')
    ->get()->first();

echo $check_email_password;

echo $db->getCount();




//$check_user_email = $db->table('users')->where('email', '=', $email)->get();
//
//if ($db->getCount() > 0) {
//    print '{"status":2,"message":"Email Already Registered"}';
//
//} else {
//
//    $insert_new_user = $db->insert('users',
//        [
//            'user_name' => $username,
//            'email' => $email,
//            'password' => $password,
//            'blood_type' => $blood_type
//        ]);
//
//    print $insert_new_user;
//
//    if ($insert_new_user) {
//        print "{\"status\":1,\"message\":\"User Registered Successfully |{$insert_new_user}|\"}";
//    } else {
//        print "{\"status\":0,\"message\":\"Error Registering User |{$insert_new_user}|\"}";
//    }
//}
