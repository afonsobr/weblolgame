<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db                = new Db();
$playerstatus      = getPlayerInfo($_SESSION['player'], "status");
$playerLevel       = getPlayerInfo($_SESSION['player'], "level");
$playerTime_status = getPlayerInfo($_SESSION['player'], "time_status");
$playerMainChamp   = getPlayerInfo($_SESSION['player'], "mainChamp");
$playerMainLane    = getPlayerInfo($_SESSION['player'], "mainLane");
$playerNormalWins  = getPlayerInfo($_SESSION['player'], "normal_win");
$playerNormalLoss  = getPlayerInfo($_SESSION['player'], "normal_loss");
if ($playerMainLane == "Top")
  {
    $masteryLane = 'mastery_top';
  }
else if ($playerMainLane == "Jungle")
  {
    $masteryLane = 'mastery_jg';
  }
else if ($playerMainLane == "Mid")
  {
    $masteryLane = 'mastery_mid';
  }
else if ($playerMainLane == "Sup")
  {
    $masteryLane = 'mastery_sup';
  }
else if ($playerMainLane == "ADC")
  {
    $masteryLane = 'mastery_adc';
  }
$playerExpBooster = getPlayerInfo($_SESSION['player'], "expBooster");
$playerIpBooster  = getPlayerInfo($_SESSION['player'], "ipBooster");
$playerid         = $_SESSION['player'];
$difTime          = getPlayerInfo($_SESSION['player'], "time_status") - time();
if ($playerstatus != 0)
  {
    if ($playerstatus == 2) //NORMAL GAME
      {
        $gained_mech       = rand(0, 2);
        $gained_farm       = rand(0, 2);
        $gained_nocao      = rand(0, 2);
        $gained_carisma    = rand(0, 2);
        $gained_pos        = rand(0, 2);
        $gained_tf         = rand(0, 2);
        $gained_roaming    = rand(0, 2);
        $gained_com        = rand(0, 2);
        $matchResult       = rand(1, 2);
        $gained_expBooster = 0;
        $gained_ipBooster  = 0;
        if ($matchResult == 1) //WIN
          {
            $playerNormalWins = $playerNormalWins + 1;
            $playerNormalLoss = $playerNormalLoss;
            $gained_exp       = rand(15, 20);
            $kills            = rand(0, 10);
            $deaths           = rand(0, 5);
            $assists          = rand(5, 10);
            $gained_ip        = rand(50, 100);
            $gained_PdM       = rand(1, 5);
            $gained_lanePdM   = rand(1, 5);
            $sendResult       = 1;
          }
        else ///LOOSE
          {
            $playerNormalWins = $playerNormalWins;
            $playerNormalLoss = $playerNormalLoss + 1;
            $gained_exp       = rand(10, 15);
            $kills            = rand(0, 5);
            $deaths           = rand(5, 10);
            $assists          = rand(0, 10);
            $gained_ip        = rand(30, 70);
            $gained_PdM       = 0;
            $gained_lanePdM   = 0;
            $sendResult       = 0;
          }
        if ($playerLevel == 30 || $playerLevel == 1)
          {
            $gained_exp = $gained_exp / 2;
            $gained_exp = (int) $gained_exp;
          }
        $kda = $kills . "/" . $deaths . "/" . $assists;
        if ($deaths == 0)
          {
            $deaths = 1;
          }
        $ama = number_format(($kills + $assists) / $deaths, 1);
        if ($ama < 10)
          {
            $gained_ip = $gained_ip;
          }
        else
          {
            $gained_ip = ($ama / 10) * $gained_ip;
          }
        if ($ama > 2)
          {
            $gained_exp = ($ama / 2) * $gained_exp;
            $gained_exp = (int) $gained_exp;
          }
        
        if ($playerExpBooster > 0)
          {
            $playerExpBooster--;
            $gained_expBooster = $gained_exp * 19;
          }
        if ($playerIpBooster > 0)
          {
            $playerIpBooster--;
            $gained_ipBooster = $gained_ip * 4;
          }
        $gained_PdM        = $gained_PdM * $ama;
        $gained_PdM        = (int) $gained_PdM;
        $gained_lanePdM    = $gained_lanePdM * $ama;
        $gained_lanePdM    = (int) $gained_lanePdM;
        $gained_ip         = (int) $gained_ip;
        $final_mech        = $gained_mech + getPlayerInfo($_SESSION['player'], "attr_mech");
        $final_farm        = $gained_farm + getPlayerInfo($_SESSION['player'], "attr_farm");
        $final_nocao       = $gained_nocao + getPlayerInfo($_SESSION['player'], "attr_nocao");
        $final_carisma     = $gained_carisma + getPlayerInfo($_SESSION['player'], "attr_carisma");
        $final_pos         = $gained_pos + getPlayerInfo($_SESSION['player'], "attr_pos");
        $final_tf          = $gained_tf + getPlayerInfo($_SESSION['player'], "attr_tf");
        $final_roaming     = $gained_roaming + getPlayerInfo($_SESSION['player'], "attr_roaming");
        $final_com         = $gained_com + getPlayerInfo($_SESSION['player'], "attr_com");
        $final_exp         = $gained_exp + $gained_expBooster + getPlayerInfo($_SESSION['player'], "exp");
        $final_energy      = getPlayerInfo($_SESSION['player'], "energy") - 5;
        $final_ip          = $gained_ip + $gained_ipBooster + getPlayerInfo($_SESSION['player'], "ip");
        $final_PdM         = $gained_PdM + getPlayerChampionInfo($_SESSION['player'], $playerMainChamp, "maestria");
        $final_lanePdM     = $gained_lanePdM + getPlayerInfo($_SESSION['player'], $masteryLane);
        $final_normalGames = getPlayerInfo($_SESSION['player'], "normalGames") + 1;
        $result            = $db->query("update accounts set 
                attr_mech = '" . $final_mech . "',
                attr_farm = '" . $final_farm . "',
                attr_nocao = '" . $final_nocao . "',
                attr_carisma = '" . $final_carisma . "',
                attr_pos = '" . $final_pos . "',
                attr_tf = '" . $final_tf . "',
                attr_roaming = '" . $final_roaming . "',
                attr_com = '" . $final_com . "',
                exp = '" . $final_exp . "',
                energy = '" . $final_energy . "',
                ip = '" . $final_ip . "',
                expBooster = '" . $playerExpBooster . "',
                ipBooster = '" . $playerIpBooster . "',
                normalGames = '" . $final_normalGames . "',
                normal_win = '" . $playerNormalWins . "',
                normal_loss = '" . $playerNormalLoss . "',
                " . $masteryLane . " = '" . $final_lanePdM . "',
                status= '0',
                time_status = '0'
                where id = '" . $playerid . "'");
        
        $resposta = array(
            "<span class='resultText'>
                Você ficou <i>" . $kda . "</i> (KDA) com <i>" . $ama . "</i> de AMA
                <style>
                .resultTable
                {
                text-align:left;
                margin:auto;
                }
                .resultTable td
                {
                padding: 0px 10px 0px 0px ;
                }
                
                </style>
                <table class='resultTable'>
                <tr>
                <td>Mecânica</td>
                <td>(+ " . $gained_mech . ") </td>
                <td>= " . $final_mech . "</td>
                </tr>
                <tr>
                <td>Farm</td>
                <td>(+ " . $gained_farm . ") </td>
                <td>= " . $final_farm . "</td>
                </tr>
                <tr>
                <td>Noção de Jogo</td>
                <td>(+ " . $gained_nocao . ") </td>
                <td>= " . $final_nocao . "</td>
                </tr>
                <tr>
                <td>Carisma</td>
                <td>(+ " . $gained_carisma . ") </td>
                <td>= " . $final_carisma . "</td>
                </tr>
                <tr>
                <td>Posicionamento</td>
                <td>(+ " . $gained_pos . ") </td>
                <td>= " . $final_pos . "</td>
                </tr>
                <tr>
                <td>Team Fight</td>
                <td>(+ " . $gained_tf . ") </td>
                <td>= " . $final_tf . "</td>
                </tr>
                </tr>
                <tr>
                <td>Roaming</td>
                <td>(+ " . $gained_roaming . ") </td>
                <td>= " . $final_roaming . "</td>
                </tr>
                </tr>
                <tr>
                <td>Comunicação</td>
                <td>(+ " . $gained_com . ") </td>
                <td>= " . $final_com . "</td>
                </tr>
                </tr>
                <tr>
                <td>Experiência</td>
                <td>(+ " . $gained_exp . " + " . $gained_expBooster . ") </td>
                <td>= " . $final_exp . "</td>
                </tr>
                </tr>
                <tr>
                <td>Energia</td>
                <td>(- 5) </td>
                <td>= " . $final_energy . "</td>
                </tr>
                </tr>
                <tr>
                <td>IP</td>
                <td>(+ " . $gained_ip . " + " . $gained_ipBooster . ") </td>
                <td>= " . $final_ip . "</td>
                </tr>
                <tr>
                <td>PdM com [" . $playerMainChamp . "]</td>
                <td>(+ " . $gained_PdM . ") </td>
                <td>= " . $final_PdM . "</td>
                </tr>
                <tr>
                <td>PdM de [" . $playerMainLane . "]</td>
                <td>(+ " . $gained_lanePdM . ") </td>
                <td>= " . $final_lanePdM . "</td>
                </tr>
                </table>
                
                
                
                <div style='display:none'>Mecânica (+ " . $gained_mech . ") = " . $final_mech . "
                Farm (+ " . $gained_farm . ") = " . $final_farm . "
                Noção de Jogo (+ " . $gained_nocao . ") = " . $final_nocao . "
                Carisma (+ " . $gained_carisma . ") = " . $final_carisma . "
                Posicionamento (+ " . $gained_pos . ") = " . $final_pos . "
                Team Fight (+ " . $gained_tf . ") = " . $final_tf . "
                Roaming (+ " . $gained_roaming . ") = " . $final_roaming . "
                Comunicação (+ " . $gained_com . ") = " . $final_com . "
                Experiência (+ " . $gained_exp . " + " . $gained_expBooster . ") = " . $final_exp . "
                Energia (- 5) = " . $final_energy . "
                IP (+ " . $gained_ip . ") = " . $final_ip . "
                PdM com [" . $playerMainChamp . "] (+ " . $gained_PdM . ") = " . $final_PdM . "</div></span>
                ",
            $sendResult
        );
        echo json_encode($resposta);
        $result = $db->query("update player_champions set 
                maestria = '" . $final_PdM . "'
                where playerid = '" . $playerid . "' and champion = '" . $playerMainChamp . "'");
      }
    else if ($playerstatus == 3 && $playerLevel == 30) //RANKED GAME
      {
        $result = $db->query("update accounts set status='0', time_status='0' where id = '" . $playerid . "'");
        echo json_encode("1");
      }
    else
      {
        echo json_encode("0");
      }
  }
?>
