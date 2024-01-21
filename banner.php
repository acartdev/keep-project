<div id="carouselExampleInterval" class="carousel slide bg-danger shadow" data-bs-ride="carousel">

    <div class="carousel-inner mx-auto w-100 crs">
        <div class="position-absolute">

        </div>
        <div class="carousel-item  active" data-bs-interval="2000">
            <img src="images/logo/2.jpg" class="d-block w-100 h-100 img-fluid object-fit-cover" alt="information technology">
        </div>
        <?php
        $directory = 'images/banner';
        $handle = opendir($directory);

        while (($file = readdir($handle)) !== false) {
            if ($file != '.' && $file != '..') {
                $filePath = $directory . '/' . $file;

        ?>
                <div class="carousel-item " data-bs-interval="3000">
                    <img src="<?= $filePath ?>" class="d-block w-100 h-100 img-fluid object-fit-cover" alt="information technology">
                </div>
        <?php
            }
        }
        closedir($handle);
        ?>

        <!-- <div class="carousel-item  " data-bs-interval="3000">
            <img src="images/banner/2.jpg" class="d-block w-100 h-100 img-fluid object-fit-cover" alt="information technology">
        </div>
        <div class="carousel-item  " data-bs-interval="3000">
            <img src="images/banner/3.jpg" class="d-block w-100 h-100 img-fluid object-fit-cover" alt="information technology">
        </div>
        <div class="carousel-item  " data-bs-interval="3000">
            <img src="images/banner/4.jpg" class="d-block w-100 h-100 img-fluid object-fit-cover" alt="information technology">
        </div>
        <div class="carousel-item  " data-bs-interval="3000">
            <img src="images/banner/5.jpg" class="d-block w-100 h-100 img-fluid object-fit-cover" alt="information technology">
        </div>
        <div class="carousel-item  " data-bs-interval="3000">
            <img src="images/banner/6.jpg" class="d-block w-100 h-100 img-fluid object-fit-cover" alt="information technology">
        </div>
        <div class="carousel-item  " data-bs-interval="3000">
            <img src="images/banner/7.jpg" class="d-block w-100 h-100 img-fluid object-fit-cover" alt="information technology">
        </div>
        <div class="carousel-item  " data-bs-interval="3000">
            <img src="images/banner/8.jpg" class="d-block w-100 h-100 img-fluid object-fit-cover" alt="information technology">
        </div> -->
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>