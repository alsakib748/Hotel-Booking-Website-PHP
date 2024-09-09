<?php require("inc/header.php") ?>

<div class="my-5  px-4">
    <h2 class="fw-bold h-font text-center">About us</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae est praesentium
        recusandae saepe,<br /> quidem dolor modi expedita cumque perspiciatis minima!</p>
</div>

<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
            <h3 class="mb-3">Lorem ipsum dolor sit</h3>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium eligendi veniam ratione ipsam modi
                odit doloremque.Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium eligendi veniam
                ratione ipsam modi odit doloremque.
            </p>
        </div>
        <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
            <img src="images/about/about.jpg" class="w-100" />
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/about/about.webp" width="100px" />
                <h5 class="mt-3">100+ ROOMS</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/about/customers-1.jpg" width="70px" />
                <h5 class="mt-3">200+ CUSTOMERS</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/about/review.svg" width="70px" />
                <h5 class="mt-3">150+ REVIEWS</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/about/staff.webp" width="70px" />
                <h5 class="mt-3">200+ STAFFS</h5>
            </div>
        </div>
    </div>
</div>

<h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>

<div class="container px-4">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper mb-5">
            <?php
                $about_r = selectAll('team_details');
                $path = ABOUT_IMG_PATH;
                while($row = mysqli_fetch_assoc($about_r)){
                    echo <<<data
                    <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                        <img src="$path$row[picture]" class="w-100" />
                        <h5 class="mt-2">$row[name]</h5>
                    </div>
                    data;
                }
            ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 4,
      spaceBetween: 40,  
      loop: true,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 3,
                },
       }
    });
  </script>

<?php require("inc/footer.php"); ?>