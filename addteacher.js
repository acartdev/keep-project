$(document).ready(function () {
  $("#cancel").click(function (e) {
    e.preventDefault();
    $("#teacherForm")[0].reset();
  });
  $("#teacherImg").change((e) => {
    e.preventDefault();
    const [file] = e.target.files;
    $("#thumbteachar").attr("src", URL.createObjectURL(file));
  });
  $("#openTeacherImg").click((e) => {
    e.preventDefault();
    $("#teacherImg").click();
  });

  $("#teacherForm").submit(function (e) {
    e.preventDefault();
    if (!$(this)[0].checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
      return false;
    }
    let uploadForm = new FormData();
    let fileInput = $("#teacherImg")[0].files[0];
    uploadForm.append("img", fileInput);

    $.ajax({
      type: "POST",
      url: "service/uploadImg.php",
      data: uploadForm,
      contentType: false,
      processData: false,
      success: function (img) {
        const imgres = JSON.parse(img);
        let formData = {};
        $("#teacherForm input,#teacherForm select").each(function () {
          if ($(this).attr("name") !== undefined) {
            formData[$(this).attr("name")] = $(this).val();
          }
        });
        formData["img"] = imgres.img;
        $.ajax({
          url: "service/action.php?addteacher=1",
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
              $("#teacherForm")[0].reset();
              $("#teacher").modal("hide");
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
  });
});
