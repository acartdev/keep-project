<div class="modal fade" id="teacher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มครูที่ปรึกษาโครงงาน<i class="fa-regular fa-circle-user ms-2"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="teacherForm" enctype="multipart/form-data">
                    <div class="mb-3 input-group justify-content-center">
                        <button class="btn" id="openTeacherImg">
                            <img src="images/profile.webp" id="thumbteachar" class="image-fluid mb-2 rounded" width="150px" alt="" srcset="">
                        </button>
                        <input type="file" accept=".jpg, .png, .jpeg" class="form-control " hidden id="teacherImg" aria-describedby="inputGroupFileAddon04" aria-label="Upload">

                    </div>
                    <div class="mb-3 input-group">
                        <label for="name" class="col-form-label input-group-text">ชื่อ: </label>
                        <input type="text" class="form-control" name="tea_name" placeholder="ชื่อจริง" required>
                        <label for="name" class="col-form-label input-group-text">นามสกุล: </label>
                        <input type="text" class="form-control" id="tea_lastname" placeholder="นามสกุลจริง" name="tea_lastname" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">รหัสครู:</label>
                        <input type="text" class="form-control" name="tea_id" placeholder="รหัสบุคลากรทางการศึกษา" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">แผนก:</label>
                        <input type="text" class="form-control" id="tea_dept" name="tea_dept" value="เทคโนโลยีสารสนเทศ(IT)" readonly>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel">ยกเลิก</button>
                <button type="submit" id="regis-btn" class="btn btn-danger">สมัครสมาชิก</button>
            </div>
            </form>
        </div>
    </div>
</div>