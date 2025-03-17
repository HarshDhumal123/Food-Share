<?php
$page = "My Requests";
include_once("./adders/header.php");

if ($_SESSION['category'] == '0') {
    $getRequests = json_decode(select_query($con, "*", "food_request_master", "enabled='1' AND isPicked IS NOT NULL AND pickedBy=" . $_SESSION['uid'], "", "", ""));
} else {
    $getRequests = json_decode(select_query($con, "*", "food_request_master", "enabled='1' AND createdBy=" . $_SESSION['uid'], "", "", ""));
}
?>
<!--Container Main start-->
<div class="m-3 form-div">
    <div class="row">
        <h4 class="text-uppercase"><?php echo $page; ?></h4>
    </div>

    <label class="mt-3"><b><?php echo $_SESSION['category'] == '0' ? "Selected Requests" : "Select Request"; ?></b></label>
    <div class="row">
        <?php
        foreach ($getRequests as $request) {
            $requestDetails = json_decode(select_query($con, "*", "food_request_details_master", "enabled='1' AND frId=" . $request->id, "", "", ""));
            $requestDocumentDetails = json_decode(select_query($con, "*", "food_request_document_master", "enabled='1' AND frId=" . $request->id, "", "", ""));
        ?>
            <div class="col-md-3 my-2">
                <div class="card" id="<?php echo encryption($request->id); ?>">
                    <?php if (count($requestDocumentDetails) > 0) { ?>
                        <img class="card-img-top" src="<?php echo $requestDocumentDetails[0]->docPath; ?>" alt="Card image cap" height="200">
                    <?php } else { ?>
                        <img class="card-img-top" src="./assets/images/icon/dummy-img.jpg" alt="Card image cap" height="200">
                    <?php } ?>

                    <div class="card-body">
                        <p class="w-100 text-center">
                            <span class="badge badge-pill badge-warning mx-auto"><?php echo $request->isFoodOrCrop == '1' ? "Crop" : "Food"; ?></span>
                        </p>
                        <h5 class="card-title"><?php echo $requestDetails[0]->name; ?></h5>
                        <p class="card-text"><?php echo $requestDetails[0]->description; ?></p>
                    </div>

                    <div class="card-footer text-center bg-white">
                        <?php if ($_SESSION['category'] != '0') { ?>
                            <a class="mx-2" href="add_request.php?pref=<?php echo encryption($request->id); ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>

                            <a class="mx-2" href="delete_request.php?pref=<?php echo encryption($request->id); ?>" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
                        <?php } else { ?>
                            <a class="mx-2" href="view_request.php?pref=<?php echo encryption($request->id); ?>" data-toggle="tooltip" data-placement="top" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>

</div><!-- /.container-fluid -->

<?php
include_once "./adders/footer.php";
?>

<script>
    $('.card').on('click', function() {
        var id = $(this).attr('id');

        window.location.href = "view_request.php?pref=" + id;
    });
</script>