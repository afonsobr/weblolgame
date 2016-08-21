<?php
include_once "dbClass.php";
$db   = new Db();
$rows = $db->select("select * from accounts where id = '" . $_SESSION['player'] . "'");
if ($rows) {
    $availableIcons = $rows['0']['availableIcons'];
    $arr2           = str_split($availableIcons, 14);
    $i              = 1;
    foreach ($arr2 as $icon) {
        
        $text = "<img style='width:100px' src='images/icons/" . $icon . ".jpg' onclick='setProfileIcon(\"".$icon."\")'>";
        if ($i == 1) {
            echo "<tr><td>" . $text . "<td>";
        } else if ($i >= 3) {
            echo "<td>" . $text . "<td></tr>";
            $i = 0;
        } else {
            echo "<td>" . $text . "<td>";
        }
        $i++;
        
    }
}
?>