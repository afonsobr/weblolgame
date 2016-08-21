<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db           = new Db();
$playerID     = $_SESSION['player'];
$playerStatus = getPlayerInfo($_SESSION['player'], "status");
$playerMoney  = getPlayerInfo($_SESSION['player'], "money");
$playerEnergy = getPlayerInfo($_SESSION['player'], "energy");
$playerRank   = getPlayerInfo($_SESSION['player'], "rank");
$product      = htmlspecialchars($_POST['product'], ENT_QUOTES);

if ($product == 1)
  {
    $product = 'elojob';
  }
else if ($product == 2)
  {
    $product = 'coaching';
  }


$price = array(
    'elojob' => 100,
    'coaching' => 50
);

if ($playerMoney < $price[$product])
  {
    $result = array(
        0
    ); //MONEY INSUFICIENTE!
  }
else
  {
    if ($product == 'elojob' && $playerRank <= 4)
      {
        $newMoney = $playerMoney - $price[$product];
        $finalPdl = getPlayerInfo($_SESSION['player'], "pdl") + rand(50, 100);
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
            else
              {
                $showRank = "VOCÊ ESTÁ COM " . $finalPdl . " PdL.";
              }
          }
        else
          {
            $showRank = "VOCÊ ESTÁ COM " . $finalPdl . " PdL.";
          }
        $result = $db->query("update accounts set money='" . $newMoney . "', pdl='" . $finalPdl . "', rank = '" . $playerRank . "' where id='" . $playerID . "'");
        $result = array(
            1,
            $showRank
        ); //TRABALHOU 
      }
    else if ($product == 'coaching')
      {
        
      }
    else
      {
        $result = array(
            2
        ); //MONEY INSUFICIENTE!
      }
    
  }


echo json_encode($result);


?>
