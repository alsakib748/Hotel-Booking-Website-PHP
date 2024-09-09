<?php
include_once("inc/header.php");
include_once("inc/db_config.php");
?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">BOOKINGS RECORDS</h3>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                    <div class="text-end mb-4">
                        <input type="text" id="search_input" oninput="get_bookings(this.value)"
                            class="form-control shadow-none w-25 ms-auto"
                            placeholder="Search By Order number,User name & Phone number"
                            style="width:420px !important;" />
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover border" style="min-width:1200px;">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User Details</th>
                                    <th scope="col">Room Details</th>
                                    <th scope="col">Bookings Details</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-data">

                            </tbody>
                        </table>
                    </div>

                    <nav>
                        <ul class="pagination mt-3" id="table-pagination">
                            
                        </ul>
                    </nav>

                </div>

            </div>

        </div>
    </div>
</div>


<?php require("inc/scripts.php"); ?>

<script src="scripts/booking_records.js" type="text/javascript"></script>

</body>

</html>