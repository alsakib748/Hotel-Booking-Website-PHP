<?php
require("inc/essentials.php");
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel -Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="../css/all.css" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/common.css" type="text/css" />
</head>

<body class="bg-light">


    <div class="container-fluid sticky-top bg-dark text-light p-3 d-flex align-items-center justify-content-between">
        <h3 class="mb-0 h-font">HB WEBSITE</h3>
        <a href="logout.php" class="btn btn-light btn-sm">LOG OUT</a>
    </div>

    <div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard-menu">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid flex-lg-column align-items-stretch">
                <h4 class="mt-2 text-light">ADMIN PANEL</h4>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#adminDropdown" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropdown">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <button
                                class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between"
                                type="button" data-bs-toggle="collapse" data-bs-target="#bookingLinks">
                                <span>Bookings</span>
                                <span><i class="bi bi-caret-down-fill"></i></span>
                            </button>
                            <div class="collapse show px-3 small mb-1" id="bookingLinks">
                                <ul class="nav nav-pills flex-column rounded border border-secondary">
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="new_bookings.php">New Bookings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="refund_bookings.php">Refund Bookings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="bookings_records.php">Bookings Records</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="users.php">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="user_queries.php">User Queries</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="rate_review.php">Ratings & Review</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="rooms.php">Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="features_facilities.php">Features & Facilities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="carousel.php">Carousel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="settings.php">Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>