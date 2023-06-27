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
            success: function (response) {
                var blob = new Blob([response], { type: "application/vnd.openxmlformats-officedocument.wordprocessingml.document" });
                var objectUrl = URL.createObjectURL(blob);
            }

        });
    }
</script>
</body>

</html>