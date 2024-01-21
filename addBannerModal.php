<div class="modal fade" id="banner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มรูปภาพ <i class="fa-regular fa-images"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addBanner">
                <div class="modal-body">
                    <p class="fs-5">สามารถเลือกได้หลายไฟล์:</p>
                    <div class="input-group">

                        <input type="file" accept=".png, .jpg, .jpeg" multiple class="form-control" required name="images[]" id="imgInput" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" id="banner-btn" class="btn btn-danger">เพิ่มรูปภาพ</button>
                </div>
            </form>
        </div>
    </div>
</div>