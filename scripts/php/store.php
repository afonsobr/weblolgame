<?php
session_start();
include_once "dbClass.php";

include_once "getPlayerInfo.php";

$db                   = new Db();
$product              = htmlspecialchars($_POST['product'], ENT_QUOTES);
$playerIp             = getPlayerInfo($_SESSION['player'], "ip");
$playerLevel          = getPlayerInfo($_SESSION['player'], "level");
$playerRp             = getPlayerInfo($_SESSION['player'], "rp");
$playerExp            = getPlayerInfo($_SESSION['player'], "exp");
$playerid             = $_SESSION['player'];
$playerAvailableIcons = getPlayerInfo($_SESSION['player'], "availableIcons");

$playerAvailableIcons = str_split($playerAvailableIcons, 14);
sort($playerAvailableIcons);


$splitProduct = explode("_", $product);

if ($splitProduct[0] == 'icon') //É ICONE
  {
    if ($splitProduct[1] == 'ProfileIcon011' || $splitProduct[1] == 'ProfileIcon012' || $splitProduct[1] == 'ProfileIcon013' || $splitProduct[1] == 'ProfileIcon014' || $splitProduct[1] == 'ProfileIcon015' || $splitProduct[1] == 'ProfileIcon016' || $splitProduct[1] == 'ProfileIcon017' || $splitProduct[1] == 'ProfileIcon018' || $splitProduct[1] == 'ProfileIcon019' || $splitProduct[1] == 'ProfileIcon020' || $splitProduct[1] == 'ProfileIcon021' || $splitProduct[1] == 'ProfileIcon022' || $splitProduct[1] == 'ProfileIcon023' || $splitProduct[1] == 'ProfileIcon024' || $splitProduct[1] == 'ProfileIcon025' || $splitProduct[1] == 'ProfileIcon026' || $splitProduct[1] == 'ProfileIcon027' || $splitProduct[1] == 'ProfileIcon028' || $splitProduct[1] == 'ProfileIcon029')
      {
        $price = 500;
        if ($playerIp >= $price)
          {
            $repeat = false;
            foreach ($playerAvailableIcons as $icon)
              {
                if ($icon == $splitProduct[1])
                  {
                    $repeat = true;
                    echo json_encode("3"); //VOCÊ JÁ COMPROU ISSO
                  }
              }
            if ($repeat == false)
              {
                $newPlayerIp = $playerIp - $price;
                $result      = $db->query("update accounts set 
                energy = 100,
                ip = '" . $newPlayerIp . "',
                availableIcons = '" . implode($playerAvailableIcons). $splitProduct[1] . "'
                where id = '" . $playerid . "'");
                echo json_encode("1"); //COMPROU
              }
          }
        else
          {
            echo json_encode("2"); //IP INSUFICIENTE
          }
      }
  }
else if ($product == "energyPack")
  {
    $price = 1500;
    if ($playerIp >= $price)
      {
        $newPlayerIp = $playerIp - $price;
        $result      = $db->query("update accounts set 
                energy = 100,
                ip = '" . $newPlayerIp . "'
                where id = '" . $playerid . "'");
        echo json_encode("1"); //COMPROU
      }
    else
      {
        echo json_encode("2"); //IP INSUFICIENTE
      }
  }
else if ($product == "expBooster")
  {
    $price = 1000;
    if ($playerIp >= $price)
      {
        $newPlayerIp      = $playerIp - $price;
        $playerExpBooster = getPlayerInfo($_SESSION['player'], "expBooster");
        $playerExpBooster = $playerExpBooster + 5;
        $result           = $db->query("update accounts set 
                expBooster = '" . $playerExpBooster . "',
                ip = '" . $newPlayerIp . "'
                where id = '" . $playerid . "'");
        echo json_encode("1"); //COMPROU
      }
    else
      {
        echo json_encode("2"); //IP INSUFICIENTE
      }
  }
else if ($product == "ipBooster")
  {
    $price = 5;
    if ($playerRp >= $price)
      {
        $newPlayerRp      = $playerRp - $price;
        $playerIPBooster = getPlayerInfo($_SESSION['player'], "ipBooster");
        $playerIPBooster = $playerIPBooster + 5;
        $result           = $db->query("update accounts set 
                ipBooster = '" . $playerIPBooster . "',
                rp = '" . $newPlayerRp . "'
                where id = '" . $playerid . "'");
        echo json_encode("1"); //COMPROU
      }
    else
      {
        echo json_encode("2"); //IP INSUFICIENTE
      }
  }
else if ($product == "eloBooster")
  {
    $price = 10;
    if ($playerRp >= $price)
      {
        $newPlayerRp      = $playerRp - $price;
        $playerEloBooster = getPlayerInfo($_SESSION['player'], "eloBooster");
        $playerEloBooster = $playerEloBooster + 2;
        $result           = $db->query("update accounts set 
                eloBooster = '" . $playerEloBooster . "',
                rp = '" . $newPlayerRp . "'
                where id = '" . $playerid . "'");
        echo json_encode("1"); //COMPROU
      }
    else
      {
        echo json_encode("2"); //IP INSUFICIENTE
      }
  }
else if ($product == "level30")
  {
    $price = 1;
    if ($playerRp >= $price)
      {
        $newPlayerRp = $playerRp - $price;
        $result      = $db->query("update accounts set 
                level = '30',
                rp = '" . $newPlayerRp . "'
                where id = '" . $playerid . "'");
        echo json_encode("1"); //COMPROU
      }
    else
      {
        echo json_encode("2"); //IP INSUFICIENTE
      }
  }
else if ($product == "reset")
  {
    $price = 0;
    if ($playerLevel >= 30)
      {
        $newPlayerIp = $playerIp + 1500;
        $result      = $db->query("update accounts set 
                level = '1',
                ip = '" . $newPlayerIp . "'
                where id = '" . $playerid . "'");
        echo json_encode("1"); //COMPROU
      }
    else
      {
        echo json_encode("2"); //IP INSUFICIENTE
      }
  }
else if ($product == "allchamps")
  {
    $price = 5;
    if ($playerRp >= $price)
      {
        $championdb = $db->select("select * from champions");
        if ($championdb)
          {
            foreach ($championdb as $champ)
              {
                $rows = $db->select("select * from player_champions where champion='" . $champ['champion'] . "' and playerid='" . $_SESSION['player'] . "'");
                if (!$rows)
                  {
                    $result = $db->query("insert into player_champions (champion, playerid) 
                        values ('" . $champ['champion'] . "', '" . $_SESSION['player'] . "')");
                  }
              }
          }
        $newPlayerRp = $playerRp - $price;
        $result      = $db->query("update accounts set 
                exp = '" . $playerExp . "',
                rp = '" . $newPlayerRp . "'
                where id = '" . $playerid . "'");
        echo json_encode("1"); //COMPROU
      }
    else
      {
        echo json_encode("2"); //IP INSUFICIENTE
      }
  }
else if ($product == "coach")
  {
    $price = 1;
    if ($playerRp >= $price)
      {
        $newPlayerRp = $playerRp - $price;
        $playerExp   = $playerExp + 4640;
        $result      = $db->query("update accounts set 
                exp = '" . $playerExp . "',
                rp = '" . $newPlayerRp . "'
                where id = '" . $playerid . "'");
        echo json_encode("1"); //COMPROU
      }
    else
      {
        echo json_encode("2"); //IP INSUFICIENTE
      }
  }
else
  {
    $rows = $db->select("select * from champions where champion='" . $product . "'");
    if ($rows)
      {
        $price = $rows['0']['price'];
        $rows  = $db->select("select * from player_champions where champion='" . $product . "' and playerid='" . $_SESSION['player'] . "'");
        if (!$rows)
          {
            if ($playerIp >= $price)
              {
                $newPlayerIp = $playerIp - $price;
                $result      = $db->query("update accounts set 
                ip = '" . $newPlayerIp . "'
                where id = '" . $playerid . "'");
                $result      = $db->query("insert into player_champions (champion, playerid) 
                        values ('" . $product . "', '" . $_SESSION['player'] . "')");
                echo json_encode("1"); //COMPROU
              }
            else
              {
                echo json_encode("2"); //IP INSUFICIENTE
              }
          }
      }
  }
?>
