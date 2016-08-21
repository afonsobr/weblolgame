<?php
include_once "dbClass.php";
$db   = new Db();
$rows = $db->select("select * from champions order by price asc");
if ($rows)
		{
				$i = 1;
				foreach ($rows as $champ)
						{
								$checkChampion = $db->select("select * from player_champions where 
          playerid='" . $_SESSION['player'] . "' and champion='" . $champ['champion'] . "'");
								if ($checkChampion)
										{
												$text = "";
												$a    = 0;
												//$text = "<img class='champImg' src='images/champions/".$champ['champion'].".png'><br>".$champ['champion']."<br>[<span style='font-size:10px; color:red'>ADQUIRIDO</span>]";
										}
								else
										{
												$a    = 1;
												$text = "<img class='champImg' src='images/champions/" . $champ['champion'] . ".png'><br>" . $champ['champion'] . "<br><img class='iprpImg' src='images/layout/IpPoints.png'> " . $champ['price'] . " IP<br>[<a href='javascript:void(0)' onclick='storeBuy(\"" . $champ['champion'] . "\")' style='font-size:10px'>COMPRAR</a>]";
										}
								if ($a == 1)
										{
												if ($i == 1)
														{
																echo "<tr><td>" . $text . "<td>";
														}
												else if ($i == 5)
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