<?php
session_start();

if (empty($_SESSION['member_id'])) {
    echo "<script>
        window.location.href = 'login.php'
    </script>";
} 
?>