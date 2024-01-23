<div class="modal fade" id="login" tabindex="-1" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    เข้าสู่ระบบ<i class="fa-solid fa-right-to-bracket ms-2"></i>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container pt-3 align-items-center d-flex justify-content-center">
                <img src="images/logo/logo.png" width="100" alt="" />
            </div>
            <form id="loginForm">
                <div class="modal-body">
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">รหัสนักศึกษา:</label>
                        <input type="text" class="form-control" name="id" required />
                    </div>
                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">รหัสผ่าน:</label>
                        <input type="password" class="form-control" name="password" required />
                        <button class="btn btn-outline-secondary" type="button" id="show-pass"><i id="eye" class="fa-solid fa-eye"></i></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        ยกเลิก
                    </button>
                    <button type="submit" id="login-btn" class="btn btn-danger">
                        เข้าสู่ระบบ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $("#show-pass").click(function(e) {
        e.preventDefault()
        let type = $("input[name='password']").attr("type") == "password" ? "text" : "password";
        $("input[name='password']").attr("type", type)
        type == "password" ? $("#eye").toggleClass("fa-eye fa-eye-slash") : $("#eye").toggleClass("fa-eye-slash fa-eye")
    })
</script>