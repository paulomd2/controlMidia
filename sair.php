<?php
@session_start();
unset($_SESSION['codigoAR']);
//header("Location: index.php");	
echo "<script>location.href = 'index.php'</script>";
?>