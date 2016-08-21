<?php
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db   = new Db();
$rows = $db->select("select * from champions order by champion asc");
if ($rows)
		{
				foreach ($rows as $champ)
						{
								$checkChampion = $db->select("select * from player_champions where 
          playerid='" . $_SESSION['player'] . "' and champion='" . $champ['champion'] . "'");
								if ($checkChampion)
										{
                  $playerMainChampion = getPlayerInfo($_SESSION['player'], "mainChamp");
												if ($playerMainChampion == $champ['champion'])
														{
																echo "<option value='" . $champ['champion'] . "' selected>" . $champ['champion'] . "</option>";
														}
												else
														{
																echo "<option value='" . $champ['champion'] . "'>" . $champ['champion'] . "</option>";
														}
										}
						}
		}
?>