<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db                = new Db();
$type              = htmlspecialchars($_POST['gameType'], ENT_QUOTES);
$playerstatus      = getPlayerInfo($_SESSION['player'], "status");
$playerEnergy      = getPlayerInfo($_SESSION['player'], "energy");
$playerLevel       = getPlayerInfo($_SESSION['player'], "level");
$playerTime_status = getPlayerInfo($_SESSION['player'], "time_status");
$playerid          = $_SESSION['player'];
$difTime           = getPlayerInfo($_SESSION['player'], "time_status") - time();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// CONFIG:

$normalGameTime = 120;//Tempo de uma normal Game. Padrão: 300, 120

//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////
// 0 = ERRO
// 1 = SUCESSO: NORMAL GAME
// 2 = SUCESSO: FILA PRA RANKED
// 3 = 
// 4 = ENERGIA INSUFICIENTE
// 5 = SUCESSO: SAIU DA Q
//////////////////////////////////////

if ($playerstatus == 0)
		{
				if ($type == "normal")
						{
								$reqEnergy = 5;
								if ($playerEnergy >= $reqEnergy)
										{
												$time   = time() + $normalGameTime;//300
												$result = $db->query("update accounts set status='2', time_status='" . $time . "' where id = '" . $playerid . "'");
												echo json_encode("1");
										}
								else
										{
												echo json_encode("4");
										}
						}
				else if ($type == "ranked" && $playerLevel == 30)
						{
								$reqEnergy = 10;
								if ($playerEnergy >= $reqEnergy)
										{
												$result = $db->query("update accounts set status='1', time_status='" . time() . "' where id = '" . $playerid . "'");
												echo json_encode("2");
										}
								else
										{
												echo json_encode("4");
										}
						}
				else if ($type == "afk")
						{
								$reqEnergy = 0;
								if ($playerEnergy >= $reqEnergy)
										{
												$time   = time() + 5;
												$result = $db->query("update accounts set status='4', time_status='" . $time . "' where id = '" . $playerid . "'");
												echo json_encode("1");
										}
								else
										{
												echo json_encode("4");
										}
						}
				else
						{
								echo json_encode("0");
						}
		}
else
		{
				if (($type == "closeQ") and ($difTime <= 0))
						{
								$result = $db->query("update accounts set status='0', time_status='0' where id = '" . $playerid . "'");
          echo json_encode("5");
          
						}
				else
						{
								echo json_encode("3");
						}
		}
?>