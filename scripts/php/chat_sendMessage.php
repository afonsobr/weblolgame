<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db       = new Db();
$playerid = $_SESSION['player'];
$message  = htmlspecialchars($_POST['message'], ENT_QUOTES);
if (getPlayerInfo($playerid, 'level') == 30)
  {
    if ($message != '')
      {
        $send = $db->query("insert into chat (username, message)
  values ('" . getPlayerInfo($playerid, 'username') . "', '" . $message . "')");
        echo json_encode(1);
      }
    else
      {
        echo json_encode(1);
      }
  }
else
  {
    echo json_encode(0);
  }
?>
