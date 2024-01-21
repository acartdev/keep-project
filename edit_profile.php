<div class="modal fade" id="edit_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขข้อมูลส่วนตัว <i class="fa-regular fa-circle-user ms-2"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="editProfile" enctype="multipart/form-data">
                    <div class="mb-3 input-group justify-content-center">
                        <button class="btn" id="profile-btn">
                            <img src="<?= $_SESSION['img'] == '' ? "images/profile.webp" : $_SESSION['img'] ?>" id="thumbprofile" class="image-fluid mb-2 rounded" width="150px" alt="" srcset="">

                        </button>
                    </div>
                    <input type="file" accept=".jpg, .png, .jpeg" hidden class="form-control w-25 h-25 mt-2 ms-2" id="editproimg" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <div class="mb-3 input-group">
                        <label for="name" class="col-form-label input-group-text">ชื่อ: </label>
                        <input type="text" class="form-control" name="name" id="pro_name" value="<?= $_SESSION['name'] ?>" placeholder="ชื่อจริง" required>
                        <label for="name" class="col-form-label input-group-text">นามสกุล: </label>
                        <input type="text" class="form-control" id="pro_lastname" value="<?= $_SESSION['lastname'] ?>" placeholder="นามสกุลจริง" name="lastname" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text"><?= $_SESSION['role'] !== "user" ? "username" : "รหัสนักศึกษา" ?>:</label>
                        <input type="text" class="form-control" name="id" value="<?= $_SESSION['id'] ?>" readonly>
                    </div>
                    <?php if ($_SESSION['dept'] != "") : ?>
                        <div class="mb-3 input-group">
                            <label for="recipient-name" class="col-form-label input-group-text">แผนก:</label>
                            <input type="text" class="form-control" name="dept" value="เทคโนโลยีสารสนเทศ(IT)" readonly>
                        </div>
                    <?php endif ?>
                    <?php if ($_SESSION['edl'] != "") : ?>
                        <div class="mb-3 input-group">
                            <label for="recipient-name" class="col-form-label input-group-text">ระดับการศึกษา:</label>

                            <select class="form-select form-select-sm" name="edl" aria-label="Small select example">

                                <option id='old_value' selected value="<?= $_SESSION['edl'] ?>"><?= $_SESSION['edl'] ?></option>
                                <option value="ปวช.3">ปวช.3</option>
                                <option value="ปวส.2">ปวส.2</option>
                                <option value="ปริญญาตรี">ปริญญาตรี</option>
                            </select>
                        </div>
                    <?php endif ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="submit" id="edit-profile-btn" class="btn btn-danger">แก้ไขข้อมูล</button>
            </div>
            </form>
        </div>
    </div>
</div>