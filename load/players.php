<?php
session_start();
include_once("../scripts/php/getPlayerInfo.php");
include_once("../scripts/php/dbClass.php");
$db             = new Db();
$status         = getPlayerInfo($_SESSION['player'], "status");
$playerMainLane = getPlayerInfo($_SESSION['player'], "mainLane");
?>
  <div class="page-header">
    <h1 style="text-shadow: 0 1px 0 #ccc,
               0 2px 0 #c9c9c9,
               0 3px 0 #bbb,
               0 4px 0 #b9b9b9,
               0 5px 0 #aaa,
               0 6px 1px rgba(0,0,0,.1),
               0 0 5px rgba(0,0,0,.1),
               0 1px 3px rgba(0,0,0,.3),
               0 3px 5px rgba(0,0,0,.2),
               0 5px 10px rgba(0,0,0,.25),
               0 10px 10px rgba(0,0,0,.2),
               0 20px 20px rgba(0,0,0,.15);">Jogadores <small>Vamos ver as estatísticas!</small></h1>
  </div>
  <?php

?>
    <div class="panel panel-default" style="height:350px; overflow: auto;">
      <div class="panel-body">
        <table style="width:100%;" class="table table-striped">
          <tr>
            <th>Número</th>
            <th>Jogador</th>
            <th>Level</th>
            <th>Status</th>
          </tr>
          <?php

$rows                = $db->select("select * from accounts order by time_online desc");
$i                   = 1;
$statistic['n']      = $i;
$statistic['online'] = $i;
$statistic['lvl30']  = $i;
foreach ($rows as $info)
  {
    if ($info['status'] == 1)
      {
        $actualStatus = "<span style='color:blue'>Na fila";
      }
    else if ($info['status'] == 2)
      {
        $actualStatus = "<span style='color:red'>Em Normal";
      }
    else if ($info['status'] == 3)
      {
        $actualStatus = "<span style='color:red'>Em Ranqueada";
      }
    else
      {
        $actualStatus = "<span style='color:green'>Livre";
      }
    $actualStatus = $actualStatus ."</span>";
    if ($info['rank'] == 0)
      {
        $rank = "Unranked";
      }
    else if ($info['rank'] == 1)
      {
        $rank = "Bronze";
      }
    else if ($info['rank'] == 2)
      {
        $rank = "Silver";
      }
    else if ($info['rank'] == 3)
      {
        $rank = "Gold";
      }
    else if ($info['rank'] == 4)
      {
        $rank = "Platinum";
      }
    else if ($info['rank'] == 5)
      {
        $rank = "Diamond";
      }
    else if ($info['rank'] == 6)
      {
        $rank = "Master";
      }
    else if ($info['rank'] == 7)
      {
        $rank = "Challenger";
      }
    echo "<tr>
    <td>#" . $i . "</td>
    <td>" . getPlayerOnline($info['id']) . $info['username'] . "</td>
    <td>Lv. " . $info['level'] . "</td>
    <td>" . $actualStatus . "</td>
    </tr>";
    if ($info['level'] == 30)
      {
        $statistic['lvl30']++;
      }
    if ((time() - $info['time_online']) <= 420)
      {
        $statistic['online']++;
      }
    
    $i++;
    $statistic['n']++;
  }
?>
        </table>
      </div>
    </div>

    <div class="panel panel-default" style="overflow: auto;">
      <div class="panel-body">
        <table style="width:100%; text-align:center" class="table table-striped">
          <p>Temos
            <?php
echo $statistic['n'] - 1;
?> jogadores cadastrados.</p>
          <p>Temos
            <?php
echo $statistic['lvl30'] - 1;
?> jogadores no Nível 30.</p>
          <p>Temos
            <?php
echo $statistic['online'] - 1;
?> jogadores <span style="color:green">ONLINE</span>.</p>
        </table>
      </div>
    </div>
    <!------------------------------------------------------------------------------------------------------------------->
