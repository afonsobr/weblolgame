<?php
session_start();
unset($_SESSION['player']);
session_destroy();
echo json_encode("1");
?>