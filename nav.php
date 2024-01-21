<?php

if (empty($_SESSION["id"])) {
  $show = true;
} else {
  $show = false;
}
?>

<nav class="navbar navbar-expand-lg bg-white shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="images/logo/logo.png" width="60" class="img-fluid" alt="..."></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">

      <ul class="navbar-nav  mb-2 mb-lg-0">

        <?php if ($show) : ?>
          <li class="nav-item">
            <a class="nav-link" href="#"><button class="btn btn-outline-danger" type="submit" data-bs-toggle="modal" data-bs-target="#regis" data-bs-whatever="@mdo">สมัครสมาชิก</button></a>
          </li>

          <li class="nav-item">
            <a class="nav-link " aria-disabled="true"><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#login" data-bs-whatever="@mdo">เข้าสู่ระบบ</button></a>
          </li>
        <?php endif; ?>

        <?php if (!$show) : ?>

          <li class="nav-item  d-flex align-items-center">

            <p class=" my-auto fs-5"><?= $_SESSION['name'] . " " . $_SESSION['lastname'] ?></p>
            <a class="nav-link ms-2 d-md-none" data-bs-target="#edit_profile" data-bs-toggle="modal" href=""><img width="45" src=<?= $_SESSION['img'] ?> class="img-thumbnail rounded-circle" alt="..."></a>


          </li>
          <li class="nav-item d-none d-md-block">
            <a class="nav-link" data-bs-target="#edit_profile" data-bs-toggle="modal" href=""><img width="45" src=<?= $_SESSION['img'] ?> class="img-thumbnail rounded-circle" alt="..."></a>
          </li>

          <li class="nav-item d-flex align-items-center">
            <a class="nav-link " aria-disabled="true"><button type="button" id="logout" class="btn btn-outline-danger fs-6">ออกจากระบบ</button></a>
          </li>

        <?php endif; ?>
      </ul>

    </div>
  </div>
</nav>
<?php include("edit_profile.php") ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
  $("#profile-btn").click(function(e) {
    e.preventDefault()
    $("#editproimg").click()
  })
  $("#editproimg").change(function(e) {
    e.preventDefault()
    const [file] = $(this)[0].files
    $("#thumbprofile").attr("src", URL.createObjectURL(file))
  })
  $("#editProfile").submit(e => {
    e.preventDefault()
    // console.log(e);
    if (!e.target.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
      return false;
    } else {
      let id = $('input[name="id"]').val()
      let imgFile = $("#editproimg")[0].files[0]
      let upLoadImg = new FormData()
      if ($("#editproimg").val()) {
        upLoadImg.append("img", imgFile)
      }
      $.ajax({
        url: `service/uploadImg.php?editUserImg=${id}`,
        type: "POST",
        data: upLoadImg,
        contentType: false,
        processData: false,
        success: imgs => {

          let formData = {};
          $("#editProfile input,#editProfile select").each(function() {
            if ($(this).attr("name") !== undefined) {
              formData[$(this).attr("name")] = $(this).val();
            }
          });
          if (imgs) {
            const img = JSON.parse(imgs)
            formData['img'] = img.img
          }
          $.ajax({
            type: "POST",
            url: "service/action.php?edituser=1&logout=1",
            data: {
              data: formData
            },
            success: async (respons) => {
              console.log(respons);
              const res = JSON.parse(respons)
              if (res.status == "error") {
                await Swal.fire({
                  title: res.title,
                  text: res.msg,
                  icon: res.status,
                });
              } else {
                $("#editProfile")[0].reset();
                $("#edit_profile").modal("hide");
                await Swal.fire({
                  title: res.title,
                  text: res.msg,
                  icon: res.status,
                });
                window.location.reload();
              }


            },
            error: (e) => {
              console.log(e);
            }
          })
        }
      })
    }

  })
  $("#logout").on("click", function(e) {
    e.preventDefault();
    Swal.fire({
      title: "ออกจากระบบ",
      text: "คุณต้องการจะออกจากระบบหรือไม่?",
      icon: "warning",
      cancelButtonText: "ยกเลิก",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",

      confirmButtonText: "ตกลง",
    }).then(async (result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "service/action.php?logout=1",

          success: async function(response) {
            await Swal.fire({
              title: "ออกจากระบบเรียนร้อย!",
              text: "คุณได้ทำการออกจากระบบสำเร็จ!",
              icon: "success",
            });
            window.location.reload();
          },
        });
      }
    });
  });
</script>