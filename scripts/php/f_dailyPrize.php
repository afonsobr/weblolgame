<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db             = new Db();
$playerid       = $_SESSION['player'];
$dailyprize     = getPlayerInfo($_SESSION['player'], "dailyprize");
$lastDailyPrize = time() - $dailyprize;
if ($lastDailyPrize >= 79200) //22 horas
  {
    if (rand(1, 100) == 1)
      {
        $rp     = getPlayerInfo($_SESSION['player'], "rp");
        $rp     = $rp + 1;
        $result = $db->query("update accounts set rp='" . $rp . "' where id='" . $_SESSION['player'] . "'");
        echo json_encode("Você ganhou <img class='iprpImg' src='images/layout/RpPoints.png'> 1 RP!");
      }
    else
      {
        $ip     = getPlayerInfo($_SESSION['player'], "ip");
        $ip     = $ip + 150;
        $result = $db->query("update accounts set ip='" . $ip . "' where id='" . $_SESSION['player'] . "'");
        echo json_encode("Você ganhou <img class='iprpImg' src='images/layout/IpPoints.png'> 150 IP!");
      }
    $result = $db->query("update accounts set dailyprize='" . time() . "' where id='" . $_SESSION['player'] . "'");
  }
else
  {
    echo json_encode("Você já pegou seu prêmio diário hoje!") ;
  }

?>
