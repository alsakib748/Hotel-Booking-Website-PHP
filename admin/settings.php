<?php
include_once("inc/header.php");
?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">SETTINGS</h3>

            <!-- General settings section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">General Settings</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                            data-bs-target="#general-s">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                    </div>
                    <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                    <p class="card-text" id="site_title"></p>
                    <h6 class="card-subtitle mb-1 fw-bold">About us</h6>
                    <p class="card-text" id="site_about"></p>
                </div>
            </div>

            <!-- General Settings Modal -->
            <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" method="POST" id="general_s_form">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">General Settings</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Site Title</label>
                                    <input type="text" name="site_title" id="site_title_inp" required
                                        class="form-control shadow-none" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">About us</label>
                                    <textarea class="form-control shadow-none" name="site_about" required
                                        id="site_about_inp" rows="6" style="resize:none;"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about"
                                    class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Shutdown section -->

            <div class="card border-0 shadow-sm ">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">Shutdown Website</h5>
                        <div class="form-check form-switch">
                            <form action="" method="POST">
                                <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox"
                                    id="shutdown-toggle">
                            </form>
                        </div>
                    </div>
                    <p class="card-text">
                        No customers will be allowed to book hotel room, when shutdown mode is turned on.
                    </p>
                </div>
            </div>

            <!-- Contact details section -->

            <div class="card border-0 shadow-sm my-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">Contacts Settings</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                            data-bs-target="#contacts-s">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                <p class="card-text" id="address"></p>
                            </div>
                            <div class="mb-4">
                                <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                <p class="card-text" id="gmap"></p>
                            </div>
                            <div class="mb-4">
                                <h6 class="card-subtitle mb-1 fw-bold">Phone Numbers</h6>
                                <p class="card-text mb-1">
                                    <i class="bi bi-telephone-fill"></i>
                                    <span id="pn1"></span>
                                </p>
                                <p class="card-text">
                                    <i class="bi bi-telephone-fill"></i>
                                    <span id="pn2"></span>
                                </p>
                            </div>
                            <div class="mb-4">
                                <h6 class="card-subtitle mb-1 fw-bold">Email</h6>
                                <p class="card-text" id="email"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                                <p class="card-text mb-1">
                                    <i class="bi bi-facebook me-1"></i>
                                    <span id="fb"></span>
                                </p>
                                <p class="card-text mb-1">
                                    <i class="bi bi-instagram me-1"></i>
                                    <span id="insta"></span>
                                </p>
                                <p class="card-text mb-1">
                                    <i class="bi bi-twitter me-1"></i>
                                    <span id="tw"></span>
                                </p>
                                <p class="card-text mb-1">
                                    <i class="bi bi-youtube me-1"></i>
                                    <span id="tube"></span>
                                </p>
                            </div>

                            <div class="mb-4">
                                <h6 class="card-subtitle mb-1 fw-bold">iFrame</h6>
                                <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Contacts details Modal -->
            <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="" method="POST" id="contacts_s_form">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Contacts Settings</h1>
                            </div>
                            <div class="modal-body">

                                <div class="container-fluid p-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Address</label>
                                                <input type="text" name="address" id="address_inp" required
                                                    class="form-control shadow-none" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Google Map Link</label>
                                                <input type="text" name="gmap" id="gmap_inp" required
                                                    class="form-control shadow-none" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Phone number(With country
                                                    code)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="bi bi-telephone-fill"></i></span>
                                                    <input type="number" name="pn1" id="pn1_inp"
                                                        class="form-control shadow-none" required>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="bi bi-telephone-fill"></i></span>
                                                    <input type="number" name="pn2" id="pn2_inp"
                                                        class="form-control shadow-none">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Email</label>
                                                <input type="email" name="email" id="email_inp" required
                                                    class="form-control shadow-none" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Social Links</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="bi bi-facebook"></i></span>
                                                    <input type="text" name="fb" id="fb_inp"
                                                        class="form-control shadow-none" required>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="bi bi-instagram"></i></span>
                                                    <input type="text" name="insta" id="insta_inp"
                                                        class="form-control shadow-none" required>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="bi bi-twitter"></i></span>
                                                    <input type="text" name="tw" id="tw_inp"
                                                        class="form-control shadow-none">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">iFrame Src</label>
                                                <input type="text" name="iframe" id="iframe_inp" required
                                                    class="form-control shadow-none" />
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    onclick="contacts_inp(contacts_data)"
                                    class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Management Team section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">Management Team</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                            data-bs-target="#team-s">
                            <i class="bi bi-plus-square"></i> Add
                        </button>
                    </div>

                    <div class="row" id="team-data">
                        
                    </div>
                    
                </div>

            </div>

            <!-- Management Team Modal -->
            <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" method="POST" id="team_s_form">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Add Team Member</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" name="member_name" id="member_name_inp" required
                                        class="form-control shadow-none" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Picture</label>
                                    <input type="file" name="member_picture" accept=".jpg,.png,.webp,.jpeg" id="member_picture_inp" required
                                        class="form-control shadow-none" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    onclick="member_name.value='',member_picture.value=''"
                                    class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>

<?php require("inc/scripts.php"); ?>
<script src="scripts/settings.js" type="text/javascript"></script>
</body>

</html>