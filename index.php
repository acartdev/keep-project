<?php
require_once("config/db.php");
$conn = new Service;
session_start();

if (isset($_POST['search'])) {
    $text = $_POST['search_text'];
    $query = $conn->select("projects", [], "proj_name LIKE '%$text%'");
    $text = "";
} else {
    $query = $conn->select("projects");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include('nav.php'); ?>

    <?php include("login.php") ?>
    <?php include("register.php") ?>
    <?php include('showdetail.php'); ?>
    <?php include("fillter.php") ?>
    <?php include("startnav.php") ?>
    <?php include("banner.php") ?>
    <div class="container bg-white py-4">
        <div class="container-fluid w-100 h-100 flex-column flex-lg-row d-flex justify-content-between align-items-center pt-4">
            <p class="fs-4">ผลงานและโครงาน</p>
            <form method="post" class="d-flex  justify-content-end align-items-center">

                <span class="text-center me-2 text-body-secondary mt-2 d-none d-md-block">ค้นหาด้วยชื่อโครงงานหรือรหัสโครงงาน</span>
                <input class="form-control w-75   border-danger" id="search_text" name="search_text" type="text" placeholder="ค้นหาวิจัยและโครงงาน">
                <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-danger ms-2"><i class="fa-solid fa-filter"></i></button>
                <!-- <button class=" btn btn-danger ms-2" name="search" type="submit">ค้นหา</button> -->
            </form>
        </div>
        <hr>


        <div class="row row-cols-md-3 row-cols-lg-4 row-cols-2 g-lg-3 g-2" id="containers">


        </div>


    </div>
    <?php include("endnav.php") ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="script1.js"></script>
    <script>
        function downloads(url) {
            let ses = "<?= !empty($_SESSION['id']) ? $_SESSION['id'] : "" ?>"
            if (ses == "") {
                Swal.fire({
                    title: "ไม่สามารถดาวน์โหลดไฟล์ได้!!",
                    text: "กรุณาเข้าสู่ระบบก่อนดาวน์โหลดไฟล์",
                    icon: "warning",
                });
            } else {

                let link = $('<a></a>');
                console.log(url);
                link.attr('href', url);


                $('body').append(link);
                link[0].click();
                link.remove();

            }

        }
        $(document).ready(function() {
            $.ajax({
                url: "fetch.php",
                type: "POST",

                success: data => {
                    $("#containers").html(data)
                }
            })
            $("#search_text").keyup(e => {
                let input = e.target.value
                console.log(input);


                $.ajax({
                    url: "fetch.php",
                    type: "POST",
                    data: {
                        data: input
                    },
                    success: data => {
                        $("#containers").html(data)
                    }
                })

            })

        });
    </script>
</body>

</html>