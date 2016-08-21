<?php
		include "dbClass.php";
		$db       = new Db();
		$name     = htmlspecialchars($_POST['username'], ENT_QUOTES);
		$password = md5($_POST['password']);
		$rows     = $db->select("select * from accounts where username='" . $name . "' and password='" . $password . "'");
		if ($rows)
			{
				session_start();
      $_SESSION['chat'] = true;
				$_SESSION['player'] = $rows['0']['id'];
				$rows = $db->select("select * from player_champions where playerid='" . $_SESSION['player'] . "'");
				if (!$rows)
					{
						$result = $db->query("insert into player_champions (champion, playerid) values ('Annie', '" . $_SESSION['player'] . "')");
						$result = $db->query("insert into player_champions (champion, playerid) values ('Ashe', '" . $_SESSION['player'] . "')");
						$result = $db->query("insert into player_champions (champion, playerid) values ('Garen', '" . $_SESSION['player'] . "')");
						$result = $db->query("insert into player_champions (champion, playerid) values ('Master Yi', '" . $_SESSION['player'] . "')");
						$result = $db->query("insert into player_champions (champion, playerid) values ('Soraka', '" . $_SESSION['player'] . "')");
						$db->close();
					}
      echo json_encode("1");
			}
		else
			{
				echo json_encode("0");
			}
?>
