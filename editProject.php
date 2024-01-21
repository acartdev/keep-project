<?php
require_once("config/db.php");
$conn = new Service;
$querys =  $conn->select("teacher");
if (empty($_SESSION['role']) || $_SESSION['role'] == "user") {
    header("location: index.php");
}


?>

<div class="modal fade" id="edit_pro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขโครงงาน <i class="fa-solid fa-file-pen text-danger"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="editpro" enctype="multipart/form-data">
                    <input type="text" name="proj_id" hidden>
                    <div class="mb-3 input-group justify-content-center">
                        <input type="file" accept=".jpg, .png, .jpeg" hidden id="editImg" aria-label="Upload">
                        <button class="btn" id="editSelect">
                            <img id="editProd" class="image-fluid mb-2 rounded" width="150px" alt="" srcset="">
                        </button>
                        <div class="form-control">
                            <label for="uploadDoc" class="col-form-label ">ไฟล์เอกสาร: </label>
                            <input type="file" value="" accept=".doc, .pdf" class="form-control w-100  mt-2 ms-2" id="editDoc" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>

                    </div>
                    <div class="mb-3 input-group">
                        <label for="name" class="col-form-label input-group-text">ชื่อโครงงาน: </label>
                        <input type="text" class="form-control" name="proj_name" value="" id="proj_name" placeholder="ชื่อโครงงาน" required>

                    </div>
                    <div class="mb-3" id="prodelms">



                    </div>

                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">ครูที่ปรึกษาโครงงาน:</label>

                        <select class="form-select form-select-sm" name="teacher_name" aria-label="Small select example">
                            <option selected id="old_option"></option>
                            <?php if (mysqli_num_rows($querys) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($querys)) : ?>

                                    <option value="<?= $row['tea_name'] . " " . $row['tea_lastname'] ?>"><?= $row['tea_name'] . " " . $row['tea_lastname'] ?></option>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <option>ไม่พบข้อมูลครูที่ปรึกษา</option>

                            <?php endif; ?>


                        </select>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">ประเภทโครงงาน:</label>

                        <select class="form-select form-select-sm" name="type" aria-label="Small select example">

                            <option selected id="old_type" value=""></option>
                            <option value="type1">ดิษฐ์</option>
                            <option value="type2">ทดลอง</option>
                            <option value="type3">เรียนรู้</option>
                            <option value="type4">ปฏิบัตร</option>
                        </select>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">ระดับการศึกษา:</label>

                        <select class="form-select form-select-sm" name="proj_edl" aria-label="Small select example">
                            <option id="old_edl" selected value=""></option>
                            <option value="ปวช.3">ปวช.3</option>
                            <option value="ปวส.2">ปวส.2</option>
                            <option value="ปริญญาตรี">ปริญญาตรี</option>
                        </select>

                    </div>

                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">ปีการศึกษา:</label>
                        <select name="year" class="form-select form-select-sm" id="year">
                            <option selected id="old_year" value=""></option>
                            <?php

                            $startYear = 2000 + 543;
                            $currentYear = date("Y") + 543;
                            for ($year = $currentYear; $year >= $startYear; $year--) {
                                $values = substr("$year", -2);
                                echo "<option value=\"$values\" > $year</option>";
                            }
                            ?>
                        </select>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel">ยกเลิก</button>
                <button type="submit" id="addpro-btn" class="btn btn-danger">สมัครสมาชิก</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function edit(id) {
        $.ajax({
            type: "GET",
            url: "service/action.php?getproj=1",
            data: {
                id: id
            },

            success: (resonse) => {
                const res = JSON.parse(resonse)
                for (let key in res) {

                    let value = res[key];

                    $(`input[name="${key}"]`).val(value)
                }
                document.getElementById("editProd").src = res.img ? res.img : "images/empt.jpg"
                $("#old_option").text(res.teacher_name)
                $("#old_edl").text(res.proj_edl)
                $("#old_edl").val(res.proj_edl)
                $("#old_type").text(res.type)
                $("#old_type").val(res.type)
                $("#old_year").text("25" + res.year)
                $("#old_year").val(res.year)

                $.ajax({
                    type: "GET",
                    url: "service/action.php?getprod=1",
                    data: {
                        id: res.proj_id
                    },
                    success: (response1) => {
                        const res = JSON.parse(response1)

                        $("#prodelms").empty()


                        for (let key in res) {
                            let newElement = $(
                                `<div class="mb-2  input-group"><input value="${res[key].id}" name="id" hidden/><label for="recipient-name" class="col-form-label input-group-text">ผู้จัดทำ:</label> <input type="text" class="form-control" value="${res[key].user_name}"   name="prod"></div>`
                            );
                            $("#prodelms").append(newElement)
                        }
                    },
                    error: (e1) => {
                        console.log(e1);
                    }
                })
            },
            error: (e) => {
                console.log(e);
            },
        });
    }
</script>