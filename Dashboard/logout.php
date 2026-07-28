<?php
session_start();
session_abort();
session_destroy();


    echo "<script>window.location.href='../ogani/index.php'</script>";
?>