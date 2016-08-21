<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db           = new Db();
$playerstatus = getPlayerInfo($_SESSION['player'], "status");
$playerid     = $_SESSION['player'];
$difTime      = getPlayerInfo($_SESSION['player'], "time_status") - time();
if ($playerstatus == 1) //AINDA NA FILA
  {
    
  }
else if ($playerstatus == 3) //TA NA RANKED
  {
    $ranked = $db->query("select * from ranked where rt_player1 = '" . $playerid . "' or rt_player2 = '" . $playerid . "' or rt_player3 = '" . $playerid . "' or rt_player4 = '" . $playerid . "' or rt_player5 = '" . $playerid . "' or bt_player1 = '" . $playerid . "' or bt_player2 = '" . $playerid . "' or bt_player3 = '" . $playerid . "' or bt_player4 = '" . $playerid . "' or bt_player5 = '" . $playerid . "' order by id desc limit 1");
    if ($ranked)
      {
        foreach ($ranked as $match)
          {
            $player1['username']  = getPlayerInfo($match['rt_player1'], "username");
            $player2['username']  = getPlayerInfo($match['rt_player2'], "username");
            $player3['username']  = getPlayerInfo($match['rt_player3'], "username");
            $player4['username']  = getPlayerInfo($match['rt_player4'], "username");
            $player5['username']  = getPlayerInfo($match['rt_player5'], "username");
            $player6['username']  = getPlayerInfo($match['bt_player1'], "username");
            $player7['username']  = getPlayerInfo($match['bt_player2'], "username");
            $player8['username']  = getPlayerInfo($match['bt_player3'], "username");
            $player9['username']  = getPlayerInfo($match['bt_player4'], "username");
            $player10['username'] = getPlayerInfo($match['bt_player5'], "username");
            
            $player1['icon']  = getPlayerInfo($match['rt_player1'], "icon");
            $player2['icon']  = getPlayerInfo($match['rt_player2'], "icon");
            $player3['icon']  = getPlayerInfo($match['rt_player3'], "icon");
            $player4['icon']  = getPlayerInfo($match['rt_player4'], "icon");
            $player5['icon']  = getPlayerInfo($match['rt_player5'], "icon");
            $player6['icon']  = getPlayerInfo($match['bt_player1'], "icon");
            $player7['icon']  = getPlayerInfo($match['bt_player2'], "icon");
            $player8['icon']  = getPlayerInfo($match['bt_player3'], "icon");
            $player9['icon']  = getPlayerInfo($match['bt_player4'], "icon");
            $player10['icon'] = getPlayerInfo($match['bt_player5'], "icon");
            
            $player1['mainChamp']  = getPlayerInfo($match['rt_player1'], "mainChamp");
            $player2['mainChamp']  = getPlayerInfo($match['rt_player2'], "mainChamp");
            $player3['mainChamp']  = getPlayerInfo($match['rt_player3'], "mainChamp");
            $player4['mainChamp']  = getPlayerInfo($match['rt_player4'], "mainChamp");
            $player5['mainChamp']  = getPlayerInfo($match['rt_player5'], "mainChamp");
            $player6['mainChamp']  = getPlayerInfo($match['bt_player1'], "mainChamp");
            $player7['mainChamp']  = getPlayerInfo($match['bt_player2'], "mainChamp");
            $player8['mainChamp']  = getPlayerInfo($match['bt_player3'], "mainChamp");
            $player9['mainChamp']  = getPlayerInfo($match['bt_player4'], "mainChamp");
            $player10['mainChamp'] = getPlayerInfo($match['bt_player5'], "mainChamp");
            
            $resposta = array(
                $player1['username'],
                $player2['username'],
                $player3['username'],
                $player4['username'],
                $player5['username'],
                $player6['username'],
                $player7['username'],
                $player8['username'],
                $player9['username'],
                $player10['username'],
                $player1['icon'],
                $player2['icon'],
                $player3['icon'],
                $player4['icon'],
                $player5['icon'],
                $player6['icon'],
                $player7['icon'],
                $player8['icon'],
                $player9['icon'],
                $player10['icon'],
                $player1['mainChamp'],
                $player2['mainChamp'],
                $player3['mainChamp'],
                $player4['mainChamp'],
                $player5['mainChamp'],
                $player6['mainChamp'],
                $player7['mainChamp'],
                $player8['mainChamp'],
                $player9['mainChamp'],
                $player10['mainChamp']
            );
            echo json_encode($resposta);
          }
      }
    
  }
else //UEH MANO
  {
    
  }
?>