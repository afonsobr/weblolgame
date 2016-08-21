<?php
session_start();
include_once("../scripts/php/getPlayerInfo.php");
if (isset($_SESSION['player']))
  {
    $status = getPlayerInfo($_SESSION['player'], "status");
    include "../scripts/php/level.php";
    $playerUsername = getPlayerInfo($_SESSION['player'], "username");
    echo "<center>Seja Bem Vindo(a), <i>" . $playerUsername . "</i> (#" . $_SESSION['player'] . ").<br><br></center>";
    $difTime = getPlayerInfo($_SESSION['player'], "time_status") - time();
    setPlayerOnline($_SESSION['player']);
    if ($status == 2) //NORMAL
      {
        if ($difTime <= 0)
          {
            $difTime = 0;
            echo "<script>finishGame()</script>";
          }
        else
          {
            echo "<script>startTimer(" . $difTime . ");</script>";
          }
      }
    else if ($status == 1) //NA FILA
      {
        $difTime = (-1) * $difTime;
        echo "<script>
        startTimer2(" . $difTime . ");
        </script>";
      }
    else if ($status == 3) //RANKED
      {
        if ($difTime <= 0)
          {
            $difTime = 0;
            echo "<script>finishRanked();</script>";
          }
        else
          {
            echo "<script>startTimer(" . $difTime . "); loadingScreen();</script>";
          }
      }
    //echo date("i:s", $difTime)."[DEBUG]";
    
  }
else
  {
    echo "Seja Bem Vindo(a)!<br><br>";
?>
    <div class="loginForm" id="loginForm">
        <script>
            loadPart("loginForm", "loginForm");

        </script>
    </div>
    <?php
  }
?>

        <?php
if (isset($_SESSION['player']))
  {
  }
else
  {
  }
?>

            <?php
if (isset($_SESSION['player']))
  {
?>
                <div class="subInfo subInfo2Abled">
                    <?php
    $backgroundIcon = getPlayerInfo($_SESSION['player'], "icon");
    $faceStyle      = "style='background: url(images/icons/" . $backgroundIcon . ".jpg); background-size: contain; '";
?>
                        <div class="face" <?php echo $faceStyle; ?>>
                            <div class="level">
                                <?php
    echo getPlayerInfo($_SESSION['player'], "level");
?>
                            </div>
                        </div>
                        <div class="moreInfo">
                            <div class="moreInfoText">
                                <table style="width:100%;">
                                    <tr style="height:30px">
                                        <td style="height:30px"><a href="#" onclick="$('#chatDiv').show();"><span class="glyphicon glyphicon-inbox"> Chat</span></a></td>
                                    </tr>
                                    <tr style="height:20px">
                                        <td style="height:30px"><a href="#"><span class="glyphicon glyphicon-option-horizontal"> Opções</span></a></td>
                                    </tr>
                                    <tr style="height:20px">
                                        <td style="height:30px"><a href="#" onclick="javascript:logout()"><span class="glyphicon glyphicon-off"> Sair</span></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                </div><br>
                <div class="subInfo2Abled">
                    <table border="1" style="border:1px #fff solid">
                        <?php
    $status = getPlayerInfo($_SESSION['player'], "status");
    echo '<input type="text" id="playerstatus" value="' . $status . '" style="display:none">';
    if ($status == 0) //ONLINE
      {
        $displayStatus = "<span style='color:green'>Online</span>";
        //$displayStatus = "<span style='color:green'>Online</span>";
      }
    else if ($status == 1) //NA FILA (PARA RANKED)
      {
        $displayStatus = "<span style='color:orange'>Na Fila</span>";
      }
    else if ($status == 2) //JOGANDO NORMAL
      {
        $displayStatus = "<span style='color:red'>Normal em andamento</span>";
      }
    else if ($status == 3) //JOGANDO RANKED
      {
        $displayStatus = "<span style='color:red'>Ranqueada em andamento</span>";
      }
    /////////////////////////////////////////////
    //EXP
    /////////////////////////////////////////////
    $playerLevel = getPlayerInfo($_SESSION['player'], "level");
    if ($playerLevel < 30)
      {
        $playerExp  = getPlayerInfo($_SESSION['player'], "exp");
        $reqExp     = ($playerLevel + 1) * 10;
        $expPercent = ($playerExp * 100) / $reqExp;
      }
    else
      {
        $playerExp  = getPlayerInfo($_SESSION['player'], "exp");
        $reqExp     = 0;
        $expPercent = 100;
      }
    $playerExpBooster = getPlayerInfo($_SESSION['player'], "expBooster");
    
    echo '
        <div class="progress" title="EXP: ' . getPlayerInfo($_SESSION['player'], "exp") . ' / ' . $reqExp . '" >
        <div class="progress-bar progress-bar-info" style="width:' . $expPercent . '%; color:white">';
    if ($playerLevel == 30)
      {
        echo 'EXP: ' . number_format($playerExp);
      }
    echo '
        </div>
        </div>

<table style="width:100%; text-align:center" class="table">
        <tr><td colspan=2>Status: <b>' . $displayStatus . '</b></td></tr>
         <tr>
         <td colspan=2 title="Você recupera 1 de Energia a cada 4 minutos!">Energia: <span style="color:black"><b>
        ' . getPlayerInfo($_SESSION['player'], "energy") . ' / 100 <span class="glyphicon glyphicon-flash" aria-hidden="true"></span></b>
        </span></td>
        </tr>
        <tr><td colspan=2 id="boostersMouse">Boosters (passe o mouse)</td>
        </tr>
        <tr id="boostersTr"><td colspan=2><img class="iprpImg" src="images/icons/XP_boost.png"> ExpBoosters: <b>' . getPlayerInfo($_SESSION['player'], "expBooster") . '</b><br><img class="iprpImg" src="images/icons/IP_boost.png"> IPBoosters: <b>' . getPlayerInfo($_SESSION['player'], "ipBooster") . '</b><br><img class="iprpImg" src="images/icons/pdl.png"> EloBoosters: <b>' . getPlayerInfo($_SESSION['player'], "eloBooster") . '</b></td></tr>

    
        ';
?>

                            <tr>
                                <td><img class="iprpImg" src="images/layout/IpPoints.png"> IP:
                                    <?php
    echo number_format(getPlayerInfo($_SESSION['player'], "ip"));
?>
                                </td>
                                <td><img class="iprpImg" src="images/layout/RpPoints.png"> RP:
                                    <?php
    echo number_format(getPlayerInfo($_SESSION['player'], "rp"));
?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><img class="iprpImg" src="images/icons/pdl.png">
                                    <?php
    echo getPlayerInfo($_SESSION['player'], "pdl") . " PdL";
?>
                                </td>
                            </tr>
                    </table>
                </div>
                <div class="subInfo subInfo2Abled">
                    <center>

                        <?php
    $rank = getPlayerInfo($_SESSION['player'], "rank");
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
    echo '<img src="images/ranks/' . $rank . 'Badge.png">';
?>

                            <br>
                    </center><br>

                </div>
                <div class="subInfo2Abled">
                    <?php
    echo "<center>Jogando de</center>";
?>
                        <table style="width:100%; text-align:center">
                            <tr>
                                <td style="height:100px">
                                    <?php
    $playerMainLane = getPlayerInfo($_SESSION['player'], "mainLane");
    if ($playerMainLane == "Top")
      {
        $showLane    = "<img class='champImg' src='images/map/Top.png'>";
        $masteryLane = 'mastery_top';
      }
    else if ($playerMainLane == "Jungle")
      {
        $showLane    = "<img class='champImg' src='images/map/Jungle.png'>";
        $masteryLane = 'mastery_jg';
      }
    else if ($playerMainLane == "ADC")
      {
        $showLane    = "<img class='champImg' src='images/map/Bot.png'>";
        $masteryLane = 'mastery_adc';
      }
    else if ($playerMainLane == "Sup")
      {
        $showLane    = "<img class='champImg' src='images/map/Sup.png'>";
        $masteryLane = 'mastery_sup';
      }
    else if ($playerMainLane == "Mid")
      {
        $showLane    = "<img class='champImg' src='images/map/Mid.png'>";
        $masteryLane = 'mastery_mid';
      }
    
    $mainLaneMastery = getPlayerInfo($_SESSION['player'], $masteryLane);
    if ($mainLaneMastery < 100)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery0.png);";
      }
    else if ($mainLaneMastery < 200)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery1.png);";
      }
    else if ($mainLaneMastery < 400)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery2.png);";
      }
    else if ($mainLaneMastery < 800)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery3.png);";
      }
    else if ($mainLaneMastery < 1600)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery4.png);";
      }
    else if ($mainLaneMastery < 3200)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery5.png);";
      }
    else if ($mainLaneMastery < 6400)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery6.png);";
      }
    else
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery7.png);";
      }
    echo "<div class='masteryDiv2' style='" . $masteryBackground . "'>" . $showLane . "</div>";
?>
                                </td>
                                <td>
                                    <?php
    $mainChampMastery = getPlayerChampionInfo($_SESSION['player'], getPlayerInfo($_SESSION['player'], "mainChamp"), "maestria");
    if ($mainChampMastery < 100)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery0.png);";
      }
    else if ($mainChampMastery < 200)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery1.png);";
      }
    else if ($mainChampMastery < 400)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery2.png);";
      }
    else if ($mainChampMastery < 800)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery3.png);";
      }
    else if ($mainChampMastery < 1600)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery4.png);";
      }
    else if ($mainChampMastery < 3200)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery5.png);";
      }
    else if ($mainChampMastery < 6400)
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery6.png);";
      }
    else
      {
        $masteryBackground = "background-image: url(images/mastery/Mastery7.png);";
      }
    //background-image: url(../images/mastery/Mastery0.png);
    echo "<div class='masteryDiv' style='" . $masteryBackground . "'>";
    echo "<img class='champImg' src='images/champions/" . getPlayerInfo($_SESSION['player'], "mainChamp") . ".png'></div>";
?>
                                </td>
                            </tr>
                        </table>
                </div>
                <?php
  }
else
  {
?>
                    <div class="subInfo subInfo2Disabled">
                        <div class="face">
                            <div class="level">30</div>
                        </div>
                        <div class="moreInfo">
                            <div class="moreInfoText">
                                <table style="width:100%;">
                                    <tr style="height:30px">
                                        <td style="height:30px"><a href="#" onclick="$('#chatDiv').show();"><span class="glyphicon glyphicon-inbox"> Chat</span></a></td>
                                    </tr>
                                    <tr style="height:20px">
                                        <td style="height:30px"><a href="#"><span class="glyphicon glyphicon-option-horizontal"> Opções</span></a></td>
                                    </tr>
                                    <tr style="height:20px">
                                        <td style="height:30px"><a href="#"><span class="glyphicon glyphicon-off"> Sair</span></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="subInfo2Disabled">
                        <table style="width:100%; text-align:center">
                            <tr>
                                <td><img src="images/layout/IpPoints.png"> IP: 0</td>
                                <td><img src="images/layout/RpPoints.png"> RP: 0</td>
                            </tr>
                        </table>
                    </div>
                    <div class="subInfo subInfo2Disabled">
                        <center>
                            <h3>Ranqueado</h3>

                            <img src="images/ranks/UnrankedBadge.png">
                            <br>
                        </center><br>
                    </div>
                    <?php
  }
?>
                        <center>
                            <a href="https://www.facebook.com/groups/1127048927366430/" target="_blank">
                                <img src="http://codde.com.br/uploads/cases/de47dfaf373635406d20781c4ebc7d9d.png" style="width:250px"></a>
                        </center>
                        <script>
                            $('#boostersTr').hide();

                            $('#boostersMouse').mouseover(function() {
                                $('#boostersTr').show();
                            });
                            $('#boostersMouse').mouseout(function() {
                                $('#boostersTr').hide();
                            });

                        </script>
