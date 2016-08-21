<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";

$db           = new Db();
$champ        = $_POST['mainChamp'];
$lane         = $_POST['mainLane'];
$playerid     = $_SESSION['player'];
$playerstatus = getPlayerInfo($_SESSION['player'], "status");
$playerLevel  = getPlayerInfo($_SESSION['player'], "level");
$playerid     = $_SESSION['player'];

if ($playerstatus == 0)
		{
				$rows = $db->select("select * from accounts where id='" . $playerid . "'");
				if (!$rows)
						{
								echo json_encode("0");
						}
				else
						{
								$result = $db->query("update accounts set mainLane='" . $lane . "', mainChamp='" . $champ . "' where id = '" . $playerid . "'");
								echo json_encode("1");
						}
				
		}
else
{
  echo json_encode("3");
}
?>
