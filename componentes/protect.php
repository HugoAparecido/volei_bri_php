<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id_usuario'])) {
?><script>
        window.location.href = "./login.php"
    </script><?php
            }
