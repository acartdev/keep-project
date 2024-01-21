<div class="modal fade" id="edit_teacher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขครูที่ปึกษาโครงงาน<i class="fa-regular fa-circle-user ms-2"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="editteacher" enctype="multipart/form-data">
                    <input type="text" name="tea_id" hidden>
                    <div class="mb-3 input-group justify-content-center">
                        <button class="btn" id="openSelectTeacher">
                            <img src="images/profile.webp" id="thumbold" class="image-fluid mb-2 rounded" width="150px" alt="" srcset="">
                        </button>
                        <input type="file" accept=".jpg, .png, .jpeg" class="d-none" id="editTeacherImg" aria-describedby="inputGroupFileAddon04" aria-label="Upload">

                    </div>
                    <div class="mb-3 input-group">
                        <label for="name" class="col-form-label input-group-text">ชื่อ: </label>
                        <input type="text" class="form-control" name="tea_name" placeholder="ชื่อจริง" required>
                        <label for="name" class="col-form-label input-group-text">นามสกุล: </label>
                        <input type="text" class="form-control" id="tea_lastname" placeholder="นามสกุลจริง" name="tea_lastname" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">รหัสครู:</label>
                        <input type="text" class="form-control" name="tea_id" placeholder="รหัสบุคลากรทางการศึกษา" readonly>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">แผนก:</label>
                        <input type="text" class="form-control" id="tea_dept" name="tea_dept" value="เทคโนโลยีสารสนเทศ(IT)" readonly>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel">ยกเลิก</button>
                <button type="submit" id="regis-btn" class="btn btn-danger">แก้ไขข้อมูล</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function edit(id) {
        $.ajax({
            type: "GET",
            url: "service/action.php?getteacher=1",
            data: {
                id: id
            },

            success: (resonse) => {
                // console.log(resonse);
                const res = JSON.parse(resonse)
                for (let key in res) {
                    let value = res[key];
                    document.getElementById("thumbold").src = res.img == "" ? "images/profile.webp" : res.img
                    $(`input[name="${key}"]`).val(value)
                }
            },
            error: (e) => {
                console.log(e);
            },
        });
    }
</script>