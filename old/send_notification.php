<?php

require "init.php";
$message = $_POST['message'];
$title = $_POST['title'];
$path_to_fcm = 'https://fcm.googleapis.com/fcm/send';
$server_key = "AAAAWaEgXRo:APA91bHE98vRX6Gst67J4X2qNmulI_GGWbbNL8dV66tvsfu9PQyyIRtey6T92XwVkt-xFIYRcGfsSnCsEHeuh7jkDK3wTbh1aD0U75NY1FhaGFEdWaQtdSTlYGqyNlDfoXRv11loW38M";
$sql = "select fcm_token from fcm_info";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_row($result);
$key = $row[0];

$headers = array(
    'Authorization:key=' . $server_key,
    'content-Type:application/json'
);
$fields = array('to' => $key, 'notification' => array('title' => $title, 'body' => $message));

$payload = json_encode($fields);

$curl_session = curl_init();

curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
curl_setopt($curl_session, CURLOPT_POST, true);
curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_session, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);

$result = curl_exec($curl_session);

curl_close($curl_session);
mysqli_close($con);


?>