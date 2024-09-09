<?php
include_once("inc/header.php");
include_once("inc/db_config.php");

// if (isset($_GET['seen'])) {
//     $frm_data = filteration($_GET);

//     if ($frm_data['seen'] == 'all') {
//         $q = "UPDATE `user_queries` SET `seen`=?";
//         $values = [1];
//         if (update($q, $values, 'i')) {
//             alert('success', 'Mark all as read');
//         } else {
//             alert('error', 'Operation is failed');
//         }
//     } else {
//         $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
//         $values = [1, $frm_data['seen']];
//         if (update($q, $values, 'ii')) {
//             alert('success', 'Mark as read');
//         } else {
//             alert('error', 'Operation is failed');
//         }
//     }
// }

// if (isset($_GET['del'])) {
//     $frm_data = filteration($_GET);

//     if ($frm_data['del'] == 'all') {
//         $q = "DELETE FROM `user_queries`";
//         if (mysqli_query($con, $q)) {
//             alert('success', 'All Data deleted!');
//         } else {
//             alert('error', 'Operation failed!');
//         }
//     } else {
//         $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
//         $values = [$frm_data['del']];
//         if (delete_fun($q, $values, 'i')) {
//             alert('success', 'Data deleted!');
//         } else {
//             alert('error', 'Operation failed!');
//         }
//     }
// }

?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">FEATURES & FACILITIES</h3>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">Features</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                            data-bs-target="#feature-s">
                            <i class="bi bi-plus-square"></i> Add
                        </button>
                    </div>

                    <div class="table-responsive-md" style="height:350px;overflow-y:scroll;" id="style-7">
                        <table class="table table-hover border">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="features-data">

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">Facilities</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                            data-bs-target="#facility-s">
                            <i class="bi bi-plus-square"></i> Add
                        </button>
                    </div>

                    <div class="table-responsive-md" style="height:350px;overflow-y:scroll;" id="style-7">
                        <table class="table table-hover border">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="facilities-data">

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Features Modal -->
            <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" method="POST" id="feature_s_form">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Add Feature</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" name="feature_name" required class="form-control shadow-none" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn text-secondary shadow-none"
                                    data-bs-dismiss="modal">CANCEL</button>
                                <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Facilities Modal -->
            <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" method="POST" id="facility_s_form">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Add Facility</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" name="facility_name" required
                                        class="form-control shadow-none" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Icon</label>
                                    <input type="file" name="facility_icon" accept=".svg" required
                                        class="form-control shadow-none" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control shadow-none" name="facility_desc" required rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
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

<script src="scripts/features_facilities.js"></script>

</body>

</html>