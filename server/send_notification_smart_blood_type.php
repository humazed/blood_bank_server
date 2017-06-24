<?php
include 'DB.php';
// get content input and create json object to parse it

#API access key from Google API's Console
define('API_ACCESS_KEY', 'AAAAZ5yL7yo:APA91bGxn3PJ1s2x6csFuNfbUzGv_M-aqILZXquhh-QVZRAa50mFuXZ0fSrCaLRbYZobf5wyQyj7y7lbUzQ830OxsqO_Xvs_h0qfQ_0TuhiR5j880cjgO4shvr4YtPxlngRfX8xIycuv');

$blood_type = $_GET['blood_type'];
$title = $_GET['title'];
$message = $_GET['message'];

$db = DB::getInstance();

$condition = '';
if (strtolower($blood_type) == 'o') $condition = "'o' in topics";
elseif (strtolower($blood_type) == 'a') $condition = "'a' in topics && 'o' in topics";
elseif (strtolower($blood_type) == 'b') $condition = "'b' in topics && 'o' in topics";
elseif (strtolower($blood_type) == 'ab') $condition = "'o' in topics && 'a' in topics && 'b' in topics && 'ab' in topics";

#prep the bundle
$msg = [
    'body' => $message,
    'title' => $title
];

$fields = [
    'condition' => "\"$condition\"",
    'priority' => 'high',
    'data' => $msg
];


$headers = [
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
];

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