<?php
include_once("inc/header.php");
?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">CAROUSEL</h3>

            <!-- Management Team section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">Images</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                            data-bs-target="#caro-s">
                            <i class="bi bi-plus-square"></i> Add
                        </button>
                    </div>

                    <div class="row" id="carousel-data">
                        
                    </div>
                    
                </div>

            </div>

            <!-- Management Team Modal -->
            <div class="modal fade" id="caro-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" method="POST" id="carousel_s_form">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Add Images</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Picture</label>
                                    <input type="file" name="carousel_picture" accept=".jpg,.png,.webp,.jpeg" id="carousel_picture_inp" required
                                        class="form-control shadow-none" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
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
<script src="scripts/carousel.js" type="text/javascript"></script>
</body>

</html>