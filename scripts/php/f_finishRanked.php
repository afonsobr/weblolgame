<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db                = new Db();
$playerstatus      = getPlayerInfo($_SESSION['player'], "status");
$playerRank        = getPlayerInfo($_SESSION['player'], "rank");
$playerLevel       = getPlayerInfo($_SESSION['player'], "level");
$playerTime_status = getPlayerInfo($_SESSION['player'], "time_status");
$playerMainChamp   = getPlayerInfo($_SESSION['player'], "mainChamp");
$playerMainLane    = getPlayerInfo($_SESSION['player'], "mainLane");
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
$playerEloBooster = getPlayerInfo($_SESSION['player'], "eloBooster");
$playerPdl        = getPlayerInfo($_SESSION['player'], "pdl");
$playerRankedWins = getPlayerInfo($_SESSION['player'], "ranked_win");
$playerRankedLoss = getPlayerInfo($_SESSION['player'], "ranked_loss");
$playerid         = $_SESSION['player'];
$difTime          = getPlayerInfo($_SESSION['player'], "time_status") - time();

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//      CONFIG
//
$randPdl      = rand(50, 100);
$randPdlStomp = rand(10, 50);
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($playerstatus != 0)
  {
    if ($playerstatus == 3 && $difTime <= 0) //RANKED GAME
      {
        $ranked = $db->query("select * from ranked where rt_player1 = '" . $playerid . "' or rt_player2 = '" . $playerid . "' or rt_player3 = '" . $playerid . "' or rt_player4 = '" . $playerid . "' or rt_player5 = '" . $playerid . "' or bt_player1 = '" . $playerid . "' or bt_player2 = '" . $playerid . "' or bt_player3 = '" . $playerid . "' or bt_player4 = '" . $playerid . "' or bt_player5 = '" . $playerid . "' order by id desc limit 1");
        if ($ranked)
          {
            foreach ($ranked as $match)
              {
                $matchID = $match['id'];
                if ($playerid == $match['rt_player1'] || $playerid == $match['rt_player2'] || $playerid == $match['rt_player3'] || $playerid == $match['rt_player4'] || $playerid == $match['rt_player5'])
                  {
                    $playerTeam = 'red';
                    if ($playerid == $match['rt_player1'])
                      {
                        $playerFrag = 'rtp1_frag';
                      }
                    else if ($playerid == $match['rt_player2'])
                      {
                        $playerFrag = 'rtp2_frag';
                      }
                    else if ($playerid == $match['rt_player3'])
                      {
                        $playerFrag = 'rtp3_frag';
                      }
                    else if ($playerid == $match['rt_player4'])
                      {
                        $playerFrag = 'rtp4_frag';
                      }
                    else if ($playerid == $match['rt_player5'])
                      {
                        $playerFrag = 'rtp5_frag';
                      }
                  }
                else
                  {
                    if ($playerid == $match['bt_player1'])
                      {
                        $playerFrag = 'btp1_frag';
                      }
                    else if ($playerid == $match['bt_player2'])
                      {
                        $playerFrag = 'btp2_frag';
                      }
                    else if ($playerid == $match['bt_player3'])
                      {
                        $playerFrag = 'btp3_frag';
                      }
                    else if ($playerid == $match['bt_player4'])
                      {
                        $playerFrag = 'btp4_frag';
                      }
                    else if ($playerid == $match['bt_player5'])
                      {
                        $playerFrag = 'btp5_frag';
                      }
                    $playerTeam = 'blue';
                  }
                $kda               = $match[$playerFrag];
                $ama               = explode("/", $kda);
                $gained_mech       = rand(1, 4);
                $gained_farm       = rand(1, 4);
                $gained_nocao      = rand(1, 4);
                $gained_carisma    = rand(1, 4);
                $gained_pos        = rand(1, 4);
                $gained_tf         = rand(1, 4);
                $gained_roaming    = rand(1, 4);
                $gained_com        = rand(1, 4);
                $gained_expBooster = 0;
                $gained_ipBooster  = 0;
                $gained_eloBooster = 0;
                $dif               = abs($match['bt_points'] - $match['rt_points']);
                if ($dif >= 5)
                  {
                    $stomp = true;
                  }
                else
                  {
                    $stomp = false;
                  }
                if ($playerTeam == $match['winnerTeam']) //WIN
                  {
                    $playerRankedWins = $playerRankedWins + 1;
                    $playerRankedLoss = $playerRankedLoss;
                    $gained_exp       = rand(15, 20);
                    $gained_ip        = rand(50, 100);
                    $gained_PdM       = rand(5, 10);
                    $gained_lanePdM   = rand(5, 10);
                    $sendResult       = 1;
                    if ($stomp == true)
                      {
                        $pdl = $randPdlStomp;
                      }
                    else
                      {
                        $pdl = $randPdl;
                      }
                    $showpdl = "+ " . $pdl;
                  }
                else ///LOOSE
                  {
                    $playerRankedWins = $playerRankedWins;
                    $playerRankedLoss = $playerRankedLoss + 1;
                    $gained_exp       = rand(10, 15);
                    $gained_ip        = rand(30, 70);
                    $gained_PdM       = rand(1, 5);
                    $gained_PdM       = 0;
                    $gained_lanePdM   = 0;
                    $sendResult       = 0;
                    if ($stomp == true)
                      {
                        $pdl = (-1) * $randPdlStomp;
                      }
                    else
                      {
                        $pdl = (-1) * $randPdl;
                      }
                    $showpdl = "- " . abs($pdl);
                  }
                if ($playerLevel == 30)
                  {
                    $gained_exp = $gained_exp / 2;
                    $gained_exp = (int) $gained_exp;
                  }
                if ($ama[1] == 0)
                  {
                    $ama[1] = 1;
                  }
                $ama[3] = number_format(($ama[0] + $ama[2]) / $ama[1], 1);
                if ($ama[3] < 10)
                  {
                    $gained_ip = $gained_ip;
                  }
                else
                  {
                    $gained_ip = ($ama[3] / 10) * $gained_ip;
                  }
                if ($ama[3] > 2)
                  {
                    $gained_exp = ($ama[3] / 2) * $gained_exp;
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
                if ($playerEloBooster > 0 and $pdl > 0)
                  {
                    $playerEloBooster--;
                    $pdl     = $pdl * 2;
                    $showpdl = "+ " . $pdl;
                  }
                $gained_PdM        = $gained_PdM * $ama[3];
                $gained_PdM        = (int) $gained_PdM;
                $gained_lanePdM    = $gained_lanePdM * $ama[3];
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
                $final_energy      = getPlayerInfo($_SESSION['player'], "energy") - 10;
                $final_ip          = $gained_ip + $gained_ipBooster + getPlayerInfo($_SESSION['player'], "ip");
                $final_PdM         = $gained_PdM + getPlayerChampionInfo($_SESSION['player'], $playerMainChamp, "maestria");
                $final_lanePdM     = $gained_lanePdM + getPlayerInfo($_SESSION['player'], $masteryLane);
                $final_rankedGames = getPlayerInfo($_SESSION['player'], "rankedGames") + 1;
                $finalPdl          = $playerPdl + $pdl;
                $showRank          = "";
                if ($finalPdl >= 1000)
                  {
                    if ($playerRank < 7)
                      {
                        $finalPdl = 0;
                        $playerRank++;
                        if ($playerRank == 1)
                          {
                            $newRank = "BRONZE";
                          }
                        else if ($playerRank == 2)
                          {
                            $newRank = "PRATA";
                          }
                        if ($playerRank == 3)
                          {
                            $newRank = "OURO";
                          }
                        if ($playerRank == 4)
                          {
                            $newRank = "PLATINA";
                          }
                        if ($playerRank == 5)
                          {
                            $newRank = "DIAMANTE";
                          }
                        if ($playerRank == 6)
                          {
                            $newRank = "MESTRE";
                          }
                        if ($playerRank == 7)
                          {
                            $newRank = "DESAFIANTE";
                          }
                        
                        $showRank = "<br>VOCÊ SUBIU DE ELO!<br>SEJA BEM VINDO AO " . $newRank;
                      }
                  }
                else if ($finalPdl < 0)
                  {
                    $finalPdl = 0;
                    if ($playerRank > 2)
                      {
                        $playerRank--;
                        if ($playerRank == 1)
                          {
                            $newRank = "BRONZE";
                          }
                        else if ($playerRank == 2)
                          {
                            $newRank = "PRATA";
                          }
                        if ($playerRank == 3)
                          {
                            $newRank = "OURO";
                          }
                        if ($playerRank == 4)
                          {
                            $newRank = "PLATINA";
                          }
                        if ($playerRank == 5)
                          {
                            $newRank = "DIAMANTE";
                          }
                        if ($playerRank == 6)
                          {
                            $newRank = "MESTRE";
                          }
                        $showRank = "<br>VOCÊ CAIU DE ELO!<br>AGORA VOCÊ ESTÁ NO " . $newRank;
                      }
                  }
                $result = $db->query("update accounts set 
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
                eloBooster = '" . $playerEloBooster . "',
                " . $masteryLane . " = '" . $final_lanePdM . "',
                rankedGames = '" . $final_rankedGames . "',
                ranked_win = '" . $playerRankedWins . "',
                ranked_loss = '" . $playerRankedLoss . "',
                pdl = '" . $finalPdl . "',
                rank = '" . $playerRank . "',
                status= '0',
                time_status = '0'
                where id = '" . $playerid . "'");
                
                $resposta = array(
                    "
                  <span class='resultText'>
                  <b>PARTIDA RANQUEADA</b><br>
                Você ficou <i>" . $kda . "</i> (KDA) com <i>" . $ama[3] . "</i> de AMA
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
                <td>(- 10) </td>
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
                <tr>
                <td>PdL</td>
                <td>(" . $showpdl . ") </td>
                <td>= " . $finalPdl . "</td>
                </tr>
                </table>
                " . $showRank . "
                
                
                
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
                PdM com [" . $playerMainChamp . "] (+ " . $gained_PdM . ") = " . $final_PdM . "<br>
                </div></span>
                ",
                    $sendResult,
                    $matchID
                );
                echo json_encode($resposta);
                $result = $db->query("update player_champions set 
                maestria = '" . $final_PdM . "'
                where playerid = '" . $playerid . "' and champion = '" . $playerMainChamp . "'");
                
                $result = $db->query("update accounts set status='0', lastRankedMatch='" . $matchID . "', time_status='0' where id = '" . $playerid . "'");
              }
          }
        
      }
    else
      {
        echo json_encode("0");
      }
  }
?>
