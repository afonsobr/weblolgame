<?php
include_once "dbClass.php";
$db   = new Db();
$rows = $db->select("select * from champions order by champion asc");
if ($rows)
		{
				$i = 1;
				foreach ($rows as $champ)
						{
								$checkChampion = $db->select("select * from player_champions where 
          playerid='" . $_SESSION['player'] . "' and champion='" . $champ['champion'] . "'");
								if ($checkChampion)
										{
												$champMastery = $checkChampion['0']['maestria'];
												if ($champMastery > 10000)
														{
																// Anything less than a million
																$n_format = number_format($champMastery / 1000) . "k";
														}
												else
														{
																$n_format = number_format($champMastery);
														}
												$text = "<img class='champImg' src='images/champions/" . $champ['champion'] . ".png'><br>" . $champ['champion'] . "<br><span style='font-size:10px; color:blue'>" . $n_format . " PdM</span>";
												if ($i == 1)
														{
																echo "<tr><td>" . $text . "<td>";
														}
												else if ($i >= 5)
														{
																echo "<td>" . $text . "<td></tr>";
																$i = 0;
														}
												else
														{
																echo "<td>" . $text . "<td>";
														}
                  $i++;
										}
								
						}
		}
?>