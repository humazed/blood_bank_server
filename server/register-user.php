<?php

include 'DB.php';
// get content input and create json object to parse it
$data = file_get_contents("php://input");
$obj = json_decode($data);
// create db instance to use marei db queris 
$db = DB::getInstance();
// set type of header response to application/json for respone 
header('Content-Type: application/json');
// check if data sent and available from 
if (!isset($obj->{'user_name'})) {
    print "{\"status\":0,\"message\":\"Username is Missing !\"}";
} else if (!isset($obj->{'id'})) {
    print "{\"status\":0,\"message\":\"id is Missing !\"}";
} else if (!isset($obj->{'password'})) {
    print "{\"status\":0,\"message\":\"Password is Missing !\"}";
} else if (!isset($obj->{'blood_type'})) {
    print "{\"status\":0,\"message\":\"Blood type is Missing !\"}";
} else if (!isset($obj->{'fcm_registration_token'})) {
        print "{\"status\":0,\"message\":\"fcm_registration_token type is Missing !\"}";
} else {
    $username = $obj->{'user_name'};
    $id = $obj->{'id'};
    $password = $obj->{'password'};
    $blood_type = $obj->{'blood_type'};
    $fcm_registration_token = $obj->{'fcm_registration_token'};

    $check_user_id = $db->table('users')->where('id', '=', $id)->get();

    if ($db->getCount() > 0) {
        print '{"status":2,"message":"id Already Registered"}';

    } else {

        $insert_new_user = $db->insert('users',
            [
                'user_name' => $username,
                'id' => $id,
                'password' => $password,
                'blood_type' => $blood_type,
                'fcm_registration_token' => $fcm_registration_token
            ]);

        print $insert_new_user;

        if ($insert_new_user) {
            print '{"status":1,"message":"User Registered Successfully"}';
        } else {
            print '{"status":0,"message":"Error Registering User"}';
        }
    }


}




