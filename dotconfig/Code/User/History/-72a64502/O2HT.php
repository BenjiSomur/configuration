<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/bootstrap/js/popper.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--===============================================================================================-->
<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="../js/main.js"></script>
<script type="text/javascript">
    function generarSolicitud() {
        $.ajax({
            url: "generateDocument.php",
            method: 'POST',
            data: { generarsol: '' },
            xhrFields: {
                responseType: 'blob'
            },
            success: function (response, status, xhr) {
                var blob = new Blob([response], { type: "application/vnd.openxmlformats-officedocument.wordprocessingml.document" });
                var objectUrl = URL.createObjectURL(blob);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.setAttribute('target', '_blank');
                var filename = "";
                var disposition = xhr.getResponseHeader('Content-Disposition');
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) {
                        filename = matches[1].replace(/['"]/g, '');
                    }
                }
                link.download = filename;
                link.click();
            }

        });
        complete:
    }
</script>
</body>

</html>