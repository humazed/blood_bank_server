<?php
include 'DB.php';


DEFINE('DB_USER', 'id1966039_root');
DEFINE('DB_PASSWORD', 'rootroot');


// get content input and create json object to parse it
$data = file_get_contents("php://input");
$obj = json_decode($data);
// create db instance to use marei db queris
$db = DB::getInstance();
// set type of header response to application/json for respone
header('Content-Type: application/json');
// check if data sent and available from
if (!isset($obj->{'response'})) {
    print "{\"status\":0,\"message\":\"response is Missing !\"}";
} else {
    $response = $obj->{'response'};
    $id = $obj->{'id'};

    $insert_new_user = $db->insert('response',
        [
            'id' => $id,
            'response' => $response
        ]);


    print $insert_new_user;

    if ($insert_new_user) {
        print '{"status":1,"message":"User Registered Successfully"}';
    } else {
        print '{"status":0,"message":"Error Registering User"}';
    }

//    $rows = $db->table('response')
//        ->select('id,response')
//        ->get()->toArray();
//
//    echo '<table align="left"
//cellspacing="5" cellpadding="8">
//
//<tr><td align="left"><b>id</b></td>
//<td align="left"><b>response</b></td></tr>';
//
//// mysqli_fetch_array will return a row of data from the query
//// until no further data is available
//    foreach ($rows as $row) {
//        echo '<tr><td align="left">' .
//            $row['id'] . '</td><td align="left">' .
//            $row['response'] . '</td>';
//
//        echo '</tr>';
//    }
//
//    echo '</table>';
//    echo $response;
}

$dbo = new PDO('mysql:host=localhost;dbname=id1966039_blood_bank;charset=utf8mb4',
    DB_USER, DB_PASSWORD);

// Create a query for the database
$query = "SELECT id,response FROM response";

// Get a response from the database by sending the connection
// and the query
$rows = $dbo->query($query);

//if ($rows->rowCount() > 0) {
//    echo '<table align="left"
//cellspacing="5" cellpadding="8">
//
//<tr><td align="left"><b>id</b></td>
//<td align="left"><b>response</b></td></tr>';
//
//// mysqli_fetch_array will return a row of data from the query
//// until no further data is available
//    foreach ($rows as $row) {
//        echo '<tr><td align="left">' .
//            $row['id'] . '</td><td align="left">' .
//            $row['response'] . '</td>';
//
//        echo '</tr>';
//    }
//
//    echo '</table>';
//
//} else {
//    echo "Couldn't issue database query<br />";
//}

// If the query executed properly proceed
if ($rows->rowCount() > 0) {

// mysqli_fetch_array will return a row of data from the query
// until no further data is available
    echo "id\tresponse";
    foreach ($rows as $row) {
        echo $rows['id'] . "   \t   " . $row['response'];
        echo "\n\n";
    }

}