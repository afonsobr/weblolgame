<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db       = new Db();
$playerid = $_SESSION['player'];
$bet      = $_POST['bet'];

$possible = array(
    1 => "Big Gods",
    2 => "CNB",
    3 => "INTZ",
    4 => "KaBuM",
    5 => "Keyd Stars",
    6 => "Operation Kino",
    7 => "paiN Gaming",
    8 => "RED Cannabis"
);
if (getPlayerInfo($playerid, 'ip') < 50)
{
  $result = "Affs... Você nem IP suficiente tem!";
}
else if (rand(1, 10) <= 3) //GANHOU
  {
    $ip        = getPlayerInfo($_SESSION['player'], "ip");
    $ip        = $ip + 200;
    $result    = $db->query("update accounts set ip='" . $ip . "' where id='" . $_SESSION['player'] . "'");
    $result = "WORTH! " . $possible[$bet]. " ganhou o CBLoiro, e você ganhou 150 IP!";
  }
else //PERDEU
  {
    $winner = $bet;
    while ($winner == $bet)
      {
        $winner = rand(1, 8);
        $ip     = getPlayerInfo($_SESSION['player'], "ip");
        $ip     = $ip - 50;
        $result = $db->query("update accounts set ip='" . $ip . "' where id='" . $_SESSION['player'] . "'");
      }
    $result = ">_< Não foi dessa vez! " . $possible[$winner]. " foi quem ganhou o CBLoiro,<br>e você perdeu 50 IP!";
  }

echo json_encode($result);


?>
