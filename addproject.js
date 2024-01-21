$(document).ready(function () {
  $("#uploadImg").change((e) => {
    e.preventDefault();

    const [file] = e.target.files;
    $("#thumbPro").attr("src", URL.createObjectURL(file));
  });
  $("#cancel").click(function (e) {
    e.preventDefault();
    $("#addproject")[0].reset();
  });
  $("#openSelect").click(function (e) {
    e.preventDefault();
    $("#uploadImg").click();
  });
  $("#addprods").click(function (e) {
    e.preventDefault();
    let newElement = $(
      '<div class="mb-2  input-group"> <label for="recipient-name" class="col-form-label input-group-text">ผู้จัดทำ:</label> <input type="text" class="form-control"  name="prod"></div>'
    );
    $("#prodelms").append(newElement);
  });
  $("#addprod").click(function (e) {
    e.preventDefault();
    let newElement = $(
      '<div class="mb-2  input-group"> <label for="recipient-name" class="col-form-label input-group-text">ผู้จัดทำ:</label> <input type="text" class="form-control"  name="prod"></div>'
    );
    $("#prodelm").append(newElement);
  });
  $("#addproject").submit(function (e) {
    e.preventDefault();

    let formData = {};
    let uploadFile = new FormData();
    let uploadImg = new FormData();
    let fileInput = $("#uploadDoc")[0].files[0];
    let imgInput = $("#uploadImg")[0].files[0];
    uploadFile.append("file", fileInput);
    uploadImg.append("img", imgInput);

    $.ajax({
      type: "POST",
      url: "service/uploadFile.php",
      data: uploadFile,
      contentType: false,
      processData: false,
      success: function (file) {
        console.log(imgInput);
        if (file) {
          const files = JSON.parse(file);
          formData["file"] = files.file;
        }
        $.ajax({
          type: "POST",
          url: "service/uploadImg.php",
          data: uploadImg,
          contentType: false,
          processData: false,
          success: function (img) {
            console.log(img);
            if (img) {
              const imgs = JSON.parse(img);
              formData["img"] = imgs.img;
            }

            $("#addproject input,#addproject select").each(function () {
              let inputName = $(this).attr("name");
              if (inputName !== undefined) {
                let inputValue = $(this).val();
                if (inputName == "prod") {
                  if (!formData[inputName]) {
                    formData[inputName] = [];
                  }
                  formData[inputName].push(inputValue);
                } else {
                  formData[inputName] = inputValue;
                }
              }
            });
            $.ajax({
              url: "service/action.php?addProject=1",
              type: "POST",
              data: { data: formData },
              success: async function (resp) {
                console.log(resp);
                const res = JSON.parse(resp);

                if (res.status == "error") {
                  await Swal.fire({
                    title: res.title,
                    text: res.msg,
                    icon: res.status,
                  });
                } else {
                  $("#addproject")[0].reset();
                  $("#addpro").modal("hide");
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
      },
    });
  });
});
