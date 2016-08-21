<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db           = new Db();
$playerID     = $_SESSION['player'];
$playerStatus = getPlayerInfo($_SESSION['player'], "status");
$playerMoney  = getPlayerInfo($_SESSION['player'], "money");
$playerEnergy = getPlayerInfo($_SESSION['player'], "energy");
$tipo         = htmlspecialchars($_POST['tipo'], ENT_QUOTES);

$gasto = array(
    1 => 25,
    2 => 50,
    3 => 100
);

$ganho = array(
    1 => 2,
    2 => 6,
    3 => 20
);

if ($playerEnergy < $gasto[$tipo] || $playerStatus != 0)
  {
    $result = 0; //ENERGIA INSUFICIENTE OU EM PARTIDA
  }
else
  {
    $newEnergy = $playerEnergy - $gasto[$tipo];
    $newMoney  = $playerMoney + $ganho[$tipo];
    $result    = $db->query("update accounts set money='" . $newMoney . "', energy='" . $newEnergy . "' where id='" . $playerID . "'");
    $result    = 1; //TRABALHOU
  }


echo json_encode($result);


?>
