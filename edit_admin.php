<div class="modal fade" id="edit_admin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขผู้จัดการระบบ <i class="fa-solid fa-user-gear"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="editadmin" enctype="multipart/form-data">
                    <div class="mb-3 input-group justify-content-center">
                        <button class="btn" id="openAdminImg1">
                            <img src="images/profile.webp" id="thumbadmin" class="image-fluid mb-2 rounded" width="150px" alt="" srcset="">
                        </button>
                        <input type="file" accept=".jpg, .png, .jpeg" hidden id="old_value" aria-describedby="inputGroupFileAddon04" aria-label="Upload">

                    </div>
                    <div class="mb-3 input-group">
                        <!-- <div class="mb-3 input-group">
                            <label for="recipient-name" class="col-form-label input-group-text">username:</label>
                            <input type="text" class="form-control" name="id" placeholder="ชื่อผู่ใช้ของผู้ดูแลระบบ" required>
                        </div> -->
                        <label for="name" class="col-form-label input-group-text">ชื่อ: </label>
                        <input type="text" class="form-control" name="name" placeholder="ชื่อจริง" required>

                    </div>
                    <div class="mb-3 input-group">
                        <label for="name" class="col-form-label input-group-text">นามสกุล: </label>
                        <input type="text" class="form-control" placeholder="นามสกุลจริง" name="lastname" required>
                    </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancels">ยกเลิก</button>
                <button type="submit" class="btn btn-danger">แก้ไขข้อมูล</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function edit(id) {

        $.ajax({
            type: "GET",
            url: "service/action.php?getuser=1",
            data: {
                id: id
            },

            success: (resonse) => {
                // console.log(resonse);
                const res = JSON.parse(resonse)
                for (let key in res) {
                    let value = res[key];
                    document.getElementById("thumbadmin").src = res.img == "" ? "images/profile.webp" : res.img
                    $(`input[name="${key}"]`).val(value)
                }

            },
            error: (e) => {
                console.log(e);
            },
        });
    }
</script>