function showAlert(code, strong, message) {
  alertmsg = document.createElement("div");
  alertmsg.setAttribute("id", "alertmsg");
  alerttype = "";
  if (code == 200) {
    alerttype = "alert-success";
  } else if (code == 401) {
    alerttype = "alert-warning";
  } else {
    alerttype = "alert-danger";
  }
  alertmsg.setAttribute(
    "class",
    `alert ${alerttype} alert-dismissible fade in show`
  );

  clsbtn = document.createElement("a");
  clsbtn.setAttribute("href", "#");
  clsbtn.setAttribute("class", "close");
  clsbtn.setAttribute("data-dismiss", "alert");
  clsbtn.setAttribute("aria-label", "close");
  clsbtn.setAttribute("style", "font-size: x-large");
  clsbtn.innerHTML = "&times;";
  alertmsg.appendChild(clsbtn);

  msgheadding = document.createElement("strong");
  msgheadding.setAttribute("style", "font-size:large");
  msgheadding.innerHTML = strong;

  alertmsg.appendChild(msgheadding);

  msgtext = document.createElement("p");
  msgtext.setAttribute("style", "font-size: initial;");
  msgtext.innerHTML = message;

  alertmsg.appendChild(msgtext);
  maindiv = document.getElementsByTagName("main")[0];

  maindiv.insertBefore(alertmsg, maindiv.firstChild);
}

$("button#btn-entrevista").click((e) => {
  e.preventDefault();
  $.ajax({
    url: "dashboard_index.php",
    method: "POST",
    data: { requestinterview: "" },
    dataType: "json",
    success: (data) => {
      if (Object.is(data.link, null)) {
        var newform = document.createElement("form");
        newform.setAttribute("method", "POST");
        newform.setAttribute("action", "");
      }
    },
  });
});

$("button#btn-gen").click((e) => {
  $.ajax({
    url: "dashboard_index.php",
    method: "POST",
    data: { generarsol: "" },
    xhrFields: {
      responseType: "blob",
    },
    success: function (response, status, xhr) {
      var blob = new Blob([response], {
        type: "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
      });
      var link = document.createElement("a");
      link.href = window.URL.createObjectURL(blob);
      link.setAttribute("target", "_blank");
      var filename = "";
      var disposition = xhr.getResponseHeader("Content-Disposition");
      if (disposition && disposition.indexOf("attachment") !== -1) {
        var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
        var matches = filenameRegex.exec(disposition);
        if (matches != null && matches[1]) {
          filename = matches[1].replace(/['"]/g, "");
        }
      }
      link.download = filename;
      link.click();
      showAlert(200, "Operación exitosa", "Solicitud generada correctamente");
    },
  });
});

$("form#formsolicitud").submit((e) => {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("enviarsolicitud", "");
  $.ajax({
    url: window.location.pathname,
    type: "POST",
    data: formData,
    dataType: "json",
    success: function (data) {
      btnclose = document.getElementById("closemodal");
      btnclose.click();
      showAlert(data.code, data.strong, data.message);
    },
    cache: false,
    contentType: false,
    processData: false,
  });
});

$("form#formreporte").submit((e) => {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("enviarreporte", "");
  $.ajax({
    url: window.location.pathname,
    type: "POST",
    data: formData,
    dataType: "json",
    success: function (data) {
      btnclose = document.getElementById("closemodal");
      btnclose.click();
      showAlert(data.code, data.strong, data.message);
    },
    cache: false,
    contentType: false,
    processData: false,
  });
});
