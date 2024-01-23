$(document).ready(function () {
  $("#openSelectRe").click(function (e) {
    e.preventDefault();
    $("#inputGroupFile04").click();
  });
  $("#inputGroupFile04").change(function (e) {
    e.preventDefault();
    const [file] = $(this)[0].files;
    $("#thumb").attr("src", URL.createObjectURL(file));
  });
  $("#regisForm").submit(function (e) {
    e.preventDefault();
    if (!$(this)[0].checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
      return false;
    }
    let uploadForm = new FormData();
    let fileInput = $("#inputGroupFile04")[0].files[0];
    uploadForm.append("img", fileInput);
    if ($("#password").val().length < 8) {
      $("#password").addClass("is-invalid");
    } else if ($("#repass").val() != $("#password").val()) {
      $("#repass").addClass("is-invalid");
    } else {
      $("#password").removeClass("is-invalid");
      $("#repass").removeClass("is-invalid");

      $.ajax({
        url: "service/uploadImg.php",
        type: "POST",
        data: uploadForm,
        contentType: false,
        processData: false,
        success: function (files) {
          // console.log(files);
          let formData = {};
          $("#regisForm input,#regisForm select").each(function () {
            if ($(this).attr("name") !== undefined) {
              formData[$(this).attr("name")] = $(this).val();
            }
          });
          if (files) {
            const file = JSON.parse(files);
            formData["img"] = file.img;
          } else {
            formData["img"] = "images/profile.webp";
          }
          $.ajax({
            url: "service/action.php?register=1",
            type: "POST",
            data: { data: formData },
            success: async function (resp) {
              const res = JSON.parse(resp);

              if (res.status == "error") {
                await Swal.fire({
                  title: res.title,
                  text: res.msg,
                  icon: res.status,
                  footer: res.link
                    ? '<a href="#">หากมีบัญชีอยู่แล้วกรุณาเข้าสู่ระบบ?</a>'
                    : "",
                });
              } else {
                $("#regisForm")[0].reset();
                $("#regis").modal("hide");
                await Swal.fire({
                  title: res.title,
                  text: res.msg,
                  icon: res.status,
                });
                window.location.reload();
              }
            },
            error: function (error) {
              console.error("Error:", error);
            },
          });
        },
        error: function (error) {
          console.error("Error:", error.statusText);
        },
      });
    }
  });
});
