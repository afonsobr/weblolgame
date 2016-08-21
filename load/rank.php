<?php
session_start();
include_once("../scripts/php/getPlayerInfo.php");
include_once("../scripts/php/dbClass.php");
$db       = new Db();
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
               0 20px 20px rgba(0,0,0,.15);">Rank <small></small></h1>
  </div>
  <?php 
    
    ?>
<dt>Top 50 Jogadores</dt>
  <div class="panel panel-default" style="height:300px; overflow: auto;">
    <div class="panel-body">
      <table style="width:100%;" class="table table-striped">
        <tr>
          <th>Rank</th>
          <th>Jogador</th>
          <th>Level</th>
          <th>EXP</th>
          <th>Tier</th>
          <th>PdL</th>
        </tr>
        <?php
  
  $rows = $db->select("select * from accounts order by rank desc, pdl desc, level desc, exp desc limit 50");
          $i = 1;
  foreach ($rows as $info)
  {
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
    <td>#".$i."</td>
    <td>".getPlayerOnline($info['id']).$info['username']."</td>
    <td>Lv. ".$info['level']."</td>
    <td>".number_format($info['exp'])."</td>
    <td><img class='champImg' src='images/ranks/".$rank."Badge.png'></td>
    <td>".$info['pdl']."</td>
    </tr>";
    $i++;
  }
  ?>
      </table>
    </div>
  </div>
<hr>
  <!------------------------------------------------------------------------------------------------------------------->
  Selecione o Campeão:
  <select onclick="rankChamp()" onchange="rankChamp()" id="rankChampShow">
                        <?php
include_once("../scripts/php/rank_championList.php");
?>
                      </select>
  <script>
    rankChamp();

  </script>
  <div class="panel panel-default" style="height:300px; overflow: auto;">
    <div class="panel-body">
      <table style="width:100%; text-align:center" class="table table-striped" id="championRankLoad">
      </table>
    </div>
  </div>
  <!------------------------------------------------------------------------------------------------------------------->
  <div class="page-header">
    <h2>Top 3 Geral<br> <small>Confira os 3 maiores jogadores do WebLoL! NHAAAA</small></h2>
  </div>
  <div class="row">
    <?php
      
      $rows = $db->select("select * from accounts order by rank desc, pdl desc, level desc, exp desc limit 3");
          $i = 1;
  foreach ($rows as $info)
  {
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
    
    
    if ($i<4)
    {
      ?>
      <div class="col-md-4">
        <div class="thumbnail">
          <img alt="" src="
                           <?php
      echo 'images/ranks/'.$rank.'Badge.png';
                           ?>" />
          <div class="caption">
            <h3 style="text-align:center"><?php echo "<img src='images/icons/newtop".$i.".png'><br>".$info['username']; ?></h3>
            <p>
              <?php echo "Top #".$i.", com ".$info['pdl']."PdL." ?>
            </p>
            <p>
              <a class="btn btn-primary" href="#">--</a> <a class="btn" href="#">--</a>
            </p>
          </div>
        </div>
      </div>
      <?php
    }
    $i++;
  }
  
    $topMastery = $db->select("select * from player_champions order by maestria desc limit 1");
  foreach ($topMastery as $info)
  {
    $champion = $info['champion'];
    $nick = getPlayerInfo($info['playerid'], "username");
    
    if ($info['maestria'] < 100)
      {
        $masteryImg = "";
      }
    else if ($info['maestria'] < 200)
      {
        $masteryImg = "<img src='images/mastery/m1.png' />";
      }
    else if ($info['maestria'] < 400)
      {
        $masteryImg = "<img src='images/mastery/m2.png' />";
      }
    else if ($info['maestria'] < 800)
      {
       $masteryImg = "<img src='images/mastery/m3.png' />";
      }
    else if ($info['maestria'] < 1600)
      {
       $masteryImg = "<img src='images/mastery/m4.png' />";
      }
    else if ($info['maestria'] < 3200)
      {
       $masteryImg = "<img src='images/mastery/m5.png' />";
      }
    else if ($info['maestria'] < 6400)
      {
        $masteryImg = "<img src='images/mastery/m6.png' />";
      }
    else
      {
        $masteryImg = "<img src='images/mastery/m7.png' />";
      }
    
    echo '</div>
    <div class="page-header">
    <h2>Top Maestria<br></h2>
  </div>
    <div class="col-md-12">
        <div class="thumbnail">
          <img alt="" src="images/champions/'.$champion.'.png" />
          <div class="caption" style="text-align:center">
          <p>
              '.$masteryImg.'
            </p>
            <p>Top #1, '.$info['champion'].' do '.$nick.', com '.$info['maestria'].' PdM.
            </p>
          </div>
        </div>
      </div>
    ';
  }
  ?>

  
