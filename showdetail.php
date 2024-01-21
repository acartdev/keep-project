<?php
require_once("config/db.php");
$conn = new Service;
$querys =  $conn->select("teacher");


?>

<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">โครงงาน <i class="fa-solid fa-file-pen text-danger"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="details" enctype="multipart/form-data">
                    <input type="text" name="proj_id" hidden>
                    <div class="mb-3 input-group justify-content-center">

                        <img id="thumbProd" class="image-fluid mb-2 rounded" width="150px" alt="" srcset="">

                        <!-- <div class="form-control">
                            <label for="uploadDoc" class="col-form-label ">ไฟล์เอกสาร: </label>
                            <input type="file" value="" accept=".doc, .pdf" class="form-control w-100  mt-2 ms-2" id="uploadDoc" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div> -->

                    </div>
                    <div class="mb-3 input-group">
                        <label for="name" class="col-form-label input-group-text">ชื่อโครงงาน: </label>
                        <input type="text" class="form-control" name="proj_name" value="" id="proj_name" placeholder="ชื่อโครงงาน" readonly>

                    </div>
                    <div class="mb-3" id="prodelms">



                    </div>

                    <div class="mb-3 input-group">
                        <label for="name" class="col-form-label input-group-text">ครูที่ปรึกษาโครงงาน: </label>
                        <input type="text" class="form-control" name="teacher_name" value="" placeholder="ชื่อโครงงาน" readonly>

                    </div>
                    <div class="mb-3 input-group">
                        <label for="name" class="col-form-label input-group-text">ประเภทโครงงาน: </label>
                        <input type="text" class="form-control" name="type" value="" readonly>

                    </div>
                    <div class="mb-3 input-group">
                        <label for="name" class="col-form-label input-group-text">ระดับการศึกษา: </label>
                        <input type="text" class="form-control" name="proj_edl" value="" readonly>

                    </div>

                    <div class="mb-3 input-group">
                        <label for="recipient-name" class="col-form-label input-group-text">ปีการศึกษา:</label>
                        <input type="text" class="form-control" id="old_year" value="" readonly>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancel">ตกลง</button>
                <!-- <button type="submit" id="addpro-btn" class="btn btn-danger">สมัครสมาชิก</button> -->
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function edit(id) {
        $.ajax({
            type: "GET",
            url: "service/action.php?getproj=1",
            data: {
                id: id
            },

            success: (resonse) => {
                const res = JSON.parse(resonse)
                for (let key in res) {

                    let value = res[key];

                    $(`input[name="${key}"]`).val(value)
                }
                $("#thumbProd").attr("src", res.img)
                $("#old_option").text(res.teacher_name)
                $("#old_edl").text(res.proj_edl)
                $("#old_edl").val(res.proj_edl)
                $("#old_type").text(res.type)
                $("#old_type").val(res.type)
                $("#old_year").val("25" + res.year)

                $.ajax({
                    type: "GET",
                    url: "service/action.php?getprod=1",
                    data: {
                        id: res.proj_id
                    },
                    success: (response1) => {
                        const res = JSON.parse(response1)

                        $("#prodelms").empty()


                        for (let key in res) {
                            let newElement = $(
                                `<div class="mb-2  input-group"> <label for="recipient-name" class="col-form-label input-group-text">ผู้จัดทำ:</label> <input type="text" class="form-control" readonly value="${res[key].user_name}"   name="prod"></div>`
                            );
                            $("#prodelms").append(newElement)
                        }
                    },
                    error: (e1) => {
                        console.log(e1);
                    }
                })
            },
            error: (e) => {
                console.log(e);
            },
        });
    }
</script>