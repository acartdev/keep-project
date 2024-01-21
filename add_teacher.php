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

    <?php include("addTeacherModal.php") ?>
    <div class="container bg-white ">
        <div class="container-fluid w-100 h-100  d-flex justify-content-between align-items-center pt-4">
            <p class="fs-3">จัดการครูที่ปรึกษา <i class="fa-solid fa-address-card text-danger"></i></p>
            <button class=" btn btn-danger ms-2" type="submit" data-bs-toggle="modal" data-bs-target="#teacher">เพิ่มครูที่ปรึกษาโครงงาน <i class="fa-solid fa-file-circle-plus"></i></button>

        </div>
        <hr>
        <?php if (mysqli_num_rows($query) > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">รหัสครู</th>
                        <th scope="col" class="text-start">โปรไฟล์</th>
                        <th scope="col" class="text-center">ชื่อ-นามสกุล</th>
                        <th scope="col">แผนก</th>


                        <th scope="col" class="text-end">เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>

                        <tr>
                            <td class="" style="width:150px;"><?= $row['tea_id'] ?></td>
                            <td class="" style="width:100px; height:100px"><img src="<?= $row['img'] ?>" alt="Image 1" class="mx-auto img-thumbnail img-fluid rounded-circle w-100 h-100"></td>
                            <td class="text-center"><?= $row['tea_name'] . " " . $row['tea_lastname'] ?></td>

                            <td><?= $row['tea_dept'] ?></td>

                            <td style="width: 200px;">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger" onclick="deleted(<?= $row['tea_id'] ?>)">
                                        ลบ <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <button type="button" data-bs-target="#edit_teacher" data-bs-toggle="modal" class="btn btn-warning ms-3" onclick="edit(<?= $row['tea_id'] ?>)">
                                        แก้ไข <i class="fa-solid fa-pen"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    <?php endwhile; ?>


                </tbody>
            </table>
        <?php else : ?>
            <p class="text-center fs-4 p-4">ไม่พบข้อมูลครูที่ปรึกษา</p>
        <?php endif; ?>
    </div>
    <?php include('endnav.php'); ?>
    <?php include("edit_teacher.php") ?>









    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="script1.js"></script>
    <script src="addteacher.js"></script>
    <script>
        const deleted = (id) => {
            Swal.fire({
                title: "ลบครูที่ปรึกษา?",
                text: "คุณต้องการลบครูที่ปรึกษาหรือไม่?",
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
                        url: "service/action.php?deletetea=1",
                        data: {
                            id: id
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
            $("#openSelectTeacher").click(function(e) {
                e.preventDefault()
                $("#editTeacherImg").click()
            })
            $("#editTeacherImg").change(function(e) {
                e.preventDefault()
                const [file] = $(this)[0].files
                $("#thumbold").attr("src", URL.createObjectURL(file))
            })
            $("#editteacher").submit(e => {
                e.preventDefault()
                if (!e.target.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                } else {
                    let id = $("input[name='tea_id']").val()
                    let uploadImg = new FormData()
                    let imgFile = $("#editTeacherImg")[0].files[0]
                    if ($("#editTeacherImg").val()) {
                        uploadImg.append("img", imgFile)
                    }
                    $.ajax({
                        url: `service/uploadImg.php?editTeacherImg=${id}`,
                        type: "POST",
                        data: uploadImg,
                        processData: false,
                        contentType: false,
                        success: imgs => {

                            let formData = {};
                            $("#editteacher input,#editteacher select").each(function() {
                                if ($(this).attr("name") !== undefined) {
                                    formData[$(this).attr("name")] = $(this).val();
                                }
                            });
                            if (imgs) {
                                const img = JSON.parse(imgs)
                                formData['img'] = img.img
                            }
                            $.ajax({
                                type: "POST",
                                url: "service/action.php?editteacher=1",
                                data: {
                                    data: formData
                                },
                                success: async (respons) => {
                                    console.log(respons);
                                    const res = JSON.parse(respons)
                                    if (res.status == "error") {
                                        await Swal.fire({
                                            title: res.title,
                                            text: res.msg,
                                            icon: res.status,
                                        });
                                    } else {
                                        $("#editteacher")[0].reset();
                                        $("#edit_teacher").modal("hide");
                                        await Swal.fire({
                                            title: res.title,
                                            text: res.msg,
                                            icon: res.status,
                                        });
                                        window.location.reload();
                                    }


                                },
                                error: (e) => {
                                    console.log(e);
                                }
                            })
                        }
                    })
                }

            })
        });
    </script>
</body>

</html>