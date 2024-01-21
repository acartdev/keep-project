$(document).ready(function () {
  $("#cancel").click((e) => {
    e.preventDefault();
    $("#adminForm")[0].reset();
  });
  $("#openAdminImg").click((e) => {
    e.preventDefault();
    $("#adminImg").click();
  });
  $("#adminImg").change((e) => {
    const [file] = e.target.files;
    $("#thumbadmin").attr("src", URL.createObjectURL(file));
  });
  $("#adminForm").submit((e) => {
    e.preventDefault();
    if (!e.target.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
      return false;
    } else {
      let uploadForm = new FormData();
      let fileInput = $("#adminImg")[0].files[0];
      uploadForm.append("img", fileInput);
      if ($("#password").val().length < 8) {
        $("#password").addClass("is-invalid");
      } else if ($("#repass").val() != $("#password").val()) {
        $("#repass").addClass("is-invalid");
      } else {
        $("#password").removeClass("is-invalid");
        $("#repass").removeClass("is-invalid");
      }
      $.ajax({
        url: "service/uploadImg.php",
        type: "POST",
        data: uploadForm,
        contentType: false,
        processData: false,
        success: function (img) {
          const imgs = JSON.parse(img);
          let formData = {};
          $("#adminForm input").each(function () {
            if ($(this).attr("name") !== undefined) {
              formData[$(this).attr("name")] = $(this).val();
            }
          });
          formData["img"] = imgs.img;
          console.log(formData);
          $.ajax({
            url: "service/action.php?adminregis=1",
            type: "POST",
            data: { data: formData },
            success: async function (resp) {
              // console.log(resp);
              const res = JSON.parse(resp);

              if (res.status == "error") {
                await Swal.fire({
                  title: res.title,
                  text: res.msg,
                  icon: res.status,
                });
              } else {
                $("#adminForm")[0].reset();
                $("#admin").modal("hide");
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
      });
    }
  });
});
