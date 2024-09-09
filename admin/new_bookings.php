<?php
include_once("inc/header.php");
include_once("inc/db_config.php");
?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">NEW BOOKINGS</h3>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                    <div class="text-end mb-4">
                        <input type="text" oninput="get_bookings(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Search By Order number,User name & Phone number" style="width:420px !important;" />
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover border" style="min-width:1200px;">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User Details</th>
                                    <th scope="col">Room Details</th>
                                    <th scope="col">Bookings Details</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-data">

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- Assign Room Number Modal -->
<div class="modal fade" id="assign-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" id="assign_room_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Assign Room</h1>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Room Number</label>
                        <input type="text" name="room_no" required class="form-control shadow-none" />
                    </div>
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                        Note: Assign Room Number only when user has been arrived!
                    </span>
                    <input type="hidden" name="booking_id" />
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">ASSIGN</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php require("inc/scripts.php"); ?>

<script src="scripts/new_bookings.js" type="text/javascript"></script>

</body>

</html>