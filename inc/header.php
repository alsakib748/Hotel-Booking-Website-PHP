<?php 
    session_start();
    require("admin/inc/db_config.php");
    require("admin/inc/essentials.php");
    date_default_timezone_set("Asia/Dhaka");
    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(select($contact_q,$values,"i"));
    $settings_r = mysqli_fetch_assoc(select($settings_q,$values,"i"));

    if($settings_r['shutdown']){
        echo <<<alertbar
            <div class='bg-danger text-center p-2 fw-bold'>
                <i class='bi bi-exclamation-triangle-fill'></i>
                Bookings are temporarily closed!
            </div>
        alertbar;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ASA Hotel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/all.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap-icons.min.css" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/common.css" type="text/css" />
    <style>
        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        @media screen and (max-width: 575px) {
            .carousel-height {
                height: 250px;
            }

            .availability-form {
                margin-top: 25px;
                padding: 0px 35px;
            }
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo $settings_r['site_title']; ?></a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link me-2" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="rooms.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="facilities.php">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="contact.php">Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
                <div class="d-flex" role="search">
                <?php 
                    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                        $path = USERS_IMG_PATH;
                        echo<<<data
                        <div class="btn-group">
                        <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <img src="$path$_SESSION[uPic]" style="width: 35px; height:35px;border-radius:50%;" class="me-1" />
                            $_SESSION[uName]
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                        </div>
                        data;
                    }
                    else{
                        echo <<<info
                            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
                            data-bs-target="#loginModal">
                                Login
                            </button>
                            <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal"
                            data-bs-target="#registerModal">
                                Register
                            </button>
                        info;
                    }
                ?>   
                    
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" id="login-form">
                    <div class="modal-header">
                        <h1 class="modal-title d-flex align-items-center fs-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                class="bi bi-person-circle me-2" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>User Login
                        </h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email / Mobile</label>
                            <input type="text" name="email_mob" required class="form-control shadow-none" />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="pass" required class="form-control shadow-none" />
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">
                                LOGIN
                            </button>
                            <button type="button" class="btn text-secondary text-decoration-none shadow-none p-0" data-bs-target="#forgotModal" data-bs-toggle="modal" data-bs-dismiss="modal">
                                Forgot Password?
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade modal-lg" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" id="register-form" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title d-flex align-items-center fs-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                class="bi bi-person-lines-fill me-2" viewBox="0 0 16 16">
                                <path
                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                            </svg>User Registration
                        </h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill text-bg-light mb-3 text-wrap lh-base">
                            Note: Your details must match with your ID(ID
                            No,passport,driving license,etc.) that will be required during
                            check-in.
                        </span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control shadow-none" required/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control shadow-none" required/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="number" name="phonenum" class="form-control shadow-none" required/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Picture</label>
                                    <input type="file" name="profile" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required/>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control shadow-none" name="address" rows="1" required></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pincode</label>
                                    <input type="number" name="pincode" class="form-control shadow-none" required/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control shadow-none" required/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="pass" class="form-control shadow-none" required/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="cpass" class="form-control shadow-none" required/>
                                </div>
                            </div>
                            <div class="text-center my-1">
                                <button type="submit" class="btn btn-dark shadow-none">
                                    REGISTER
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" id="forgot-form">
                    <div class="modal-header">
                        <h1 class="modal-title d-flex align-items-center fs-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                class="bi bi-person-circle me-2" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg> Forgot Password
                        </h1>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                            Note: A link will be sent to your email to reset your password! 
                        </span>
                        <div class="mb-4">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" required class="form-control shadow-none" />
                        </div>
                        <div class="mb-2 text-end">
                            <button type="button" class="btn shadow-none p-0 me-2" data-bs-target="#loginModal" data-bs-toggle="modal" data-bs-dismiss="modal">
                                CANCEL
                            </button>
                            <button type="submit" class="btn btn-dark shadow-none">
                                SEND LINK
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>