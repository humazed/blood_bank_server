<?php
include 'DB.php';
// get content input and create json object to parse it

#API access key from Google API's Console
define('API_ACCESS_KEY', 'AAAAZ5yL7yo:APA91bGxn3PJ1s2x6csFuNfbUzGv_M-aqILZXquhh-QVZRAa50mFuXZ0fSrCaLRbYZobf5wyQyj7y7lbUzQ830OxsqO_Xvs_h0qfQ_0TuhiR5j880cjgO4shvr4YtPxlngRfX8xIycuv');

$id = $_GET['id'];
$title = $_GET['title'];
$message = $_GET['message'];


$db = DB::getInstance();

$fcm_registration_token = $db->table('users')
    ->where('id', '=', $id)
    ->select('fcm_registration_token')
    ->get()->first()->{'fcm_registration_token'};;


//$registrationIds = "dAL9iAFlobA:APA91bHVRkwR4PgpXxDjDF_hkyTEz0dF4sn02uFT06egE-PB--tG7_x5iaTVJkFI7eJdpmPcXIQxq8VOC9H7PzZwPXDtlV_rVvN5-3jqjZb3C9jJ3mt0WjZjBvzciQtTQEWNX3jcjzWj";

#prep the bundle
$msg = array
(
    'body' => $message,
    'title' => $title,
);

$fields = array
(
    'to' => $fcm_registration_token,
    'notification' => $msg
);


$headers = array
(
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);

#Send Reponse To FireBase Server
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
curl_close($ch);

#Echo Result Of FireBase Server
echo $result;