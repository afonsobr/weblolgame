<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db                = new Db();
$icon              = htmlspecialchars($_POST['icon'], ENT_QUOTES);//htmlspecialchars($_POST['icon'], ENT_QUOTES)
$playerid          = $_SESSION['player'];

$rows = $db->select("select * from accounts where id = '" . $playerid . "'");
if ($rows) {
    $availableIcons = $rows['0']['availableIcons'];
    $arr2           = str_split($availableIcons, 14);
    foreach ($arr2 as $available_icon) {
      if ($icon == $available_icon)//VERIFICO SE O CARA TEM O ICONE
      {
        $result = $db->query("update accounts set icon = '".$icon."' where id = '" . $playerid . "'");
        echo json_encode(1);
      }
    }
}

?>