<?php
require_once("config/db.php");

$conn = new Service;
session_start();
if (empty($_SESSION['role']) || $_SESSION['role'] == "user") {
    header("location: index.php");
}
$query = $conn->select("projects"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>จัดการโครงงาน</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <?php include('nav.php'); ?>

    <?php include('startnav.php'); ?>

    <?php include("addProjectModal.php") ?>
    <div class="container bg-white">
        <div class="container-fluid w-100 h-100 d-flex justify-content-between align-items-center pt-4">
            <p class="fs-3">ผลงานและโครงาน</p>

            <button class="btn btn-danger ms-2" type="submit" data-bs-toggle="modal" data-bs-target="#addpro">
                เพิ่มโครงงาน <i class="fa-solid fa-file-circle-plus"></i>
            </button>
        </div>
        <hr />
        <?php if (
            mysqli_num_rows($query) >
            0
        ) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 130px">รหัสโครงงาน</th>
                        <th scope="col">ปกโครงงาน</th>
                        <th scope="col">ชื่อโครงงาน</th>
                        <th scope="col">ประเภท</th>

                        <th scope="col" class="text-center" style="width: 160px">ผู้จัดทำ</th>
                        <th scope="col">ระดับชั้น</th>
                        <th scope="col">ปีการศึกษา</th>
                        <th scope="col" class="text-center">ไฟล์</th>
                        <th scope="col" class="text-end">เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                        <tr>
                            <td scope="row"><?= $row['proj_id'] ?></td>
                            <td class="" style="width: 150px; height: 130px">
                                <img src="<?= $row['img'] ?>" alt="Image 1" class="img-fluid" />
                            </td>
                            <td><?= $row['proj_name'] ?></td>
                            <td colspan=""><?= $row['type'] ?></td>
                            <td colspan="" class="text-start">
                                <?php
                                $proj_id = $row['proj_id'];
                                $prods = $conn->select(
                                    "product",
                                    [],
                                    "project_id = '$proj_id'"
                                );
                                while ($rows =
                                    mysqli_fetch_assoc($prods)
                                ) : ?>
                                    <p class="fs-6"><?= $rows['user_name'] ?></p>
                                <?php endwhile; ?>
                            </td>

                            <td><?= $row['proj_edl'] ?></td>
                            <td><?= "พ.ศ. 25" . $row['year'] ?></td>
                            <td class="text-center">
                                <a href="<?= $row['file'] ?>" download="">ดาวน์โหลด</a>
                            </td>
                            <td style="width: 200px">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger" onclick="deleted('<?= $row['proj_id'] ?>')">
                                        ลบ <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <button data-bs-target="#edit_pro" data-bs-toggle="modal" type="button" class="btn btn-warning ms-3 " onclick="edit('<?= $row['proj_id'] ?>')">

                                        แก้ไข <i class="fa-solid fa-pen"></i>

                                    </button>

                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-center fs-4 p-4">ไม่พบข้อมูลโครงงาน</p>
        <?php endif; ?>
    </div>

    <?php include('editProject.php'); ?>
    <?php include('endnav.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="script1.js"></script>
    <script src="addproject.js"></script>
    <script>
        const deleted = (id) => {
            Swal.fire({
                title: "ลบโครงงาน/วิจัย?",
                text: "คุณต้องการลบโครงงาน/วิจัยหรือไม่?",
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
                        url: "service/action.php?deletepro=1",
                        data: {
                            id: id
                        },
                        success: async function(response) {
                            // console.log(response);
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


            $("#editSelect").click(function(e) {
                e.preventDefault();
                $("#editImg").click();
            });
            $("#editImg").change((e) => {
                e.preventDefault();

                const [file] = e.target.files;
                $("#editProd").attr("src", URL.createObjectURL(file));
            });
            $("#editpro").submit(async function(e) {

                e.preventDefault();
                let formData = {};
                $("#editpro input,#editpro select").each(function() {
                    let inputName = $(this).attr("name");
                    if (inputName !== undefined) {
                        let inputValue = $(this).val();
                        if (inputName == "id" || inputName == "prod") {
                            if (!formData[inputName]) {
                                formData[inputName] = [];
                            }
                            formData[inputName].push(inputValue);
                        } else {
                            formData[inputName] = inputValue;
                        }
                    }
                });

                let uploadFile = new FormData();
                let uploadImg = new FormData();
                let fileInput = $("#editDoc")[0].files[0];
                let imgInput = $("#editImg")[0].files[0];
                let id = $('input[name="proj_id"]').val();
                if ($("#editImg").val()) {
                    uploadImg.append("img", imgInput)
                }
                if ($("#editDoc").val()) {

                    uploadFile.append("file", fileInput)
                }
                $.ajax({
                    url: `service/uploadFile.php?editProjfile=${id}`,
                    type: "POST",
                    data: uploadFile,
                    contentType: false,
                    processData: false,
                    success: async file => {
                        // console.log(file);
                        if (file) {

                            const res = await JSON.parse(file)

                            formData['file'] = res.file
                        } else {
                            // console.log("not");
                        }
                        $.ajax({
                            url: `service/uploadImg.php?editProjimg=${id}`,
                            type: "POST",
                            data: uploadImg,
                            contentType: false,
                            processData: false,
                            success: async img => {
                                console.log(img);
                                if (img) {

                                    const res = await JSON.parse(img)

                                    formData['img'] = res.img
                                } else {
                                    // console.log("not");
                                }
                                $.ajax({
                                    url: "service/action.php?editProject=1",
                                    type: "POST",
                                    data: {
                                        data: formData
                                    },
                                    success: async function(resp) {
                                        console.log(resp);
                                        const res = JSON.parse(resp);

                                        if (res.status == "error") {
                                            await Swal.fire({
                                                title: res.title,
                                                text: res.msg,
                                                icon: res.status,
                                            });
                                        } else {
                                            $("#editpro")[0].reset();
                                            $("#edit_pro").modal("hide");
                                            await Swal.fire({
                                                title: res.title,
                                                text: res.msg,
                                                icon: res.status,
                                            });
                                            window.location.reload();
                                        }
                                    },
                                    error: function(error) {
                                        console.error("Error:", error);
                                    },
                                });
                            }

                        })

                    }

                })





                // console.log(formData);

            });
        });
    </script>


</body>

</html>