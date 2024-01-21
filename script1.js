$(document).ready(function () {
  $("#loginForm").submit(function (e) {
    e.preventDefault();
    let formData = {};
    $("#loginForm input").each(function () {
      if ($(this).attr("name") !== undefined) {
        formData[$(this).attr("name")] = $(this).val();
      }
    });
    $.ajax({
      url: "service/action.php?login=1",
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
          $("#loginForm")[0].reset();
          $("#login").modal("hide");
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
  });
});
