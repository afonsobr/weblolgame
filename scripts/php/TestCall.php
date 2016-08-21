<?php
include 'DbClass.php';
$db = new Db();
$rows = $db -> select("select * from accounts");
echo json_encode($rows);
echo json_encode($rows['0']['id']);
echo "<br>";
?>