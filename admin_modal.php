<div class="modal fade" id="admin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มผู้จัดการระบบ <i class="fa-solid fa-user-gear"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="adminForm" enctype="multipart/form-data">
                    <div class="mb-3 input-group justify-content-center">
                        <button class="btn" id="openAdminImg">
                            <img src="images/profile.webp" id="thumbadmin" class="image-fluid mb-2 rounded" width="150px" alt="" srcset="">
                        </button>
                        <input type="file" accept=".jpg, .png, .jpeg" hidden id="adminImg" aria-describedby="inputGroupFileAddon04" aria-label="Upload">

                    </div>
                    <div class="mb-3 input-group">
                        <div class="mb-3 input-group">
                            <label for="recipient-name" class="col-form-label input-group-text">username:</label>
                            <input type="text" class="form-control" name="id" placeholder="ชื่อผู่ใช้ของผู้ดูแลระบบ" required>
                        </div>
                        <label for="name" class="col-form-label input-group-text">ชื่อ: </label>
                        <input type="text" class="form-control" name="name" placeholder="ชื่อจริง" required>
                        <label for="name" class="col-form-label input-group-text">นามสกุล: </label>
                        <input type="text" class="form-control" id="lastname" placeholder="นามสกุลจริง" name="lastname" required>
                    </div>

                    <div class="mb-3 input-group " id="checkPass">
                        <label for="recipient-name" class="col-form-label input-group-text">รหัสผ่าน:</label>
                        <input type="password" class="form-control " placeholder="รหัสผ่านต้องมีความยาวมากกว่า 8 ตัวอักษร" id="password" name="password" required>
                        <div class="invalid-feedback">
                            รหัสผ่านต้องมีความยาวมากกว่า 8-20 ตัวอักษร
                        </div>
                    </div>
                    <div class="mb-3 input-group" id="checkRePass">
                        <label for="recipient-name" class="col-form-label input-group-text">ยืนยันรหัสผ่าน:</label>

                        <input type="password" class="form-control" placeholder="ใส่รหัสผ่านอีกครั้ง" id="repass" required>
                        <div class="invalid-feedback">
                            ยืนยันรหัสผ่านไม่ตรงกัน
                        </div>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel">ยกเลิก</button>
                <button type="submit" id="regis-admin-btn" class="btn btn-danger">สมัครสมาชิก</button>
            </div>
            </form>
        </div>
    </div>
</div>