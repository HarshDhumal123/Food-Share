<?php
$page = "Dashboard";
include_once("./adders/header.php");

$foodRequests = [];
?>
<!--Container Main start-->
<div class="m-3">
	<div class="row">
		<h4 class="text-uppercase"><?php echo $page; ?></h4>
	</div>

	<div class="row justify-content-center ">
		<?php if ($_SESSION['category'] != '0') { ?>
			<div class="col-sm-3">
				<a href="./add_request.php">
					<div class="card">
						<div class="card-body text-center">
							<p class="card-text text-dark"><i class="fas fa-plus"></i>&nbsp;Add Request</p>
						</div>
					</div>
				</a>
			</div>
		<?php } else { ?>
			<div class="col-md-3">
				<?php
				$result = json_decode(select_query($con, "request.*", "food_request_master request", "request.enabled='1' AND request.isFoodOrCrop='0' AND isPicked IS NULL AND request.id NOT IN (SELECT rejectRequest.requestId FROM food_request_rejected_master rejectRequest WHERE rejectRequest.userId=" . $_SESSION['uid'] . ")", "", "", "request.id"));

				foreach ($result as $f) {
					$requestDetails = json_decode(select_query($con, "*", "food_request_details_master", "enabled='1' AND frId=" . $f->id, "", "", ""));

					if ($requestDetails[0]->expireOn > date('Y-m-d H:i'))
						array_push($foodRequests, $f);
				}
				?>
				<a class="collapse-tab" data-toggle="collapse" href="#collapseFood" role="button" aria-expanded="false" aria-controls="collapseFood">
					<div class="card">
						<div class="card-body text-center">
							<h4 class="card-title text-dark"><?php echo count($foodRequests); ?></h4>
							<p class="card-text text-dark">Food</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-3">
				<?php
				$cropRequests = json_decode(select_query($con, "request.*", "food_request_master request", "enabled='1' AND isFoodOrCrop='1' AND isPicked IS NULL AND request.id NOT IN (SELECT rejectRequest.requestId FROM food_request_rejected_master rejectRequest WHERE rejectRequest.userId=" . $_SESSION['uid'] . ")", "", "", ""));
				?>
				<a class="collapse-tab" data-toggle="collapse" href="#collapseCrop" role="button" aria-expanded="false" aria-controls="collapseCrop">
					<div class="card">
						<div class="card-body text-center">
							<h4 class="card-title text-dark"><?php echo count($cropRequests); ?></h4>
							<p class="card-text text-dark">Crop</p>
						</div>
					</div>
				</a>
			</div>
		<?php } ?>
	</div>


	<?php if ($_SESSION['category'] == '0') { ?>
		<div class="row my-4">
			<div class="collapse w-100" id="collapseFood">
				<h5 class="text-center my-3">
					Food Donators
				</h5>

				<div class="row justify-content-center">
					<?php
					foreach ($foodRequests as $request) {
						$requestDetails = json_decode(select_query($con, "*", "food_request_details_master", "enabled='1' AND frId=" . $request->id, "", "", ""));
						$requestDocumentDetails = json_decode(select_query($con, "*", "food_request_document_master", "enabled='1' AND frId=" . $request->id, "", "", ""));

						// print_r($requestDetails);

						if ($requestDetails[0]->expireOn > date('Y-m-d H:i')) {
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
										<a class="mx-2" href="view_request.php?pref=<?php echo encryption($request->id); ?>&aor=<?php echo encryption(1); ?>" data-toggle="tooltip" data-placement="top" title="View">
											<i class="fas fa-eye"></i>
										</a>
									</div>
								</div>
							</div>
					<?php }
					}
					?>
				</div>
			</div>
		</div>

		<div class="row my-4">
			<div class="collapse w-100" id="collapseCrop">
				<h5 class="text-center my-3">
					Crop Donators
				</h5>

				<div class="row justify-content-center">
					<?php
					foreach ($cropRequests as $request) {
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
										<span class="badge badge-pill badge-warning mx-auto"><?php echo $request->isFoodOrCrop == '0' ? "Crop" : "Food"; ?></span>
									</p>
									<h5 class="card-title"><?php echo $requestDetails[0]->name; ?></h5>
									<p class="card-text"><?php echo $requestDetails[0]->description; ?></p>
								</div>

								<div class="card-footer text-center bg-white">
									<a class="mx-2" href="view_request.php?pref=<?php echo encryption($request->id); ?>&aor=<?php echo encryption(0); ?>" data-toggle="tooltip" data-placement="top" title="View">
										<i class="fas fa-eye"></i>
									</a>
								</div>
							</div>
						</div>
					<?php }
					?>
				</div>
			</div>
		</div>
	<?php } else if ($_SESSION['category'] == '1') {
		$requests = json_decode(select_query($con, "*", "food_request_master", "enabled='1' AND uid=" . $_SESSION['uid'], "", "", ""));
		$totalCount = 0;
		$pickedCount = 0;

		foreach ($requests as $request) {
			$totalCount++;

			if ($request->isPicked)
				$pickedCount++;
		}
	?>
		<div class="row my-4">
			<div class="col">
				<div class="card">
					<div class="card-body text-center">
						<h4><i class="fas fa-utensils"></i></h4>
						<p class="card-text text-dark">Total Food Requests</p>
						<h4 class="card-title text-dark"><?php echo $totalCount; ?></h4>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<div class="card-body text-center">
						<h4><i class="fas fa-clipboard-check"></i></h4>
						<p class="card-text text-dark">Picked Requests</p>
						<h4 class="card-title text-dark"><?php echo $pickedCount; ?></h4>
					</div>
				</div>
			</div>
		</div>
	<?php } else if ($_SESSION['category'] == '2') {
		$requests = json_decode(select_query($con, "*", "food_request_master", "enabled='1' AND uid=" . $_SESSION['uid'], "", "", ""));

		$totalCount = 0;
		$pickedCount = 0;
		$totalEarned = 0;
		$estimatedEarning = 0;

		foreach ($requests as $request) {
			$requestDetails = json_decode(select_query($con, "*", "food_request_details_master", "enabled='1' AND frId=" . $request->id, "", "", ""))[0];

			$totalCount++;

			if ($request->isPicked) {
				$pickedCount++;
				$totalEarned += ($requestDetails->price * $requestDetails->quantity);
			} else
				$estimatedEarning += ($requestDetails->price * $requestDetails->quantity);
		}
	?>
		<div class="row my-4">
			<div class="col">
				<div class="card">
					<div class="card-body text-center">
						<h4><i class="fas fa-tractor"></i></h4>
						<p class="card-text text-dark">Total Crop Requests</p>
						<h4 class="card-title text-dark"><?php echo $totalCount; ?></h4>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<div class="card-body text-center">
						<h4><i class="fas fa-money-check"></i></h4>
						<p class="card-text text-dark">Estimated Earnings</p>
						<h4 class="card-title text-dark"><?php echo $estimatedEarning; ?></h4>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<div class="card-body text-center">
						<h4><i class="fas fa-rupee-sign"></i></h4>
						<p class="card-text text-dark">Total Earnings</p>
						<h4 class="card-title text-dark"><?php echo $totalEarned; ?></h4>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
<?php
include_once "./adders/footer.php";
?>