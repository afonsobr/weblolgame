<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db          = new Db();
$info        = htmlspecialchars($_POST['tipo'], ENT_QUOTES);
$newPassword = htmlspecialchars($_POST['senha'], ENT_QUOTES);
$newPassword = md5($newPassword);
$newEmail    = htmlspecialchars($_POST['email'], ENT_QUOTES);
$playerid    = $_SESSION['player'];
$rows        = $db->select("select * from accounts where id='" . $playerid . "'");
if ($rows)
  {
    if ($info == 1) //EMAIL
      {
        $att = $db->query("update accounts set email='" . $newEmail . "' where id='" . $playerid . "'");
      }
    else if ($info == 2) //SENHA
      {
        $att = $db->query("update accounts set password='" . $newPassword . "' where id='" . $playerid . "'");
      }
    echo json_encode("1");
  }
else
  {
    echo json_encode("0");
  }
?>
