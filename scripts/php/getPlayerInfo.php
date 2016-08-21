<?php
function getPlayerInfo($playerID, $info)
{
    include_once "dbClass.php";
    $db   = new Db();
    $rows = $db->select("select * from accounts where id='" . $playerID . "'");
    return $rows['0'][$info];
}

function getPlayerChampionInfo($playerID, $champion, $info)
{
    include_once "dbClass.php";
    $db   = new Db();
    $rows = $db->select("select * from player_champions where playerid='" . $playerID . "' and champion='" . $champion . "'");
    return $rows['0'][$info];
}

function setPlayerIcon($playerID)
{
    include_once "dbClass.php";
    $db   = new Db();
    $rows = $db->select("select * from accounts where id='" . $playerID . "'");
    
    echo $rows['0'][$info];
}

function getPlayerRank($rank)
{
    if ($rank == 0) {
        $rank = "Unranked";
    } else if ($rank == 1) {
        $rank = "Bronze";
    } else if ($rank == 2) {
        $rank = "Silver";
    } else if ($rank == 3) {
        $rank = "Gold";
    } else if ($rank == 4) {
        $rank = "Platinum";
    } else if ($rank == 5) {
        $rank = "Diamond";
    } else if ($rank == 6) {
        $rank = "Master";
    } else if ($rank == 7) {
        $rank = "Challenger";
    }
    return $rank;
}

function getPlayerOnline($playerID)
{
    include_once "dbClass.php";
    $db   = new Db();
    $rows = $db->select("select * from accounts where id='" . $playerID . "' limit 1");
    if ($rows) {
        if ((time() - $rows['0']['time_online']) <= 420) //PLAYER ONLINE
            {
            return "<img src='images/icons/online.png' title='Online'>";
        } else if ((time() - $rows['0']['time_online']) < 600) //PLAYER AFK
            {
            return "<img src='images/icons/afk.png' title='AFK'>";
        } else
        {
          return "<img src='images/icons/offline.png' title='Offline'>";
        }
    }
    
}

function setPlayerOnline($playerID)
{
    include_once "dbClass.php";
    $db   = new Db();
    $rows = $db->query("update accounts set time_online='" . time() . "' where id='" . $playerID . "'");
  return 1;
}
?>
