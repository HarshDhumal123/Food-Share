<?php
$page = "Add Request";
include_once "./adders/header.php";

$cropNameErr = $foodNameErr = $quantityErr = $croppedOn =  $croppedOnErr = $categoryErr = $madeOnErr = $expireOnErr = $expectedPriceErr = $expireOnErr = $descriptionErr = $addressErr = $dinner_lunchErr = $cropImgErr = $foodImgErr = '';

if (isset($_GET['pref'])) {
    $requestId = decryption($_GET['pref']);

    $updateResult = update_query($con, "food_request_master", "enabled='0'", "id=" . $requestId);

    if ($updateResult != '') {
        $updateRequestResult = update_query($con, "food_request_details_master", "enabled='0'", "frId=" . $requestId);
        $updateDocumentResult = update_query($con, "food_request_document_master", "enabled='0'", "frId=" . $requestId);

        if ($updateRequestResult != '' && $updateDocumentResult != '') {
            echo '<script>swal({title: "Your request has been deleted successfully",type: "success",button: "Ok"}).then(function() {window.location.href = "requests.php";});</script>';
        } else {
            echo '<script>swal({title: "Something went wrong",type: "error",button: "Ok"}).then(function() {window.location.href = "index.php";});</script>';
        }
    } else {
        echo '<script>swal({title: "Something went wrong",type: "error",button: "Ok"}).then(function() {window.location.href = "index.php";});</script>';
    }
}
?>
<?php
include_once "./adders/footer.php";
?>