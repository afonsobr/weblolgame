<?php
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db   = new Db();
$rows = $db->select("select * from champions order by champion asc");
if ($rows)
		{
				foreach ($rows as $champ)
						{
								echo "<option value='" . $champ['champion'] . "'>" . $champ['champion'] . "</option>";
						}
		}
?>