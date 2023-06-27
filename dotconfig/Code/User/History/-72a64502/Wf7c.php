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
        const request = new XMLHttpRequest();
        request.onload = () => {
            console.log("funcionó");
        };
        request.open("POST", "dashboard_index.php");
        request.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
        );
        request.setRequestHeader("generarsol", "");
        request.send();
    }
</script>
</body>

</html>