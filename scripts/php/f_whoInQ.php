<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db = new Db();

$result = "Os seguintes jogadores estão na Fila:";

$selectRank = 0;
$count      = 1;
while ($selectRank < 8)
  {
    //TOP
    $lane = 'Top';
    $rows = $db->select("select * from accounts where (status = 1 or status = 0) and rank = '" . $selectRank . "' and mainLane='" . $lane . "' and level = 30 order by rand() desc limit 2");
    if ($rows)
      {
        foreach ($rows as $player)
          {
            if ($count < 10)
              {
                $count = "00" . $count;
              }
            else if ($count < 100)
              {
                $count = "0" . $count;
              }
            $result = $result . "\n" . $count . " - " . $player['username'] . " como " . $player['mainLane'] . " [" . getPlayerRank($selectRank) . "]";
            $count++;
          }
      }
    //JG
    $lane = 'Jungle';
    $rows = $db->select("select * from accounts where (status = 1 or status = 0) and rank = '" . $selectRank . "' and mainLane='" . $lane . "' and level = 30 order by rand() desc limit 2");
    if ($rows)
      {
        foreach ($rows as $player)
          {
            if ($count < 10)
              {
                $count = "00" . $count;
              }
            else if ($count < 100)
              {
                $count = "0" . $count;
              }
            $result = $result . "\n" . $count . " - " . $player['username'] . " como " . $player['mainLane'] . " [" . getPlayerRank($selectRank) . "]";
            $count++;
          }
      }
    //mid
    $lane = 'Mid';
    $rows = $db->select("select * from accounts where (status = 1 or status = 0) and rank = '" . $selectRank . "' and mainLane='" . $lane . "' and level = 30 order by rand() desc limit 2");
    if ($rows)
      {
        foreach ($rows as $player)
          {
            if ($count < 10)
              {
                $count = "00" . $count;
              }
            else if ($count < 100)
              {
                $count = "0" . $count;
              }
            $result = $result . "\n" . $count . " - " . $player['username'] . " como " . $player['mainLane'] . " [" . getPlayerRank($selectRank) . "]";
            $count++;
          }
      }
    //Sup
    $lane = 'Sup';
    $rows = $db->select("select * from accounts where (status = 1 or status = 0) and rank = '" . $selectRank . "' and mainLane='" . $lane . "' and level = 30 order by rand() desc limit 2");
    if ($rows)
      {
        foreach ($rows as $player)
          {
            if ($count < 10)
              {
                $count = "00" . $count;
              }
            else if ($count < 100)
              {
                $count = "0" . $count;
              }
            $result = $result . "\n" . $count . " - " . $player['username'] . " como " . $player['mainLane'] . " [" . getPlayerRank($selectRank) . "]";
            $count++;
          }
      }
    //adc
    $lane = 'ADC';
    $rows = $db->select("select * from accounts where (status = 1 or status = 0) and rank = '" . $selectRank . "' and mainLane='" . $lane . "' and level = 30 order by rand() desc limit 2");
    if ($rows)
      {
        foreach ($rows as $player)
          {
            if ($count < 10)
              {
                $count = "00" . $count;
              }
            else if ($count < 100)
              {
                $count = "0" . $count;
              }
            $result = $result . "\n" . $count . " - " . $player['username'] . " como " . $player['mainLane'] . " [" . getPlayerRank($selectRank) . "]";
            $count++;
          }
      }
    $selectRank++;
  }

echo json_encode($result);

?>
