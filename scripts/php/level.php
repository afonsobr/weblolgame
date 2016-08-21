<?php
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db          = new Db();
/////////////////////////////////////////////
//EXP
/////////////////////////////////////////////
$playerLevel = getPlayerInfo($_SESSION['player'], "level");
$playerExp   = getPlayerInfo($_SESSION['player'], "exp");
$reqExp      = ($playerLevel + 1) * 10;
if ($reqExp <= $playerExp && $playerLevel < 30)
		{
				///////LEVEL UP
				$playerLevel = $playerLevel + 1;
				$playerExp   = $playerExp - $reqExp;
				$result      = $db->query("update accounts set level = " . $playerLevel . ", exp = " . $playerExp . " where id=" . $_SESSION['player']);
				echo "<script>buildPage()</script>";
		}
/////////////////////////////////////////////
//ENERGY
$tempoRecEnergy = 240;//300S = 5 MINUTOS
/////////////////////////////////////////////
$playerEnergy      = getPlayerInfo($_SESSION['player'], "energy");
$playerTime_Energy = getPlayerInfo($_SESSION['player'], "time_energy");
if ($playerEnergy != 100)
		{
				$difTimeEnergy = time() - $playerTime_Energy;
				if ($playerTime_Energy == 0)
						{
								$result = $db->query("update accounts set 
                time_energy = " . time() . "
                where id=" . $_SESSION['player']);
						}
				else if ($difTimeEnergy >= $tempoRecEnergy)
						{
								$x               = ($difTimeEnergy / $tempoRecEnergy);
								$x               = (int) $x;
								$i               = 1;
								$newPlayerEnergy = $playerEnergy;
								while ($i <= $x)
										{
												$newPlayerEnergy++;
												$i++;
										}
								if ($newPlayerEnergy > 100)
										{
												$newPlayerEnergy = 100;
										}
								$result = $db->query("update accounts set 
                time_energy = 0,
                energy = " . $newPlayerEnergy . "
                where id=" . $_SESSION['player']);
						}
		}
else if ($playerEnergy == 100)
		{
				$result = $db->query("update accounts set 
                time_energy = 0,
                where id=" . $_SESSION['player']);
		}
?>