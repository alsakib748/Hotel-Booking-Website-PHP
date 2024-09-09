<?php 
    require("inc/db_config.php");
    require("inc/essentials.php");

    session_start();
        if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)){
            redirect("dashboard.php");
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="../css/all.css" type="text/css" />
    <link rel="stylesheet" href="../css/common.css" type="text/css" />
    <style>
        .login-form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 400px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form action="<?PHP echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input type="text" name="admin_name" required class="form-control shadow-none text-center" placeholder="Admin Name" />
                </div>
                <div class="mb-4">
                    <input type="password" name="admin_pass" required class="form-control shadow-none text-center" placeholder="Password" />
                </div>
                <button type="submit" name="login" class="btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>

    <?php 
        if(isset($_POST["login"])){
            $frm_data = filteration($_POST);
            $query = "SELECT * FROM `admin_cred` WHERE  `admin_name` = ? AND `admin_pass` = ? ";
            $values = [$frm_data['admin_name'],$frm_data['admin_pass']];

            $res = select($query,$values,"ss");
            if($res->num_rows == 1){
                $row = mysqli_fetch_assoc($res);
                $_SESSION['adminLogin'] = true;
                $_SESSION['adminId'] = $row['sr_no'];
                redirect('dashboard.php');
            }else{
                alert("error","Login failed - invalid credentials!");
            }
        }
    ?>

    <!-- Script include -->
    <?php include_once("inc/scripts.php"); ?>

</body>

</html>