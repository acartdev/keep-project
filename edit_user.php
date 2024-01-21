<div class="modal fade" id="edit_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขสมาชิก<i class="fa-regular fa-circle-user ms-2"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="editUser">
                    <div class="mb-3 input-group justify-content-center">
                        <button class="btn" id="editUserImg-btn">
                            <img src="" id="thumbusers" class="image-fluid mb-2 rounded" width="150px" alt="" srcset="">

                        </button>
                    </div>
                    <input type="file" accept=".jpg, .png, .jpeg" hidden class="form-control w-25 h-25 mt-2 ms-2" id="editUserImg" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <div class="mb-3 input-group">
                        <label for="name" class="col-form-label input-group-text">ชื่อ: </label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อจริง" required>
                        <label for="name" class="col-form-label input-group-text">นามสกุล: </label>
                        <input type="text" class="form-control" id="lastname" placeholder="นามสกุลจริง" name="lastname" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">รหัสนักศึกษา:</label>
                        <input type="text" class="form-control" name="id" placeholder="รหัสนักศึกษา" readonly>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">แผนก:</label>
                        <input type="text" class="form-control" id="dept" name="dept" value="เทคโนโลยีสารสนเทศ(IT)" readonly>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">ระดับการศึกษา:</label>

                        <select class="form-select form-select-sm" name="edl" aria-label="Small select example">

                            <option id='old_value' selected value=""></option>
                            <option value="ปวช.3">ปวช.3</option>
                            <option value="ปวส.2">ปวส.2</option>
                            <option value="ปริญญาตรี">ปริญญาตรี</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="submit" id="edit-users-btn" class="btn btn-danger">แก้ไขข้อมูล</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function edit(id) {
        // console.log(id);
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
                    // document.getElementById("thumbuser").src = res.img == "" ? "images/profile.webp" : res.img
                    $(`input[name="${key}"]`).val(value)
                }
                $("#old_value").val(res.edl)
                $("#old_value").text(res.edl)
                document.getElementById("thumbusers").src = res.img == "" ? "images/profile.webp" : res.img


            },
            error: (e) => {
                console.log(e);
            },
        });
    }
</script>