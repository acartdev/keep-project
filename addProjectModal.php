<?php
require_once("config/db.php");
$conn = new Service;

if (empty($_SESSION['role']) || $_SESSION['role'] == "user") {
    header("location: index.php");
}
$querys = $conn->select("teacher");

?>
<div class="modal fade" id="addpro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มโครงงาน <i class="fa-solid text-danger fa-file-circle-plus"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="addproject" enctype="multipart/form-data">
                    <div class="mb-3 input-group ">
                        <input type="file" accept=".jpg, .png, .jpeg" hidden id="uploadImg" aria-label="Upload">
                        <button class="btn" id="openSelect">
                            <img src="images/empt.jpg" id="thumbPro" class="image-fluid mb-2 rounded" width="150px" alt="" srcset="">
                        </button>
                        <div class="form-control">
                            <label for="uploadDoc" class="col-form-label ">ไฟล์เอกสาร: </label>
                            <input type="file" accept=".doc, .pdf" required class="form-control w-100  mt-2 ms-2" id="uploadDoc" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>

                    </div>
                    <div class="mb-3 input-group">
                        <label for="name" class="col-form-label input-group-text">ชื่อโครงงาน: </label>
                        <input type="text" class="form-control" name="proj_name" placeholder="ชื่อโครงงาน" required>

                    </div>
                    <div class="mb-3" id="prodelm">
                        <div class="mb-2  input-group">
                            <label for="recipient-name" class="col-form-label input-group-text">ผู้จัดทำ:</label>
                            <input type="text" class="form-control" name="prod">
                        </div>

                    </div>
                    <div class="mb-3">
                        <button class="btn  form-control " id="addprod">เพิ่มผู้จัดทำ <i class="fa-solid fa-circle-plus"></i></button>

                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">ครูที่ปรึกษาโครงงาน:</label>

                        <select class="form-select form-select-sm" name="teacher_name" aria-label="Small select example">
                            <?php if (mysqli_num_rows($querys) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($querys)) : ?>

                                    <option selected value="<?= $row['tea_name'] . " " . $row['tea_lastname'] ?>"><?= $row['tea_name'] . " " . $row['tea_lastname'] ?></option>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <option selected>ไม่พบข้อมูลครูที่ปรึกษา</option>

                            <?php endif; ?>


                        </select>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">ประเภทโครงงาน:</label>

                        <select class="form-select form-select-sm" name="type" aria-label="Small select example">

                            <option selected value="ผลิตภัณฑ์/สิ่งใหม่">ผลิตภัณฑ์/สิ่งใหม่</option>
                            <option value="วิจัย/ศึกษาค้นคว้า">วิจัย/ศึกษาค้นคว้า</option>
                            <option value="เชิงสำรวจ">เชิงสำรวจ</option>
                            <option value="เชิงทดลอง">เชิงทดลอง</option>
                        </select>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">ระดับการศึกษา:</label>

                        <select class="form-select form-select-sm" name="proj_edl" aria-label="Small select example">
                            <option selected value="ปวช.3">ปวช.3</option>
                            <option value="ปวส.2">ปวส.2</option>
                            <option value="ปริญญาตรี">ปริญญาตรี</option>
                        </select>
                        <label for="name" class="col-form-label input-group-text">ห้อง: </label>
                        <input type="text" class="form-control" name="room" required>
                    </div>
                    <div class="mb-3 input-group">


                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">ปีการศึกษา:</label>
                        <select name="year" class="form-select form-select-sm" id="year">
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
                <button type="submit" id="addpro-btn" class="btn btn-danger">เพิ่มโครงงาน</button>
            </div>
            </form>
        </div>
    </div>
</div>