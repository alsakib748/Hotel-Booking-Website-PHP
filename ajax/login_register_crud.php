<?php
require("../admin/inc/db_config.php");
require("../admin/inc/essentials.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set("Asia/Dhaka");

/// email verification phpmailer code 

function send_mail($uemail, $token, $type)
{
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        if ($type == "email_confirmation") {
            $page = 'email_confirm.php';
            $subject = 'Account Verification Link';
            $content = 'confirm your email';
        } else {
            $page = 'index.php';
            $subject = 'Account Reset Link';
            $content = 'reset your account';
        }
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'alsakib748@gmail.com';                     //SMTP username  
        $mail->Password = 'tforsdttgaadnbaf';                               //SMTP password  = uqysdylgwxkgbqzq
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('alsakib748@gmail.com', "ASA Hotel Booking");
        $mail->addAddress($uemail);                       //Add a recipient
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = "
            <p style='font-size:1rem;'>Click the link below to $content</p><br/>
            <strong>
                <button type='button' style='cursor:pointer;padding:10px;background: lightskyblue;color: blueviolet;border: none;border-radius: 5px;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
                ' class='btn'>
                <a style='font-size:1rem;text-decoration:none;' href='" . SITE_URL . "$page?$type&email=$uemail&token=$token" . "'>
                    CLICK ME 
                </a>
                </button>
            </strong>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}


if (isset($_POST['register'])) {
    $data = filteration($_POST);

    /// match password and confirm password field

    if ($data['pass'] != $data['cpass']) {
        echo "pass_mismatch";
        exit;
    }

    /// check user exists or not 

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1", [$data['email'], $data['phonenum']], "ss");
    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    /// upload user image to server
    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    } else if ($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
    }

    /// send confirmation link to user's email
    // $name = $data['name'];
    // $uemail = $data['email'];
    $token = bin2hex(random_bytes(16));

    if (!send_mail($data['email'], $token, "email_confirmation")) {
        echo 'mail_failed';
        exit;
    }

    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";

    $values = [$data['name'], $data['email'], $data['address'], $data['phonenum'], $data['pincode'], $data['dob'], $img, $enc_pass, $token];

    if (insert($query, $values, 'sssssssss')) {
        echo 1;
    } else {
        echo 'ins_failed';
    }

}

if (isset($_POST['login'])) {
    $data = filteration($_POST);

    /// check user exists or not 
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1", [$data['email_mob'], $data['email_mob']], "ss");
    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email_mob';
        exit;
    } else {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_fetch['is_verified'] == 0) {
            echo 'not_verified';
        } else if ($u_fetch['status'] == 0) {
            echo 'inactive';
        } else {
            if (!(password_verify($data['pass'], $u_fetch['password']))) {
                echo 'invalid_pass';
            } else {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['uId'] = $u_fetch['id'];
                $_SESSION['uName'] = $u_fetch['name'];
                $_SESSION['uPic'] = $u_fetch['profile'];
                $_SESSION['uPhone'] = $u_fetch['phonenum'];
                echo 1;
            }
        }
    }

}

if (isset($_POST['forgot_pass'])) {
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1", [$data['email']], 's');
    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email';
    } else {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_fetch['is_verified'] == 0) {
            echo 'not_verified';
        } else if ($u_fetch['status'] == 0) {
            echo 'inactive';
        } else {
            // send reset link to email
            $token = bin2hex(random_bytes(16));
            if (!send_mail($data['email'], $token, "account_recovery")) {
                echo 'mail_failed';
            } else {

                $date = date("Y-m-d");
                $query = mysqli_query($con, "UPDATE `user_cred` SET `token`='$token',`t_expire`='$date' WHERE `id`='$u_fetch[id]' ");
                if ($query) {
                    echo 1;
                } else {
                    echo 'upd_failed';
                }
            }
        }
    }

}

if (isset($_POST['recover_user'])) {
    $data = filteration($_POST);

    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    $query = "UPDATE `user_cred` SET `pass`=?,`token`=?,`t_expire`=? WHERE `email`=? AND `token`=?";

    $values = [$enc_pass, null, null, $data['email'], $data['token']];

    if (update($query, $values, "sssss")) {
        echo 1;
    } else {
        echo 'failed';
    }
}


?>