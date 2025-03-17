<?php
$page = "View Request";
include_once "./adders/header.php";

$cropNameErr = $foodNameErr = $quantityErr = $croppedOn =  $croppedOnErr = $categoryErr = $madeOnErr = $expireOnErr = $expectedPriceErr = $expireOnErr = $descriptionErr = $addressErr = $dinner_lunchErr = $cropImgErr = $foodImgErr = '';

if (isset($_GET['pref'])) {
    $requestId = decryption($_GET['pref']);

    $request = json_decode(select_query($con, "*", "food_request_master", "enabled='1' AND id=" . $requestId, "", "", ""));
    $requestDetails = json_decode(select_query($con, "*", "food_request_details_master", "enabled='1' AND frId=" . $requestId, "", "", ""))[0];
    $requestDocuments = json_decode(select_query($con, "*", "food_request_document_master", "enabled='1' AND frId=" . $requestId, "", "", ""));

    if ($request[0]->isFoodOrCrop == 1) {
        $cropName = $requestDetails->name;
        $quantity = $requestDetails->quantity;
        $unit = $requestDetails->unit;
        $madeOn = $requestDetails->madeOn;
        $description = $requestDetails->description;
        $expectedPrice = $requestDetails->price;
        $address = $requestDetails->address;

        $date = DateTime::createFromFormat('Y-m-d H:i:s', $madeOn);
        $croppedOn = $date->format('d-m-Y');
    } else if ($request[0]->isFoodOrCrop == 0) {
        $foodName = $requestDetails->name;
        $category = $requestDetails->category;
        $madeOn = $requestDetails->madeOn;
        $description = $requestDetails->description;
        $expireOn = $requestDetails->expireOn;
        $address = $requestDetails->address;

        $date = DateTime::createFromFormat('Y-m-d H:i:s', $madeOn);
        $madeOn = $date->format('d-m-Y H:i');
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $expireOn);
        $expireOn = $date->format('d-m-Y H:i');
    }
} else {
    echo '<script>swal({title: "Soemthing went wrong",type: "error",button: "Ok"}).then(function() {window.location.href = "requests.php";});</script>';
}

$isAcceptReject = false;

if (isset($_GET['aor']))
    $isAcceptReject = decryption($_GET['aor']);
?>

<!--Container Main start-->
<div class="m-3 form-div">
    <div class="row">
        <h4 class="text-uppercase"><?php echo $page; ?></h4>
    </div>

    <div class="row">
        <?php
        if ($request[0]->isDelivered) { ?>
            <div class="row py-2 text-center w-100 ml-0">
                <div class="text-success">
                    <i>Delivered On: <?php
                                        $time = new DateTime($request[0]->updatedOn, new DateTimeZone('UTC'));
                                        // than convert it to IST by
                                        $time->setTimezone(new DateTimeZone('Asia/Kolkata'));
                                        echo $time->format("Y-m-d H:i:s");
                                        ?>
                    </i>
                </div>
            </div>
        <?php }
        if ($request[0]->isFoodOrCrop == 1) { ?>
            <label class="my-3 locality-label"><b>Request Details</b></label>
            <?php if (!isset($_GET['aor']) && $request[0]->isDelivered == '0') { ?>
                <div class="row text-center w-100">
                    <div class="col-sm-2">
                        <input type="button" class="btn btn-sm btn-outline-success w-100" id="delivered" value="Request Delivered">
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Crop Name</label>
                        <input type="text" class="form-control form-control-sm" name="cropName" placeholder="Crop name" <?php echo isset($cropName) ? 'value="' . $cropName . '"' : ''; ?>>
                        <?php echo $cropNameErr != '' ? '<span class="text-danger">' . $cropNameErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" class="form-control form-control-sm" name="quantity" placeholder="Quantity" min="1" <?php echo isset($quantity) ? 'value="' . $quantity . '"' : ''; ?>>
                        <?php echo $quantityErr != '' ? '<span class="text-danger">' . $quantityErr . '</span>' : ''; ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Unit</label>
                        <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="unit">
                            <option value="" selected disabled>Select Unit</option>
                            <option value="kg" <?php echo isset($unit) && $unit == 'kg' ? 'selected' : ''; ?>>KG</option>
                            <option value="ton" <?php echo isset($unit) && $unit == 'ton' ? 'selected' : ''; ?>>TON</option>
                        </select>
                        <?php echo $quantityErr != '' ? '<span class="text-danger">' . $quantityErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Cropped on</label>
                        <input type="date" class="form-control form-control-sm" name="croppedOn" <?php echo isset($croppedOn) ? 'value="' . date('Y-m-d', strtotime(date($croppedOn))) . '"' : ''; ?>>
                        <?php echo $croppedOnErr != '' ? '<span class="text-danger">' . $croppedOnErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Crop Description</label>
                        <textarea name="description" rows="1" class="form-control form-control-sm" placeholder="Please enter detailed crop description"><?php echo isset($description) ? $description : ''; ?></textarea>
                        <?php echo $descriptionErr != '' ? '<span class="text-danger">' . $descriptionErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Expected Price</label>
                        <input type="number" class="form-control form-control-sm" name="expectedPrice" placeholder="Expected Price" min="0" <?php echo isset($expectedPrice) ? 'value="' . $expectedPrice . '"' : ''; ?>>
                        <?php echo $expectedPriceErr != '' ? '<span class="text-danger">' . $expectedPriceErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea name="address" rows="1" class="form-control form-control-sm" placeholder="Please enter detailed crop address"><?php echo isset($address) && $address != "" ? $address : ''; ?></textarea>
                        <?php echo $addressErr != '' ? '<span class="text-danger">' . $addressErr . '</span>' : ''; ?>
                    </div>
                </div>

                <?php if (isset($requestDocuments) && count($requestDocuments) > 0) {
                    foreach ($requestDocuments as $document) { ?>
                        <div class="col-md-4 text-center">
                            <img class="img-fluid rounded" src="<?php echo $document->docPath; ?>" height="200">
                        </div>
                    <?php }
                } else { ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Crop Photo</label>
                            <input type="file" name="cropPhoto[]" class="form-control form-control-file form-control-sm" multiple>
                            <?php echo $cropImgErr != '' ? '<span class="text-danger">' . $cropImgErr . '</span>' : ''; ?>
                        </div>
                    </div>

                    <div class="col-md-4 text-center">
                        <img class="img-fluid rounded" src="./assets/images/icon/dummy-img.jpg">
                    </div>
                <?php } ?>
            </div>
        <?php } else if ($request[0]->isFoodOrCrop == 0) { ?>
            <?php if (!isset($_GET['aor']) && $_SESSION['category'] == '0') { ?>
                <div class="row py-2 text-center w-100">
                    <div class="col-sm-2">
                        <input type="button" class="btn btn-sm btn-outline-success w-100" id="delivered" value="Request Delivered">
                    </div>
                </div>
            <?php } ?>
            <label class="my-3 locality-label"><b>Request Details</b></label>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Food Name</label>
                        <input type="text" class="form-control form-control-sm" name="foodName" placeholder="Food name" <?php echo isset($foodName) ? 'value="' . $foodName . '"' : ''; ?> disabled>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Baked On</label>
                        <input type="datetime-local" class="form-control form-control-sm" name="madeOn" placeholder="Baked on" <?php echo isset($madeOn) ? 'value="' . date('Y-m-d H:i', strtotime(date($madeOn))) . '"' : ''; ?> disabled>
                    </div>
                </div>

                <div class="col-md-4 my-auto">
                    <div class="form-group">
                        <label for="">Dinner/Lunch</label>
                        <div class="row">
                            <input type="radio" name="dinner_lunch" value="0" class="custom-control custom-radio custom-control-inline mx-3" <?php echo isset($category) && $category != '' && $category == '0' ? 'checked' : ''; ?> disabled> Dinner
                            <input type="radio" name="dinner_lunch" value="1" class="custom-control custom-radio custom-control-inline mx-3" <?php echo isset($category) && $category != '' && $category == '1' ? 'checked' : ''; ?> disabled> Lunch
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Food Description</label>
                        <textarea name="description" rows="1" class="form-control form-control-sm" placeholder="Please enter detailed food description" disabled><?php echo isset($description) ? $description : ''; ?></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Will Expire On</label>
                        <input type="datetime-local" class="form-control form-control-sm" name="expireOn" placeholder="Will Expire On" <?php echo isset($expireOn) ? 'value="' . date('Y-m-d H:i', strtotime(date($expireOn))) . '"' : ''; ?> disabled>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea name="address" rows="1" class="form-control form-control-sm" placeholder="Please enter detailed address" disabled><?php echo isset($address) ? $address : ''; ?></textarea>
                    </div>
                </div>

                <?php if (isset($requestDocuments) && count($requestDocuments) > 0) {
                    foreach ($requestDocuments as $document) { ?>
                        <div class="col-md-4 text-center">
                            <img class="img-fluid rounded" src="<?php echo $document->docPath; ?>" height="200" width="200">
                        </div>
                <?php }
                } ?>
            </div>
        <?php }
        ?>

        <?php if (isset($_GET['aor'])) { ?>
            <div class="row pl-3 py-3 text-center w-100">
                <div class="col-sm-2">
                    <input type="button" class="btn btn-sm btn-outline-success w-100" id="accept" value="Accept">
                </div>
                <div class="col-sm-2">
                    <input type="button" class="btn btn-sm btn-outline-danger w-100" id="reject" value="Reject">
                </div>
            </div>
        <?php } ?>
    </div>
</div><!-- /.container-fluid -->

<?php
include_once "./adders/footer.php";
?>

<script>
    $(document).on('click', '#accept', function(event) {
        event.stopPropagation();
        $('button').addClass('disabled');
        var a = this.id;

        $.ajax({
            url: './controller/requestHandler.php',
            type: 'POST',
            data: {
                requestId: <?php echo decryption($_GET['pref']); ?>,
                flag: 'accept',
                id: <?php echo $_SESSION['uid']; ?>
            },
            success: function(result) {
                data = JSON.parse(result);
                if (data[0] == true) {
                    $('#accept').remove();
                    $('#reject').remove();
                }
            }
        })

        $('button').removeClass('disabled');
    });

    $(document).on('click', '#reject', function(event) {
        event.stopPropagation();
        $('button').addClass('disabled');
        var a = this.id;

        $.ajax({
            url: './controller/requestHandler.php',
            type: 'POST',
            data: {
                requestId: <?php echo decryption($_GET['pref']); ?>,
                flag: 'deny',
                id: <?php echo $_SESSION['uid']; ?>

            },
            success: function(result) {
                data = JSON.parse(result);
                if (data[0] == true) {
                    $('#accept').remove();
                    $('#reject').remove();
                }
            }
        })

        $('button').removeClass('disabled');
    });

    $(document).on('click', '#delivered', function(event) {
        event.stopPropagation();
        $('button').addClass('disabled');
        var a = this.id;

        $.ajax({
            url: './controller/requestHandler.php',
            type: 'POST',
            data: {
                requestId: <?php echo decryption($_GET['pref']); ?>,
                flag: 'delivered',
                id: <?php echo $_SESSION['uid']; ?>

            },
            success: function(result) {
                data = JSON.parse(result);
                if (data[0] == true) {
                    $('#accept').remove();
                    $('#reject').remove();
                    $('#delivered').remove();
                }
            }
        })

        $('button').removeClass('disabled');
    });
</script>