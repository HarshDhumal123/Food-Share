<?php
$page = "Add Request";
include_once "./adders/header.php";

$cropNameErr = $foodNameErr = $quantityErr = $croppedOn =  $croppedOnErr = $categoryErr = $madeOnErr = $expireOnErr = $expectedPriceErr = $expireOnErr = $descriptionErr = $addressErr = $dinner_lunchErr = $cropImgErr = $foodImgErr = $peopleCountErr = '';

if (isset($_POST['cropSubRequest'])) {
    $cropName = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['cropName'])));
    $quantity = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['quantity'])));
    $unit = mysqli_real_escape_string($con, htmlspecialchars(trim(isset($_POST['unit']) ? $_POST['unit'] : '')));
    $croppedOn = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['croppedOn'])));
    $description = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['description'])));
    $expectedPrice = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['expectedPrice'])));
    $address = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['address'])));

    if ($cropName == '')
        $cropNameErr = "Please enter crop name";

    if ($quantity == '')
        $quantityErr = "Please enter quantity";
    else if ($quantity < 1)
        $quantityErr = "Quantity must be greater than 1";

    if ($croppedOn == '')
        $croppedOnErr = "Please enter cropped on";

    if ($expectedPrice == '')
        $expectedPriceErr = "Please enter expected price";

    if ($address == '')
        $addressErr = "Please enter address";

    if ($description == '')
        $descriptionErr = 'Please enter description or enter NA';

    if ($cropNameErr == '' && $quantityErr == '' && $croppedOnErr == '' && $expectedPriceErr == '' && $addressErr == '' && $descriptionErr == '') {
        $uid = $_SESSION['uid'];
        $isUpload = true;

        $target_dir = "./assets/images/uploads/crop/";
        $uploadedFiles = [];

        if (isset($_GET['pref'])) {
            $requestUpdateId = update_query($con, "food_request_details_master", "name='" . $cropName . "', quantity=" . $quantity . ", unit='" . $unit . "', madeOn=" . $croppedOn . ", description='" . $description . "', price=" . $expectedPrice . ", address='" . $address . "', updatedBy=" . $_SESSION['uid'], "frId=" . decryption($_GET['pref']));

            if ($requestUpdateId != '') {
                echo '<script>swal({title: "Your request has been updated successfully",type: "success",button: "Ok"}).then(function() {window.location.href = "requests.php";});</script>';
            }
        } else {
            if (isset($_FILES["cropPhoto"]) && count($_FILES["cropPhoto"]["name"]) < 3) {
                for ($i = 0; $i < count($_FILES["cropPhoto"]["name"]); $i++) {
                    $target_file = $target_dir . $_SESSION['uid'] . "_" . time() . "." . pathinfo($_FILES["cropPhoto"]["name"][$i], PATHINFO_EXTENSION);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $check = getimagesize($_FILES["cropPhoto"]["tmp_name"][$i]);
                    if ($check == false) {
                        $isUpload = false;
                        $cropImgErr = "Image number" . $i . " has an error";
                    }

                    if (file_exists($target_file)) {
                        $cropImgErr = "Sorry, image number " . $i . " already exists.";
                        $isUpload = false;
                    }

                    if ($_FILES["cropPhoto"]["size"][$i] > 5000000000000000000000) {
                        $cropImgErr = "Sorry, image number " . $i . " is too large.";
                        $isUpload = false;
                    }

                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                        echo "Sorry, only JPG, JPEG, PNG files are allowed. Image number " . $i . " is not is allowed extensions.";
                        $isUpload = false;
                    }

                    if ($isUpload) {
                        try {
                            if (move_uploaded_file($_FILES["cropPhoto"]["tmp_name"][$i], $target_file)) {
                                array_push($uploadedFiles, $target_file);
                            } else {
                                $cropImgErr = "Sorry, there was an error uploading file number " . $i;
                                $isUpload = false;
                            }
                        } catch (\Throwable $th) {
                            print_r($th);
                            $isUpload = false;
                        }
                    }
                }
            } else {
                $cropImgErr = "Minimum 1 and maximum 2 files are required";
                $isUpload = false;
            }

            if ($isUpload) {
                $requestColumns = array('uid', 'isFoodOrCrop', 'createdBy', 'updatedBy');
                $requestValue = array($uid, '1', $uid, $uid);

                $requestId = insert_query($con, $requestColumns, $requestValue, "food_request_master");

                if ($requestId != '') {
                    $requestDetailsColumns = array('frId', 'name', 'quantity', 'unit', 'madeOn', 'description', 'price', 'address', 'updatedBy');
                    $requestDetailsValue = array($requestId, $cropName, $quantity, $unit, $croppedOn, $description, $expectedPrice, $address, $uid);

                    $requestDetailsId = insert_query($con, $requestDetailsColumns, $requestDetailsValue, "food_request_details_master");

                    if ($requestDetailsId != '') {
                        if (count($uploadedFiles) > 0) {
                            for ($i = 0; $i < count($uploadedFiles); $i++) {
                                $requestDocumentsColumns = array('frId', 'docPath', 'createdBy', 'updatedBy');
                                $requestDocumentsValue = array($requestId, $uploadedFiles[$i], $uid, $uid);
                                $requestDocumentsId = insert_query($con, $requestDocumentsColumns, $requestDocumentsValue, "food_request_document_master");
                            }
                        }

                        echo '<script>swal({title: "Your request has been submitted successfully",type: "success",button: "Ok"}).then(function() {window.location.href = "index.php";});</script>';
                    } else {
                        echo '<script>swal({title: "Something went wrong",type: "warning",button: "Ok"});</script>';
                    }
                } else {
                    echo '<script>swal({title: "Something went wrong",type: "warning",button: "Ok"});</script>';
                }
            }
        }
    }
} else if (isset($_POST['foodSubRequest'])) {
    $foodName = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['foodName'])));
    $madeOn = mysqli_real_escape_string($con, htmlspecialchars(trim(isset($_POST['madeOn']) ? $_POST['madeOn'] : '')));
    $dinner_lunch = mysqli_real_escape_string($con, htmlspecialchars(trim(isset($_POST['dinner_lunch']) ? $_POST['dinner_lunch'] : '')));
    $description = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['description'])));
    $expireOn = mysqli_real_escape_string($con, htmlspecialchars(trim(isset($_POST['expireOn']) ? $_POST['expireOn'] : '')));
    $address = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['address'])));
    $peopleCount = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['peopleCount'])));

    if ($foodName == '')
        $foodNameErr = "Please enter food name";

    if ($madeOn == '')
        $madeOnErr = "Please enter made on";

    if ($dinner_lunch == '')
        $categoryErr = "Please enter dinner/lunch";

    if ($expireOn == '')
        $expireOnErr = "Please enter expire on";

    if ($address == '')
        $addressErr = "Please enter address";

    if ($peopleCount == '')
        $peopleCountErr = "Please enter count of people";

    if ($description == '')
        $descriptionErr = 'Please enter description or enter NA';

    if ($foodNameErr == '' && $madeOnErr == '' && $expireOnErr == '' && $addressErr == '' && $descriptionErr == '' && $categoryErr == '' && $peopleCountErr == '') {
        $uid = $_SESSION['uid'];

        $isUpload = true;

        $target_dir = "./assets/images/uploads/food/";
        $uploadedFiles = [];

        if (isset($_GET['pref'])) {
            $requestUpdateId = update_query($con, "food_request_details_master", "name='" . $foodName . "', madeOn='" . $madeOn . "', expireOn='" . $expireOn . "', description='" . $description . "', address='" . $address . "' ,peopleCount=" . $peopleCount . ", updatedBy=" . $_SESSION['uid'], "frId=" . decryption($_GET['pref']));

            if ($requestUpdateId != '') {
                echo '<script>swal({title: "Your request has been updated successfully",type: "success",button: "Ok"}).then(function() {window.location.href = "requests.php";});</script>';
            }
        } else {
            if (isset($_FILES["foodPhoto"]) && count($_FILES["foodPhoto"]['name']) < 3) {
                for ($i = 0; $i < count($_FILES["foodPhoto"]["name"]); $i++) {
                    if ($_FILES["foodPhoto"]["name"][$i] != "") {
                        $target_file = $target_dir . $_SESSION['uid'] . "_" . time() . "." . pathinfo($_FILES["foodPhoto"]["name"][$i], PATHINFO_EXTENSION);

                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $check = getimagesize($_FILES["foodPhoto"]["tmp_name"][$i]);
                        if ($check == false) {
                            $isUpload = false;
                            $foodImgErr = "Image number" . $i . " has an error";
                        }

                        if (file_exists($target_file)) {
                            $foodImgErr = "Sorry, image number " . $i . " already exists.";
                            $isUpload = false;
                        }

                        if ($_FILES["foodPhoto"]["size"][$i] > 50000000000000) {
                            $foodImgErr = "Sorry, image number " . $i . " is too large.";
                            $isUpload = false;
                        }

                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. Image number " . $i . " is not is allowed extensions.";
                            $isUpload = false;
                        }

                        if ($isUpload) {
                            try {
                                if (move_uploaded_file($_FILES["foodPhoto"]["tmp_name"][$i], $target_file)) {
                                    array_push($uploadedFiles, $target_file);
                                } else {
                                    $foodImgErr = "Sorry, there was an error uploading file number " . $i;
                                    $isUpload = false;
                                }
                            } catch (\Throwable $th) {
                                print_r($th);
                                $isUpload = false;
                            }
                        }
                    }
                }
            } else {
                $cropImgErr = "Minimum 1 and maximum 2 files are required";
                $isUpload = false;
            }

            if ($isUpload) {
                $requestColumns = array('uid', 'isFoodOrCrop', 'createdBy', 'updatedBy');
                $requestValue = array($uid, '0', $uid, $uid);

                $requestId = insert_query($con, $requestColumns, $requestValue, "food_request_master");

                if ($requestId != '') {
                    $requestDetailsColumns = array('frId', 'name', 'madeOn', 'expireOn', 'description', 'category', 'address', 'peopleCount', 'updatedBy');
                    $requestDetailsValue = array($requestId, $foodName, $madeOn, $expireOn, $description, $dinner_lunch, $address, $peopleCount, $uid);

                    $requestDetailsId = insert_query($con, $requestDetailsColumns, $requestDetailsValue, "food_request_details_master");

                    if ($requestDetailsId != '') {
                        if (count($uploadedFiles) > 0) {
                            for ($i = 0; $i < count($uploadedFiles); $i++) {
                                $requestDocumentsColumns = array('frId', 'docPath', 'createdBy', 'updatedBy');
                                $requestDocumentsValue = array($requestId, $uploadedFiles[$i], $uid, $uid);
                                $requestDocumentsId = insert_query($con, $requestDocumentsColumns, $requestDocumentsValue, "food_request_document_master");
                            }
                        }

                        echo '<script>swal({title: "Your request has been submitted successfully",type: "success",button: "Ok"}).then(function() {window.location.href = "index.php";});</script>';
                    } else {
                        echo '<script>swal({title: "Something went wrong",type: "warning",button: "Ok"});</script>';
                    }
                } else {
                    echo '<script>swal({title: "Something went wrong",type: "warning",button: "Ok"});</script>';
                }
            }
        }
    }
} else if (isset($_GET['pref'])) {
    $requestId = decryption($_GET['pref']);

    $requestDetails = json_decode(select_query($con, "*", "food_request_details_master", "enabled='1' AND frId=" . $requestId, "", "", ""))[0];
    $requestDocuments = json_decode(select_query($con, "*", "food_request_document_master", "enabled='1' AND frId=" . $requestId, "", "", ""));

    if ($_SESSION['category'] == 2) {
        $cropName = $requestDetails->name;
        $quantity = $requestDetails->quantity;
        $unit = $requestDetails->unit;
        $madeOn = $requestDetails->madeOn;
        $description = $requestDetails->description;
        $expectedPrice = $requestDetails->price;
        $address = $requestDetails->address;

        $date = DateTime::createFromFormat('Y-m-d H:i:s', $madeOn);
        $croppedOn = $date->format('d-m-Y');
    } else if ($_SESSION['category'] == 1) {
        $foodName = $requestDetails->name;
        $category = $requestDetails->category;
        $madeOn = $requestDetails->madeOn;
        $description = $requestDetails->description;
        $expireOn = $requestDetails->expireOn;
        $address = $requestDetails->address;
        $peopleCount = $requestDetails->peopleCount;

        $date = DateTime::createFromFormat('Y-m-d H:i:s', $madeOn);
        $madeOn = $date->format('d-m-Y H:i');
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $expireOn);
        $expireOn = $date->format('d-m-Y H:i');
    }
}

if ($_SESSION['category'] == '1')
    $quotes = ["Join the fight against hunger: donate food", "Every plate shared is a promise of a better tomorrow", "A meal donated is a dream nurtured", "Give the gift of nourishment", "Filling empty stomachs, fulfilling lives", "Food for today, hope for tomorrow", "Share a meal, share a smile"];
else if ($_SESSION['category'] == '2')
    $quotes = ["Cultivating quality, selling at its finest", "Growing goodness, offering greatness", "From our farm to your hands, the best value lands", "Putting the best on your table, at the best price", "Where quality meets affordability, farmer's pride"];
else
    $quotes = ["Cultivating quality, selling at its finest", "Growing goodness, offering greatness", "From our farm to your hands, the best value lands", "Putting the best on your table, at the best price", "Where quality meets affordability, farmer's pride", "Join the fight against hunger: donate food", "Every plate shared is a promise of a better tomorrow", "A meal donated is a dream nurtured", "Give the gift of nourishment", "Filling empty stomachs, fulfilling lives", "Food for today, hope for tomorrow", "Share a meal, share a smile"];
?>
<!--Container Main start-->
<div class="m-3 form-div">
    <div class="row">
        <h4 class="text-uppercase"><?php echo $page; ?></h4>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="alert alert-info text-center" role="alert">
                <?php echo $quotes[rand(0, 4)]; ?>
            </div>
        </div>
    </div>

    <?php
    if ($_SESSION['category'] == 2) { ?>
        <form action="" method="POST" class="validate-form" enctype="multipart/form-data">
            <label class="my-3 locality-label"><b>Request Details</b></label>
            <div class="row locality-div">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Crop Name</label>
                        <input type="text" class="form-control form-control-sm" name="cropName" placeholder="Crop name" <?php echo isset($cropName) ? 'value="' . $cropName . '"' : ''; ?>>
                        <?php echo $cropNameErr != '' ? '<span class="text-danger">' . $cropNameErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-1">
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" class="form-control form-control-sm" name="quantity" onkeyup="getTotalPrice();" placeholder="Quantity" min="1" <?php echo isset($quantity) ? 'value="' . $quantity . '"' : ''; ?>>
                        <?php echo $quantityErr != '' ? '<span class="text-danger">' . $quantityErr . '</span>' : ''; ?>
                    </div>
                </div>
                <div class="col-md-2 pl-0">
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
                        <input type="date" class="form-control form-control-sm" name="croppedOn" <?php echo isset($croppedOn) && $croppedOn != '' ? 'value="' . date('Y-m-d', strtotime(date($croppedOn))) . '"' : 'value="' . date('Y-m-d') . '"'; ?>>
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

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Expected Price</label>
                        <input type="number" class="form-control form-control-sm" onkeyup="getTotalPrice();" name="expectedPrice" placeholder="Expected Price" min="0" <?php echo isset($expectedPrice) ? 'value="' . $expectedPrice . '"' : ''; ?>>
                        <?php echo $expectedPriceErr != '' ? '<span class="text-danger">' . $expectedPriceErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-1 pl-0">
                    <div class="form-group">
                        <label for="">Total Price</label>
                        <input type="text" id="totalPrice" class="form-control form-control-sm" placeholder="Price" <?php echo isset($quantity) && $quantity != '' ? 'value="' . $quantity . '"' : 0; ?> readonly>
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
                            <img src="<?php echo $document->docPath; ?>" height="200">
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
                <?php } ?>
            </div>

            <div class="row pl-3 py-3 locality-div">
                <div class="form-group">
                    <input type="submit" class="btn btn-sm btn-outline-primary" value="Submit" name="cropSubRequest">
                </div>
            </div>
        </form>
    <?php } else if ($_SESSION['category'] == 1) { ?>
        <form action="" method="POST" class="validate-form" enctype="multipart/form-data">
            <label class="my-3 locality-label"><b>Request Details</b></label>
            <div class="row locality-div">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Food Name</label>
                        <input type="text" class="form-control form-control-sm" name="foodName" placeholder="Food name" <?php echo isset($foodName) ? 'value="' . $foodName . '"' : ''; ?>>
                        <?php echo $foodNameErr != '' ? '<span class="text-danger">' . $foodNameErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Baked On</label>
                        <input type="datetime-local" class="form-control form-control-sm" name="madeOn" placeholder="Baked on" <?php echo isset($madeOn) ? 'value="' . date('Y-m-d H:i', strtotime(date($madeOn))) . '"' : 'value="' . date('Y-m-d H:i') . '"'; ?>>
                        <?php echo $madeOnErr != '' ? '<span class="text-danger">' . $madeOnErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-4 my-auto">
                    <div class="form-group">
                        <label for="">Dinner/Lunch</label>
                        <div class="row">
                            <input type="radio" name="dinner_lunch" value="0" class="custom-control custom-radio custom-control-inline mx-3" <?php echo isset($category) && $category != '' && $category == '0' ? 'checked' : ''; ?>> Dinner
                            <input type="radio" name="dinner_lunch" value="1" class="custom-control custom-radio custom-control-inline mx-3" <?php echo isset($category) && $category != '' && $category == '1' ? 'checked' : ''; ?>> Lunch
                        </div>
                        <?php echo $categoryErr != '' ? '<span class="text-danger">' . $categoryErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Food Description</label>
                        <textarea name="description" rows="1" class="form-control form-control-sm" placeholder="Please enter detailed food description"><?php echo isset($description) ? $description : ''; ?></textarea>
                        <?php echo $descriptionErr != '' ? '<span class="text-danger">' . $descriptionErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Will Expire On</label>
                        <input type="datetime-local" class="form-control form-control-sm" name="expireOn" placeholder="Will Expire On" <?php echo isset($expireOn) ? 'value="' . date('Y-m-d H:i', strtotime(date($expireOn))) . '"' : ''; ?>>
                        <?php echo $expireOnErr != '' ? '<span class="text-danger">' . $expireOnErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea name="address" rows="1" class="form-control form-control-sm" placeholder="Please enter detailed address"><?php echo isset($address) ? $address : ''; ?></textarea>
                        <?php echo $addressErr != '' ? '<span class="text-danger">' . $addressErr . '</span>' : ''; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Sufficient For</label>
                        <div class="input-group">
                            <input type="number" name="peopleCount" class="form-control" placeholder="No. of people" <?php echo isset($peopleCount) ? "value='" . $peopleCount . "'" : ''; ?>>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">People</span>
                            </div>
                        </div>
                        <?php echo $peopleCountErr != '' ? '<span class="text-danger">' . $peopleCountErr . '</span>' : ''; ?>
                    </div>
                </div>

                <?php if (isset($requestDocuments) && count($requestDocuments) > 0) {
                    foreach ($requestDocuments as $document) { ?>
                        <div class="col-md-4 text-center">
                            <img src="<?php echo $document->docPath; ?>" height="200">
                        </div>
                    <?php }
                } else { ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Food Photo</label>
                            <input type="file" name="foodPhoto[]" class="form-control form-control-file form-control-sm" multiple>
                            <?php echo $foodImgErr != '' ? '<span class="text-danger">' . $foodImgErr . '</span>' : ''; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="row pl-3 py-3 locality-div">
                <div class="form-group">
                    <input type="submit" class="btn btn-sm btn-outline-primary" value="Submit" name="foodSubRequest">
                </div>
            </div>
        </form>
    <?php }
    ?>

</div><!-- /.container-fluid -->
<?php
include_once "./adders/footer.php";
?>

<script>
    function getTotalPrice() {
        var quantity = $("input[name=quantity").val();
        var expectedPrice = $("input[name=expectedPrice").val();

        $("#totalPrice").val(quantity * expectedPrice);
    }
</script>