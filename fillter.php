<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">ตัวกรองการค้นหา</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="filter">
                    <p class="fs-5">ระดับการศึกษา</p>
                    <div class="d-flex flex-column  align-items-start ms-3 mb-3  w-50">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="edl[]" value="ปวส.2">
                            <label class="form-check-label" for="flexCheckDefault">
                                ปวส.2
                            </label>

                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="edl[]" type="checkbox" value="ปวช.3">
                            <label class="form-check-label" for="flexCheckDefault">
                                ปวช.3
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="edl[]" type="checkbox" value="ปริญญาตรี">
                            <label class="form-check-label" for="flexCheckDefault">
                                ปริญญาตรี
                            </label>
                        </div>
                    </div>
                    <p class="fs-5">ประเภท</p>
                    <div class="d-flex flex-column  align-items-start ms-3  w-50">
                        <div class="form-check">
                            <input class="form-check-input" name="type[]" type="checkbox" value="ผลิตภัณฑ์/สิ่งใหม่">
                            <label class="form-check-label" for="flexCheckDefault">
                                ผลิตภัณฑ์/สิ่งใหม่
                            </label>

                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="type[]" type="checkbox" value="วิจัย/ศึกษาค้นคว้า">
                            <label class="form-check-label" for="flexCheckDefault">
                                วิจัย/ศึกษาค้นคว้า
                            </label>

                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="type[]" type="checkbox" value="เชิงสำรวจ">
                            <label class="form-check-label" for="flexCheckDefault">
                                เชิงสำรวจ
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="type[]" type="checkbox" value="เชิงทดลอง">
                            <label class="form-check-label" for="flexCheckDefault">
                                เชิงทดลอง
                            </label>
                        </div>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-danger">กรองข้อมูล</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#filter").submit(e => {
            e.preventDefault()
            let edl = []
            let filterData = {}
            let type = []
            $('input[name="edl[]"]:checked,input[name="type[]"]:checked').each(function() {
                if ($(this).attr("name") == "edl[]") {
                    edl.push($(this).val())
                }
                if ($(this).attr("name") == "type[]") {
                    type.push($(this).val())
                }

            })
            filterData['edl'] = edl
            filterData['type'] = type
            $.ajax({
                url: "fetch.php",
                type: "POST",
                data: filterData,
                success: data => {

                    $("#containers").html(data)
                    $("#staticBackdrop").modal("hide")
                }
            })
        })
    });
</script>