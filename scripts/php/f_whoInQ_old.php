<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db = new Db();

$rows = $db->select("select * from accounts where status = 1 order by rank desc");

if ($rows)
  {
    $result = "Os seguintes jogadores estão na Fila:";
  $count = 1;
    foreach ($rows as $player)
      {
      if ($count < 10)
      {
        $count = "00".$count;
      }
      else if ($count < 100)
      {
        $count = "0".$count;
      }
        $rank = $player["rank"];
        if ($rank == 0)
          {
            $rank = "Unranked";
          }
        else if ($rank == 1)
          {
            $rank = "Bronze";
          }
        else if ($rank == 2)
          {
            $rank = "Silver";
          }
        else if ($rank == 3)
          {
            $rank = "Gold";
          }
        else if ($rank == 4)
          {
            $rank = "Platinum";
          }
        else if ($rank == 5)
          {
            $rank = "Diamond";
          }
        else if ($rank == 6)
          {
            $rank = "Master";
          }
        else if ($rank == 7)
          {
            $rank = "Challenger";
          }
        $result = $result . "\n".$count. " - " . $player['username'] . " como " . $player['mainLane'] . " [" . $rank . "]";
      $count++;
      }
  }
else
  {
    $result = "Não tem ninguém na fila.";
  }

echo json_encode($result);

?>
