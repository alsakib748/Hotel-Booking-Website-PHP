<?php
require("admin/inc/db_config.php");
require("admin/inc/essentials.php");

/// bkash payment gatway file included here

date_default_timezone_set("Asia/Dhaka");

session_start();
unset($_SESSION['room']);

function regenrate_session($uid)
{
	$user_q = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$uid], 'i');
	$user_fetch = mysqli_fetch_assoc($user_q);

	$_SESSION['login'] = true;
	$_SESSION['uId'] = $user_fetch['id'];
	$_SESSION['uName'] = $user_fetch['name'];
	$_SESSION['uPic'] = $user_fetch['profile'];
	$_SESSION['uPhone'] = $user_fetch['phonenum'];
}

if ($_POST['status'] == 'VALID') {

	/*************************************************/
	$val_id = urlencode($_POST['val_id']);
	// $val_id = urlencode($_POST['val_id']);
	$store_id = urlencode("artis65afe0088587a");
	$store_passwd = urlencode("artis65afe0088587a@ssl");
	$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

	$handle = curl_init();
	curl_setopt($handle, CURLOPT_URL, $requested_url);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

	$result = curl_exec($handle);

	$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

	if ($code == 200 && !(curl_errno($handle))) {

		# TO CONVERT AS ARRAY
		# $result = json_decode($result, true);
		# $status = $result['status'];

		# TO CONVERT AS OBJECT
		$result = json_decode($result);

		# TRANSACTION INFO
		$status = $result->status;
		$tran_date = $result->tran_date;
		$tran_id = $result->tran_id;
		$val_id = $result->val_id;
		$amount = $result->amount;
		$store_amount = $result->store_amount;
		$bank_tran_id = $result->bank_tran_id;
		$card_type = $result->card_type;

		# EMI INFO
		$emi_instalment = $result->emi_instalment;
		$emi_amount = $result->emi_amount;
		$emi_description = $result->emi_description;
		$emi_issuer = $result->emi_issuer;

		# ISSUER INFO
		$card_no = $result->card_no;
		$card_issuer = $result->card_issuer;
		$card_brand = $result->card_brand;
		$card_issuer_country = $result->card_issuer_country;
		$card_issuer_country_code = $result->card_issuer_country_code;

		# API AUTHENTICATION
		$APIConnect = $result->APIConnect;
		$validated_on = $result->validated_on;
		$gw_version = $result->gw_version;

		# OPTIONAL VARIABLE
		$ORDER_ID = $result->value_a;  /// Received order id using optional variable

		/******************OWN CODE BY ME*********************/

		$slct_query = "SELECT `booking_id`,`user_id` FROM `booking_order` WHERE `order_id`='$ORDER_ID'";
		$slct_res = mysqli_query($con, $slct_query);

		if (mysqli_num_rows($slct_res) == 0) {
			redirect("index.php");
		}

		$slct_fetch = mysqli_fetch_assoc($slct_res);

		if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
			regenrate_session($slct_fetch['user_id']);
		}

		if ($status == "VALID") {
			// if($status == "VALID"){
			//     $status = "success";
			// }
			$upd_query = "UPDATE `booking_order` SET `booking_status`='booked',`trans_id`='$tran_id',`trans_amt`='$amount',`trans_status`='$status',`trans_resp_msg`='' WHERE `booking_id`='$slct_fetch[booking_id]' ";

			mysqli_query($con, $upd_query);
		} else {

			$upd_query = "UPDATE `booking_order` SET `booking_status`='payment failed',`trans_id`='$tran_id',`trans_amt`='$amount',`trans_status`='$status',`trans_resp_msg`='' WHERE `booking_id`='$slct_fetch[booking_id]' ";

			mysqli_query($con, $upd_query);
		}
		redirect('pay_status.php?order=' . $ORDER_ID);

	} else {
		echo "Failed to connect with SSLCOMMERZ";
	}

}else if ($_POST['status'] == "FAILED"){
	/******************OWN CODE BY ME*********************/
	$ORDER_ID = $_POST['value_a'];
	$slct_query = "SELECT `booking_id`,`user_id` FROM `booking_order` WHERE `order_id`='$ORDER_ID'";
	$slct_res = mysqli_query($con, $slct_query);

	if (mysqli_num_rows($slct_res) == 0) {
		redirect("index.php");
	}

	$slct_fetch = mysqli_fetch_assoc($slct_res);

	if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
		regenrate_session($slct_fetch['user_id']);
	}

	$upd_query = "UPDATE `booking_order` SET `booking_status`='payment failed',`trans_id`='$_POST[tran_id]',`trans_amt`='$_POST[amount]',`trans_status`='$_POST[status]',`trans_resp_msg`='' WHERE `booking_id`='$slct_fetch[booking_id]' ";

	mysqli_query($con, $upd_query);

	redirect('pay_status.php?order=' . $ORDER_ID);
}

?>