<?php
require_once("config/db.php");
$conn = new Service;
$req = "";
$edl = "";
$type = "";
$where = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // print_r($_POST['edl']);
    if (isset($_POST["edl"])) {
        $edl = "  proj_edl IN('" . implode("','", array_values($_POST["edl"])) . "')";
        if (isset($_POST["type"])) {
            $type = "  type IN('" . implode("','", array_values($_POST["type"])) . "')";
        }
        $where = $type == "" ? $edl : "$edl and $type";
    }

    if (isset($_POST["type"])) {
        $type = "  type IN('" . implode("','", array_values($_POST["type"])) . "')";
        if (isset($_POST["edl"])) {
            $edl = "  proj_edl IN('" . implode("','", array_values($_POST["edl"])) . "')";
        }
        $where = $edl == "" ? $type : "$edl and $type";
    }

    if (isset($_POST["data"])) {


        $req = $_POST['data'];
        $where .= " proj_name LIKE '%$req%' or proj_id  LIKE '%$req%'";
    }
    $query = $conn->select("projects", [], $where == "" ? "1" : $where);
}
?>
<?php if (mysqli_num_rows($query) > 0) { ?>
    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
        <div class="col-sm-6">
            <div class="card mx-auto w-100 ">
                <img src="<?= $row['img'] ? $row['img'] : "images/empt.jpg" ?>" class="card-img-top img-thumbnail" alt="...">
                <div class="card-body d-flex flex-column justify-content-between" style="min-height:200px; max-height:240px">
                    <h5 class="card-title lh-1 d-none d-md-block">รหัสโครงงาน : <?= $row['proj_id'] ?></h5>
                    <p class="card-text lh-1 d-md-none text-break" style="min-height:2rem"><b class="d-none d-md-block">ชื่อเรื่อง</b><?= $row['proj_name'] ?></p>
                    <p class="card-text lh-1 d-none d-md-block" style="min-height:2rem"><b>ชื่อเรื่อง</b>:<?= $row['proj_name'] ?></p>
                    <p class="card-text lh-1 d-none d-md-block"><b>ระดับ</b>:<?= $row['proj_edl'] ?></p>
                    <p class="card-text lh-1 d-none d-md-block"><b>ประเภท</b>:<?= $row['type'] ?></p>
                    <p class="card-text lh-1 d-none d-md-block"><b>ครูที่ปรึกษา</b>:<?= $row['teacher_name'] ?></p>

                    <div class="d-flex justify-content-between flex-md-row flex-column align-items-end">
                        <a onclick="downloads('<?= $row['file'] ?>')" class="btn btn-danger">ดาวน์โหลด</a>

                        <a href="" class="text-secondary" data-bs-target="#detail" data-bs-toggle="modal" onclick="edit('<?= $row['proj_id'] ?>')">ดูเพิ่มเติม...</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php } else { ?>
    <div class="w-100">
        <p class="text-center fs-4">ไม่พบข้อมูลโครงงาน</p>
    </div>
<?php } ?>