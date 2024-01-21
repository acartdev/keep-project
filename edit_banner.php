<?php
require_once("config/db.php");
$conn = new Service;
session_start();
if (empty($_SESSION['role']) || $_SESSION['role'] == "user") {
    header("location: index.php");
}
$query = $conn->select("teacher");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include('nav.php'); ?>


    <?php include('startnav.php'); ?>

    <div class="container bg-white ">
        <div class="container-fluid w-100 h-100  d-flex justify-content-between align-items-center pt-4">
            <p class="fs-3">จัดการแบร์นเนอร์ <i class="fa-regular fa-images text-danger"></i></p>
            <button class=" btn btn-danger ms-2" type="button" data-bs-toggle="modal" data-bs-target="#banner">เพิ่มแบร์นเนอร์ <i class="fa-regular fa-images"></i></button>

        </div>
        <hr>
        <div class="row row-cols-lg-5 g-3">
            <?php
            $directory = 'images/banner';
            $handle = opendir($directory);

            while (($file = readdir($handle)) !== false) {
                if ($file != '.' && $file != '..') {
                    $filePath = $directory . '/' . $file;

            ?>
                    <div class="col" style='position:relative;'>
                        <img src="<?= $filePath ?>" class="img-thumbnail img-fluid" alt="">
                        <button onclick="deleted('<?= $filePath ?>')" class="btn btn-danger" style="position:absolute; top:0; right:0; z-index:99;"><i class="fa-solid fa-circle-xmark text-white"></i></button>
                    </div>
            <?php
                }
            }
            closedir($handle);
            ?>
        </div>

        <?php include('endnav.php'); ?>
        <?php include('addBannerModal.php'); ?>










        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script>
            const deleted = (path) => {
                Swal.fire({
                    title: "ลบแบร์นเนอร์",
                    text: "คุณต้องการลบแบร์นเนอร์หรือไม่?",
                    icon: "warning",
                    cancelButtonText: "ยกเลิก",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",

                    confirmButtonText: "ตกลง",
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "service/action.php?deleteBan=1",
                            data: {
                                path: path
                            },
                            success: async function(response) {
                                console.log(response);
                                const res = JSON.parse(response)
                                await Swal.fire({
                                    title: res.title,
                                    text: res.msg,
                                    icon: res.status,
                                });
                                window.location.reload();
                            },
                        });
                    }
                });
            }
            $(document).ready(function() {
                $("#addBanner").submit(function(e) {
                    e.preventDefault()
                    let img = $("#imgInput")[0].files
                    let uploadImg = new FormData()
                    for (let i = 0; i < img.length; i++) {
                        uploadImg.append("images[]", img[i])
                    }
                    $.ajax({
                        url: 'service/uploadImg.php',
                        type: 'POST',
                        data: uploadImg,
                        contentType: false,
                        processData: false,
                        success: async function(response) {
                            const res = JSON.parse(response)
                            if (res.status == "error") {
                                await Swal.fire({
                                    title: res.title,
                                    text: res.msg,
                                    icon: res.status,
                                });
                            } else {
                                $("#addBanner")[0].reset();
                                $("#banner").modal("hide");
                                await Swal.fire({
                                    title: res.title,
                                    text: res.msg,
                                    icon: res.status,
                                });
                                window.location.reload();
                            }
                        },
                        error: function() {
                            alert('Error uploading files!');
                        }
                    });
                })
            });
        </script>

</body>

</html>