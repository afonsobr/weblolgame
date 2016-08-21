<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db           = new Db();
$playerstatus = getPlayerInfo($_SESSION['player'], "status");
$playerid     = $_SESSION['player'];
$difTime      = getPlayerInfo($_SESSION['player'], "time_status") - time();
if ($playerstatus == 1) //AINDA NA FILA
  {
    echo json_encode(1);
  }
else if ($playerstatus == 3) //TA NA RANKED
  {
    echo json_encode(0);
  }
else //UEH MANO
  {
    echo json_encode(2);
  }
?>