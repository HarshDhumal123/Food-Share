<?php
ob_start();
session_start();

include_once "../config/database.php";
include_once "./functions.php";

$request_id = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['requestId'])));
$flag = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['flag'])));
$id = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['id'])));

if ($flag == 'accept') {
    $result[] = update_query($con, "food_request_master", "isPicked='1', pickedBy=" . $id, "id=" . $request_id);
}

if ($flag == 'deny') {
    $requestDetailsColumns = array('userId', 'requestId');
    $requestDetailsValue = array($id, $request_id);
    
    $requestDetailsId = insert_query($con, $requestDetailsColumns, $requestDetailsValue, "food_request_rejected_master");
    
    $result = [];
    if ($requestDetailsId != '')
    array_push($result, true);
}

if($flag == 'delivered') {
    $result[] = update_query($con, "food_request_master", "isDelivered='1'", "id=" . $request_id);
}

echo json_encode($result);
