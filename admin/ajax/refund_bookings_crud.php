<?php
require("../inc/db_config.php");
require("../inc/essentials.php");
adminLogin();

if(isset($_POST['get_bookings'])){

    $frm_data = filteration($_POST);

    $query = "SELECT bo.*,bd.* FROM `booking_order` as bo 
    INNER JOIN `booking_details` as bd ON bo.booking_id = bd.booking_id 
    WHERE (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?)
    AND (bo.booking_status = ? AND bo.refund = ?) ORDER BY bo.booking_id ASC";

    $res = select($query,["%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","cancelled",0],'sssss');
    $i = 1;
    $table_data = "";

    if(mysqli_num_rows($res) == 0){
        echo "<b class='mx-2'>No Data Found!</b>";
        exit;
    }

    while($data = mysqli_fetch_assoc($res)){
        $date = date("d-m-Y",strtotime($data['datentime']));
        $checkin = date("d-m-Y",strtotime($data['check_in']));
        $checkout = date("d-m-Y",strtotime($data['check_out']));
        $table_data .="
            <tr>
                <td>$i</td>
                <td>
                    <span class='badge bg-primary'>
                        Order ID:$data[order_id]
                    </span>
                    <br/>
                    <b>Name:</b> $data[user_name]
                    <br/>
                    <b>Phone No:</b> $data[phonenum]
                </td>
                <td>
                    <b>Room:</b> $data[room_name]
                    <br>
                    <b>Check in:</b> $checkin
                    <br/>
                    <b>Check out:</b> $checkout
                    <br/>
                    <b>Date:</b> ৳$date
                </td>
                <td>
                    <b>৳$data[trans_amt]</b>
                </td>
                <td>
                    <br/>
                    <button type='button' onclick='refund_booking($data[booking_id])' class='btn btn-success btn-sm fw-bold shadow-none'>
                        <i class='bi bi-cash-stack'></i> Refund
                    </button>
                </td>
            </tr>
        ";
        $i++;
    }

    echo $table_data;
}

if(isset($_POST['refund_booking'])){
    $frm_data = filteration($_POST);

    $query = "UPDATE `booking_order` SET `refund`=? WHERE `booking_id`=?";
    $values = [1,$frm_data['booking_id']];
    $res = update($query,$values,'ii');

    echo $res;
}

if(isset($_POST['search_user'])){
    $frm_data = filteration($_POST);
    $query = "SELECT * FROM `user_cred` WHERE `name` LIKE ?";
    $res = select($query,["%$frm_data[name]%"],'s');
    $i = 1;
    $path = USERS_IMG_PATH;

    $data = "";
    
    while($row = mysqli_fetch_assoc($res)){
        $del_btn = "<button type='button' onclick='remove_users($row[id])' class='btn btn-danger shadow-none btn-sm'>
                    <i class='bi bi-trash'></i> 
                    </button>";

        $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i></span>";
        if($row['is_verified']){
            $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
            $del_btn = "";
        }
        $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>active</button>";
        if(!$row['status']){
            $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>banned</button>";
        }
        $date = date("d-m-Y",strtotime($row['datentime']));
        $data .="
            <tr>
                <td>$i</td>
                <td>
                    <img src='$path$row[profile]' width='55px' />
                    <br/>
                    $row[name]
                </td>
                <td>$row[email]</td>
                <td>$row[phonenum]</td>
                <td>$row[address]-$row[pincode]</td>
                <td>$row[dob]</td>
                <td>$verified</td>
                <td>$status</td>
                <td>$date</td>
                <td>$del_btn</td>
            </tr>
        ";
        $i++;
    }

    echo $data;
}

?>
