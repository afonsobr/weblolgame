<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db                = new Db();
$playerstatus      = getPlayerInfo($_SESSION['player'], "status");
$playerRank        = getPlayerInfo($_SESSION['player'], "rank");
$playerEnergy      = getPlayerInfo($_SESSION['player'], "energy");
$playerLevel       = getPlayerInfo($_SESSION['player'], "level");
$playerLane        = getPlayerInfo($_SESSION['player'], "mainLane");
$playerChamp       = getPlayerInfo($_SESSION['player'], "mainChamp");
$playerTime_status = getPlayerInfo($_SESSION['player'], "time_status");
$playerid          = $_SESSION['player'];
$difTime           = getPlayerInfo($_SESSION['player'], "time_status") - time();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// CONFIG:

$rankedGameTime = 300; //Tempo de uma normal Game. Padrão: 600

//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////
// 0 = ERRO
// 1 = SUCESSO: NORMAL GAME
// 2 = SUCESSO: FILA PRA RANKED
// 3 = 
// 4 = ENERGIA INSUFICIENTE
// 5 = SUCESSO: SAIU DA Q
//////////////////////////////////////

function ama($k, $d, $a)
  {
    if ($d == 0)
      {
        $d = 1;
      }
    $ama = number_format(($k + $a) / $d, 1);
    return $ama;
  }

if ($playerLevel == 30 && $playerstatus == 1)
  {
    //echo "na fila<br>";
    $time = time() + $rankedGameTime; //
    if ($playerRank <= 7)
      {
        if ($playerLane == "Mid")
          {
            $i       = 0;
            $player1 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Top' order by rand() limit 2");
            if ($player1)
              {
                foreach ($player1 as $count)
                  {
                    $i++;
                    //echo "Top: " . $count['username'] . "<br>";
                  }
              }
            $player2 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Jungle' order by rand() limit 2");
            if ($player2)
              {
                foreach ($player2 as $count)
                  {
                    $i++;
                    //echo "Jungle: " . $count['username'] . "<br>";
                  }
              }
            $player3 = $db->select("(select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Mid' order by rand() limit 1)
                union (select * from accounts where id = '" . $playerid . "')");
            if ($player3)
              {
                foreach ($player3 as $count)
                  {
                    $i++;
                    //echo "Mid: " . $count['username'] . "<br>";
                  }
              }
            $player4 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Sup' order by rand() limit 2");
            if ($player4)
              {
                foreach ($player4 as $count)
                  {
                    $i++;
                    //echo "Sup: " . $count['username'] . "<br>";
                  }
              }
            $player5 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='ADC' order by rand() limit 2");
            if ($player5)
              {
                foreach ($player5 as $count)
                  {
                    $i++;
                    //echo "ADC: " . $count['username'] . "<br>";
                  }
              }
          }
        else if ($playerLane == "ADC")
          {
            $i       = 0;
            $player1 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Top' order by rand() limit 2");
            if ($player1)
              {
                foreach ($player1 as $count)
                  {
                    $i++;
                    //echo "Top: " . $count['username'] . "<br>";
                  }
              }
            $player2 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Jungle' order by rand() limit 2");
            if ($player2)
              {
                foreach ($player2 as $count)
                  {
                    $i++;
                    //echo "Jungle: " . $count['username'] . "<br>";
                  }
              }
            $player3 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Mid' order by rand() limit 2");
            if ($player3)
              {
                foreach ($player3 as $count)
                  {
                    $i++;
                    //echo "Mid: " . $count['username'] . "<br>";
                  }
              }
            $player4 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Sup' order by rand() limit 2");
            if ($player4)
              {
                foreach ($player4 as $count)
                  {
                    $i++;
                    //echo "Sup: " . $count['username'] . "<br>";
                  }
              }
            $player5 = $db->select("(select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='ADC' order by rand() limit 1)
                union (select * from accounts where id = '" . $playerid . "')");
            if ($player5)
              {
                foreach ($player5 as $count)
                  {
                    $i++;
                    //echo "ADC: " . $count['username'] . "<br>";
                  }
              }
          }
        else if ($playerLane == "Sup")
          {
            $i       = 0;
            $player1 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Top' order by rand() limit 2");
            if ($player1)
              {
                foreach ($player1 as $count)
                  {
                    $i++;
                    //echo "Top: " . $count['username'] . "<br>";
                  }
              }
            $player2 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Jungle' order by rand() limit 2");
            if ($player2)
              {
                foreach ($player2 as $count)
                  {
                    $i++;
                    //echo "Jungle: " . $count['username'] . "<br>";
                  }
              }
            $player3 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Mid' order by rand() limit 2");
            if ($player3)
              {
                foreach ($player3 as $count)
                  {
                    $i++;
                    //echo "Mid: " . $count['username'] . "<br>";
                  }
              }
            $player4 = $db->select("(select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Sup' order by rand() limit 1)
                union (select * from accounts where id = '" . $playerid . "')");
            if ($player4)
              {
                foreach ($player4 as $count)
                  {
                    $i++;
                    //echo "Sup: " . $count['username'] . "<br>";
                  }
              }
            $player5 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='ADC' order by rand() limit 2");
            if ($player5)
              {
                foreach ($player5 as $count)
                  {
                    $i++;
                    //echo "ADC: " . $count['username'] . "<br>";
                  }
              }
          }
        else if ($playerLane == "Top")
          {
            $i       = 0;
            $player1 = $db->select("(select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Top' order by rand() limit 1)
                union (select * from accounts where id = '" . $playerid . "')");
            if ($player1)
              {
                foreach ($player1 as $count)
                  {
                    $i++;
                    //echo "Top: " . $count['username'] . "<br>";
                  }
              }
            $player2 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Jungle' order by rand() limit 2");
            if ($player2)
              {
                foreach ($player2 as $count)
                  {
                    $i++;
                    //echo "Jungle: " . $count['username'] . "<br>";
                  }
              }
            $player3 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Mid' order by rand() limit 2");
            if ($player3)
              {
                foreach ($player3 as $count)
                  {
                    $i++;
                    //echo "Mid: " . $count['username'] . "<br>";
                  }
              }
            $player4 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Sup' order by rand() limit 2");
            if ($player4)
              {
                foreach ($player4 as $count)
                  {
                    $i++;
                    //echo "Sup: " . $count['username'] . "<br>";
                  }
              }
            $player5 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='ADC' order by rand() limit 2");
            if ($player5)
              {
                foreach ($player5 as $count)
                  {
                    $i++;
                    //echo "ADC: " . $count['username'] . "<br>";
                  }
              }
          }
        else if ($playerLane == "Jungle")
          {
            $i       = 0;
            $player1 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Top' order by rand() limit 2");
            if ($player1)
              {
                foreach ($player1 as $count)
                  {
                    $i++;
                    //echo "Top: " . $count['username'] . "<br>";
                  }
              }
            $player2 = $db->select("(select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Jungle' order by rand() limit 1)
                union (select * from accounts where id = '" . $playerid . "')");
            if ($player2)
              {
                foreach ($player2 as $count)
                  {
                    $i++;
                    //echo "Jungle: " . $count['username'] . "<br>";
                  }
              }
            $player3 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Mid' order by rand() limit 2");
            if ($player3)
              {
                foreach ($player3 as $count)
                  {
                    $i++;
                    //echo "Mid: " . $count['username'] . "<br>";
                  }
              }
            $player4 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='Sup' order by rand() limit 2");
            if ($player4)
              {
                foreach ($player4 as $count)
                  {
                    $i++;
                    //echo "Sup: " . $count['username'] . "<br>";
                  }
              }
            $player5 = $db->select("select * from accounts where 
                status = 1 and (rank = '" . $playerRank . "' or rank = '" . ($playerRank + 1) . "') and id != '" . $playerid . "' and mainLane='ADC' order by rand() limit 2");
            if ($player5)
              {
                foreach ($player5 as $count)
                  {
                    $i++;
                    //echo "ADC: " . $count['username'] . "<br>";
                  }
              }
          }
        if ($i == 10) ////////////////////////////////////////////////////////VAI TER JOGO//////////////////////////////////////////////
          {
            //echo $i . " jogadores encontrados! Tudo pronto para iniciar Game!";
            $bt_points = 0;
            $rt_points = 0;
            
            $bt_top = $player1['0'];
            $rt_top = $player1['1'];
            
            $bt_jg = $player2['0'];
            $rt_jg = $player2['1'];
            
            $bt_mid = $player3['0'];
            $rt_mid = $player3['1'];
            
            $bt_sup = $player4['0'];
            $rt_sup = $player4['1'];
            
            $bt_adc = $player5['0'];
            $rt_adc = $player5['1'];
            $points = array(
                "rt_top" => 0,
                "bt_top" => 0,
                "rt_jg" => 0,
                "bt_jg" => 0,
                "rt_mid" => 0,
                "bt_mid" => 0,
                "rt_sup" => 0,
                "bt_sup" => 0,
                "rt_adc" => 0,
                "bt_adc" => 0,
                "bt" => 0,
                "rt" => 0
            );
            $kda    = array(
                "rt_top" => "",
                "bt_top" => "",
                "rt_jg" => "",
                "bt_jg" => "",
                "rt_mid" => "",
                "bt_mid" => "",
                "rt_sup" => "",
                "bt_sup" => "",
                "rt_adc" => "",
                "bt_adc" => "",
                "bt" => "",
                "rt" => ""
            );
            $ama    = array(
                "rt_top" => "",
                "bt_top" => "",
                "rt_jg" => "",
                "bt_jg" => "",
                "rt_mid" => "",
                "bt_mid" => "",
                "rt_sup" => "",
                "bt_sup" => "",
                "rt_adc" => "",
                "bt_adc" => "",
                "bt" => "",
                "rt" => ""
            );
            
            $attr = array(
                "attr_mech",
                "attr_farm",
                "attr_nocao",
                "attr_roaming",
                "attr_pos",
                "attr_tf",
                "attr_com",
                "attr_luck",
                "attr_carisma"
            );
            $c    = 0;
            while ($c < 4) ////////////////CONTANDO ATRIBUTOS SOLO
              {
                if ($rt_top[$attr[$c]] != $bt_top[$attr[$c]])
                  {
                    if ($rt_top[$attr[$c]] > $bt_top[$attr[$c]])
                      {
                        $points['rt_top']++;
                        $points['rt_top']++;
                      }
                    else
                      {
                        $points['bt_top']++;
                        $points['bt_top']++;
                      }
                  }
                if ($rt_jg[$attr[$c]] != $bt_jg[$attr[$c]])
                  {
                    if ($rt_jg[$attr[$c]] > $bt_jg[$attr[$c]])
                      {
                        $points['rt_jg']++;
                        $points['rt_jg']++;
                      }
                    else
                      {
                        $points['bt_jg']++;
                        $points['bt_jg']++;
                      }
                  }
                if ($rt_mid[$attr[$c]] != $bt_mid[$attr[$c]])
                  {
                    if ($rt_mid[$attr[$c]] > $bt_mid[$attr[$c]])
                      {
                        $points['rt_mid']++;
                        $points['rt_mid']++;
                      }
                    else
                      {
                        $points['bt_mid']++;
                        $points['bt_mid']++;
                      }
                  }
                if ($rt_sup[$attr[$c]] != $bt_sup[$attr[$c]])
                  {
                    if ($rt_sup[$attr[$c]] > $bt_sup[$attr[$c]])
                      {
                        $points['rt_sup']++;
                        $points['rt_sup']++;
                      }
                    else
                      {
                        $points['bt_sup']++;
                        $points['bt_sup']++;
                      }
                  }
                if ($rt_adc[$attr[$c]] != $bt_adc[$attr[$c]])
                  {
                    if ($rt_adc[$attr[$c]] > $bt_adc[$attr[$c]])
                      {
                        $points['rt_adc']++;
                        $points['rt_adc']++;
                      }
                    else
                      {
                        $points['bt_adc']++;
                        $points['bt_adc']++;
                      }
                  }
                //echo $attr[$c] . "<br>";
                $c++;
                
              }
            $c = 4;
            while ($c < 9) ////////////////CONTANDO ATRIBUTOS EM TIME
              {
                $rt_soma            = array(
                    "attr_mech" => 0,
                    "attr_farm" => 0,
                    "attr_nocao" => 0,
                    "attr_roaming" => 0,
                    "attr_pos" => 0,
                    "attr_tf" => 0,
                    "attr_com" => 0,
                    "attr_luck" => 0,
                    "attr_carisma" => 0
                );
                $bt_soma            = array(
                    "attr_mech" => 0,
                    "attr_farm" => 0,
                    "attr_nocao" => 0,
                    "attr_roaming" => 0,
                    "attr_pos" => 0,
                    "attr_tf" => 0,
                    "attr_com" => 0,
                    "attr_luck" => 0,
                    "attr_carisma" => 0
                );
                $rt_soma[$attr[$c]] = $rt_top[$attr[$c]] + $rt_jg[$attr[$c]] + $rt_mid[$attr[$c]] + $rt_sup[$attr[$c]] + $rt_adc[$attr[$c]];
                $bt_soma[$attr[$c]] = $bt_top[$attr[$c]] + $bt_jg[$attr[$c]] + $bt_mid[$attr[$c]] + $bt_sup[$attr[$c]] + $bt_adc[$attr[$c]];
                if ($rt_soma[$attr[$c]] != $bt_soma[$attr[$c]])
                  {
                    if ($rt_soma[$attr[$c]] > $bt_soma[$attr[$c]])
                      {
                        $points['rt']++;
                      }
                    else
                      {
                        $points['bt']++;
                      }
                  }
                //echo $attr[$c] . "<br>";
                $c++;
              }
            ////////////////CONTANDO PONTOS SOLO + KDA///////////////////////////
            if ($points['bt_top'] != $points['rt_top'])
              {
                if ($points['bt_top'] > $points['rt_top'])
                  {
                    $points['bt']++;
                    $winKill       = rand(1, 10);
                    $loseKill      = rand(0, 5);
                    $winAssist     = rand(5, 10);
                    $loseAssist    = rand(0, 10);
                    $kda['bt_top'] = $winKill . "/" . $loseKill . "/" . $winAssist;
                    $ama['bt_top'] = ama($winKill, $loseKill, $winAssist);
                    $kda['rt_top'] = $loseKill . "/" . $winKill . "/" . $loseAssist;
                    $ama['rt_top'] = ama($loseKill, $winKill, $loseAssist);
                    
                  }
                else
                  {
                    $points['rt']++;
                    $winKill       = rand(1, 10);
                    $loseKill      = rand(0, 5);
                    $winAssist     = rand(5, 10);
                    $loseAssist    = rand(0, 10);
                    $kda['bt_top'] = $loseKill . "/" . $winKill . "/" . $loseAssist;
                    $ama['bt_top'] = ama($loseKill, $winKill, $loseAssist);
                    $kda['rt_top'] = $winKill . "/" . $loseKill . "/" . $winAssist;
                    $ama['rt_top'] = ama($winKill, $loseKill, $winAssist);
                  }
              }
            else
              {
                $winKill       = rand(1, 5);
                $loseKill      = rand(1, 5);
                $winAssist     = rand(0, 10);
                $loseAssist    = rand(0, 10);
                $kda['bt_top'] = $loseKill . "/" . $winKill . "/" . $loseAssist;
                $ama['bt_top'] = ama($loseKill, $winKill, $loseAssist);
                $kda['rt_top'] = $winKill . "/" . $loseKill . "/" . $winAssist;
                $ama['rt_top'] = ama($winKill, $loseKill, $winAssist);
              }
            if ($points['bt_jg'] != $points['rt_jg'])
              {
                if ($points['bt_jg'] > $points['rt_jg'])
                  {
                    $points['bt']++;
                    $winKill      = rand(1, 10);
                    $loseKill     = rand(0, 5);
                    $kda['bt_jg'] = $winKill . "/" . $loseKill . "/" . rand(5, 10);
                    $kda['rt_jg'] = $loseKill . "/" . $winKill . "/" . rand(0, 10);
                  }
                else
                  {
                    $points['rt']++;
                    $winKill      = rand(1, 10);
                    $loseKill     = rand(0, 5);
                    $kda['rt_jg'] = $winKill . "/" . $loseKill . "/" . rand(5, 10);
                    $kda['bt_jg'] = $loseKill . "/" . $winKill . "/" . rand(0, 10);
                  }
              }
            else
              {
                $winKill      = rand(1, 5);
                $loseKill     = rand(1, 5);
                $kda['bt_jg'] = $winKill . "/" . $loseKill . "/" . rand(0, 10);
                $kda['rt_jg'] = $loseKill . "/" . $winKill . "/" . rand(0, 10);
              }
            if ($points['bt_mid'] != $points['rt_mid'])
              {
                if ($points['bt_mid'] > $points['rt_mid'])
                  {
                    $points['bt']++;
                    $winKill       = rand(1, 10);
                    $loseKill      = rand(0, 5);
                    $kda['bt_mid'] = $winKill . "/" . $loseKill . "/" . rand(5, 10);
                    $kda['rt_mid'] = $loseKill . "/" . $winKill . "/" . rand(0, 10);
                  }
                else
                  {
                    $points['rt']++;
                    $winKill       = rand(1, 10);
                    $loseKill      = rand(0, 5);
                    $kda['rt_mid'] = $winKill . "/" . $loseKill . "/" . rand(5, 10);
                    $kda['bt_mid'] = $loseKill . "/" . $winKill . "/" . rand(0, 10);
                  }
              }
            else
              {
                $winKill       = rand(1, 5);
                $loseKill      = rand(1, 5);
                $kda['bt_mid'] = $winKill . "/" . $loseKill . "/" . rand(0, 10);
                $kda['rt_mid'] = $loseKill . "/" . $winKill . "/" . rand(0, 10);
              }
            if ($points['bt_sup'] != $points['rt_sup'])
              {
                if ($points['bt_sup'] > $points['rt_sup'])
                  {
                    $points['bt']++;
                    $winKill       = rand(1, 10);
                    $loseKill      = rand(0, 5);
                    $kda['bt_sup'] = $winKill . "/" . $loseKill . "/" . rand(5, 10);
                    $kda['rt_sup'] = $loseKill . "/" . $winKill . "/" . rand(0, 10);
                  }
                else
                  {
                    $points['rt']++;
                    $winKill       = rand(1, 10);
                    $loseKill      = rand(0, 5);
                    $kda['rt_sup'] = $winKill . "/" . $loseKill . "/" . rand(5, 10);
                    $kda['bt_sup'] = $loseKill . "/" . $winKill . "/" . rand(0, 10);
                  }
              }
            else
              {
                $winKill       = rand(1, 5);
                $loseKill      = rand(1, 5);
                $kda['bt_sup'] = $winKill . "/" . $loseKill . "/" . rand(0, 10);
                $kda['rt_sup'] = $loseKill . "/" . $winKill . "/" . rand(0, 10);
              }
            if ($points['bt_adc'] != $points['rt_adc'])
              {
                if ($points['bt_adc'] > $points['rt_adc'])
                  {
                    $points['bt']++;
                    $winKill       = rand(1, 10);
                    $loseKill      = rand(0, 5);
                    $kda['bt_adc'] = $winKill . "/" . $loseKill . "/" . rand(5, 10);
                    $kda['rt_adc'] = $loseKill . "/" . $winKill . "/" . rand(0, 10);
                  }
                else
                  {
                    $points['rt']++;
                    $winKill       = rand(1, 10);
                    $loseKill      = rand(0, 5);
                    $kda['rt_adc'] = $winKill . "/" . $loseKill . "/" . rand(5, 10);
                    $kda['bt_adc'] = $loseKill . "/" . $winKill . "/" . rand(0, 10);
                  }
              }
            else
              {
                $winKill       = rand(1, 5);
                $loseKill      = rand(1, 5);
                $kda['bt_adc'] = $winKill . "/" . $loseKill . "/" . rand(0, 10);
                $kda['rt_adc'] = $loseKill . "/" . $winKill . "/" . rand(0, 10);
              }
            /////////////////////////////////////////////////FINALIZANDO CONTAGEM DE PONTOS DE TIME
            if ($points['bt'] != $points['rt'])
              {
                if ($points['bt'] > $points['rt'])
                  {
                    //echo "blue"; //TIME BLUE VENCEU
                  $winnerTeam = 'blue';
                  }
                else
                  {
                    //echo "red"; //TIME RED VENCEU
                  $winnerTeam = 'red';
                  }
              }
            else
              {
                if (rand(1, 2) == 2)
                  {
                    //echo "red"; //TIME RED VENCEU
                  $winnerTeam = 'red';
                  }
                else
                  {
                    //echo "blue"; //TIME BLUE VENCEU
                  $winnerTeam = 'blue';
                  }
              }
            //print_r($points);
            //echo "<br>";
            //print_r($kda);
            //echo "<br>";
            /*echo "<table border=1>
            <tr>
            <td></td><td colspan=2>TIME AZUL</td><td>VS</td><td colspan=2>TIME VERMELHO</td>
            </tr>
            <tr>
            <td>Top</td><td>" . $bt_top['username'] . "</td><td>" . $kda['bt_top'] . " (" . $ama['bt_top'] . ")</td><td>vs</td><td>" . $kda['rt_top'] . "</td><td>" . $rt_top['username'] . "</td>
            </tr>
            <tr>
            <td>Jungle</td><td>" . $bt_jg['username'] . "</td><td>" . $kda['bt_jg'] . "</td><td>vs</td><td>" . $kda['rt_jg'] . "</td><td>" . $rt_jg['username'] . "</td>
            </tr>
            <tr>
            <td>Mid</td><td>" . $bt_mid['username'] . "</td><td>" . $kda['bt_mid'] . "</td><td>vs</td><td>" . $kda['rt_mid'] . "</td><td>" . $rt_mid['username'] . "</td>
            </tr>
            <tr>
            <td>Sup</td><td>" . $bt_sup['username'] . "</td><td>" . $kda['bt_sup'] . "</td><td>vs</td><td>" . $kda['rt_sup'] . "</td><td>" . $rt_sup['username'] . "</td>
            </tr>
            <tr>
            <td>ADC</td><td>" . $bt_adc['username'] . "</td><td>" . $kda['bt_adc'] . "</td><td>vs</td><td>" . $kda['rt_adc'] . "</td><td>" . $rt_adc['username'] . "</td>
            </tr>
            </table>";*/
          $match = $db->query("insert into ranked
          (bt_player1, bt_player2, bt_player3, bt_player4, bt_player5, 
          rt_player1, rt_player2, rt_player3, rt_player4, rt_player5, 
          btp1_frag, btp2_frag, btp3_frag, btp4_frag, btp5_frag, 
          rtp1_frag, rtp2_frag, rtp3_frag, rtp4_frag, rtp5_frag, 
          winnerTeam, date, bt_points, rt_points)
          values
          ('".$bt_top['id']."', '".$bt_jg['id']."', '".$bt_mid['id']."', '".$bt_sup['id']."', '".$bt_adc['id']."', 
          '".$rt_top['id']."', '".$rt_jg['id']."', '".$rt_mid['id']."', '".$rt_sup['id']."', '".$rt_adc['id']."', 
          '".$kda['bt_top']."', '".$kda['bt_jg']."', '".$kda['bt_mid']."', '".$kda['bt_sup']."', '".$kda['bt_adc']."', 
          '".$kda['rt_top']."', '".$kda['rt_jg']."', '".$kda['rt_mid']."', '".$kda['rt_sup']."', '".$kda['rt_adc']."', 
          '".$winnerTeam."', '".date('d/m/Y')." ".date('H:i:s')."', '".$points['bt']."', '".$points['rt']."')");
            $result = $db->query("update accounts set status='3', time_status='" . $time . "' where
          id = '" . $player1['0']['id'] . "' or 
          id = '" . $player1['1']['id'] . "' or 
          id = '" . $player2['0']['id'] . "' or 
          id = '" . $player2['1']['id'] . "' or 
          id = '" . $player3['0']['id'] . "' or 
          id = '" . $player3['1']['id'] . "' or 
          id = '" . $player4['0']['id'] . "' or 
          id = '" . $player4['1']['id'] . "' or 
          id = '" . $player5['0']['id'] . "' or 
          id = '" . $player5['1']['id'] . "'");
            echo json_encode(1); //NÃO FORAM ENCONTRADOS JOGADORES SUFICIENTES PARAR FORMAR UM TIME
          }
        else ////////////////////////////////////////////////////////NAO TEVE JOGO!!//////////////////////////////////////////////
          {
            echo json_encode(2); //NÃO FORAM ENCONTRADOS JOGADORES SUFICIENTES PARAR FORMAR UM TIME
          }
      }
    else
      {
        $rows = $db->select("select * from accounts where status = 1 and rank = '" . $playerRank . "' and id != '" . $playerid . "' limit 9");
      }
    if (1 == 2)
      {
        $i = 0;
        foreach ($rows as $count)
          {
            $i++;
          }
        if ($i == 9)
          {
            $result = $db->query("update accounts set status='3', time_status='" . $time . "' where id = '" . $playerid . "'");
            foreach ($rows as $jogadores)
              {
                $result = $db->query("update accounts set status='3', time_status='" . $time . "' where id = '" . $jogadores['id'] . "'");
              }
          }
      }
  }
else
  {
    echo json_encode(0); //OU LEVEL INSUFICIENTE, OU NÃO ESTÁ NA FILA!!
  }
?>
