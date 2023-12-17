<?php
header('Location: ./admin.php');
session_start();
session_destroy();
exit();
?>