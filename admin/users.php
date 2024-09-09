<?php
include_once("inc/header.php");
include_once("inc/db_config.php");
?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">USERS</h3>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                    <div class="text-end mb-4">
                        <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search..."/>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover border text-center" style="min-width: 1300px;">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">Verified</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="users-data">

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<?php require("inc/scripts.php"); ?>

<script src="scripts/users.js" type="text/javascript"></script>

</body>

</html>