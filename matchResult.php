<?php
session_start();
require("scripts/php/dbClass.php");
require("scripts/php/getPlayerInfo.php");
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>.:WebLoL:.</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link href="lib/style.css" rel="stylesheet">
    <link href="lib/ranked.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script type="application/javascript" src="scripts/includes.js"></script>
    <script src="sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">


    <style>
      body {
        background: url(images/layout/bg-default.jpg) no-repeat top;
        background-color: rgb(0, 0, 0) !important;
        margin: 10px 10px 10px 10px;
      }
      
      .st {
        position: absolute;
        left: 50%;
        top: 300px;
        transform: translateX(-50%);
      }
      
      .header {
        position: relative;
        height: 148px;
        width: 1038px;
        background-image: url(images/layout/frame-sprite.png);
        background-position: 0 0px;
      }
      
      .content {
        padding-left: 50px;
        padding-right: 50px;
        top: -20px;
        position: relative;
        width: 1038px;
        background-image: url(images/layout/frame-sprite2.png);
        background-repeat: repeat-y;
      }
      
      .subheader {
        height: 111px;
        width: 972px;
        background-image: url(images/layout/frame-textures-sprite.jpg);
        z-index: -1;
        position: absolute;
        top: 37px;
        left: 33px;
        padding-left: 30px;
        padding-right: 30px;
        text-align: center;
      }
      
      .footer {
        top: -70px;
        position: relative;
        height: 178px;
        width: 1038px;
        background-image: url(images/layout/frame-sprite.png);
        background-position: 0 178px;
        padding-top: 138px;
        color: white;
        z-index: -1;
      }
      
      a,
      a:hover {
        color: white;
      }
      
      .teste1 {
        background-image: url("resources/images/frame-sprite.png");
        background-position: -33px -414px;
        position: absolute;
        left: 3px;
        right: 0;
        top: -1px;
        z-index: -1;
        display: table;
        width: 975px;
        height: 48px;
        margin: 0;
        padding: 0;
        text-align: center;
        list-style-type: none;
        font-size: .95em
      }
      
      .teste2 {
        display: none;
        width: 100%;
        position: absolute;
        background: transparent url("resources/images/frame-sprite.png") no-repeat 50% -284px;
        bottom: -7px;
        left: 0;
        height: 130px
      }
      
      .teste3 {
        content: "";
        width: 100%;
        height: 136px;
        position: absolute;
        top: -21px;
        left: 0;
        background: transparent url("resources/images/frame-sprite.png") no-repeat 50% -148px
      }
      
      td {
        border: 0px #000 solid;
      }
      
      .playerIcon {
        position: relative;
        width: 50px;
        height: 50px;
        border: 1px #fff;
        border-style: dashed;
      }

    </style>

  </head>

  <body>

    <div class="container-fluid">
      <a href='index.php'><img src="images/layout/logo.png" class="logo"></a>
      <div class="st">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="header">
                <div class="subheader">
                  <?php
if (isset($_POST['matchID'])) {
    $db      = new Db();
    $matchID = htmlspecialchars($_POST['matchID'], ENT_QUOTES);
    $rows    = $db->query("select * from ranked where id='" . $matchID . "' limit 1");
    if ($rows) {
        foreach ($rows as $match) {
            if ($match['winnerTeam'] == 'blue') {
                echo '<h1>Vitória do time Azul!</h1>';
                $matchResult['blue'] = '<b style="color:green">VITÓRIA</b>';
                $matchResult['red']  = '<b style="color:orange">DERROTA</b>';
            } else {
                echo '<h1>Vitória do time Vermelho!</h1>';
                $matchResult['red']  = '<b style="color:green">VITÓRIA</b>';
                $matchResult['blue'] = '<b style="color:orange">DERROTA</b>';
            }
        }
        
    } else {
        $page = 'index.php';
        echo 'Essa partida não existe!<script>location.replace("' . $page . '");</script>';
    }
} else {
    $page = 'index.php';
    echo 'Essa partida não existe!<script>location.replace("' . $page . '");</script>';
}
?>

                </div>

              </div>
              <div class="content">
                <?php
if (isset($_POST['matchID'])) {
    $db      = new Db();
    $matchID = htmlspecialchars($_POST['matchID'], ENT_QUOTES);
    $rows    = $db->query("select * from ranked where id='" . $matchID . "' limit 1");
    if ($rows) {
        foreach ($rows as $match) {
            
            $icon['player1']  = getPlayerInfo($match['rt_player1'], "icon");
            $icon['player1']  = "<img src='images/icons/" . $icon['player1'] . ".jpg' class='playerIcon'>";
            $icon['player2']  = getPlayerInfo($match['rt_player2'], "icon");
            $icon['player2']  = "<img src='images/icons/" . $icon['player2'] . ".jpg' class='playerIcon'>";
            $icon['player3']  = getPlayerInfo($match['rt_player3'], "icon");
            $icon['player3']  = "<img src='images/icons/" . $icon['player3'] . ".jpg' class='playerIcon'>";
            $icon['player4']  = getPlayerInfo($match['rt_player4'], "icon");
            $icon['player4']  = "<img src='images/icons/" . $icon['player4'] . ".jpg' class='playerIcon'>";
            $icon['player5']  = getPlayerInfo($match['rt_player5'], "icon");
            $icon['player5']  = "<img src='images/icons/" . $icon['player5'] . ".jpg' class='playerIcon'>";
            $icon['player6']  = getPlayerInfo($match['bt_player1'], "icon");
            $icon['player6']  = "<img src='images/icons/" . $icon['player6'] . ".jpg' class='playerIcon'>";
            $icon['player7']  = getPlayerInfo($match['bt_player2'], "icon");
            $icon['player7']  = "<img src='images/icons/" . $icon['player7'] . ".jpg' class='playerIcon'>";
            $icon['player8']  = getPlayerInfo($match['bt_player3'], "icon");
            $icon['player8']  = "<img src='images/icons/" . $icon['player8'] . ".jpg' class='playerIcon'>";
            $icon['player9']  = getPlayerInfo($match['bt_player4'], "icon");
            $icon['player9']  = "<img src='images/icons/" . $icon['player9'] . ".jpg' class='playerIcon'>";
            $icon['player10'] = getPlayerInfo($match['bt_player5'], "icon");
            $icon['player10'] = "<img src='images/icons/" . $icon['player10'] . ".jpg' class='playerIcon'>";
            
            $nick['player1']  = getPlayerInfo($match['rt_player1'], "username");
            $nick['player2']  = getPlayerInfo($match['rt_player2'], "username");
            $nick['player3']  = getPlayerInfo($match['rt_player3'], "username");
            $nick['player4']  = getPlayerInfo($match['rt_player4'], "username");
            $nick['player5']  = getPlayerInfo($match['rt_player5'], "username");
            $nick['player6']  = getPlayerInfo($match['bt_player1'], "username");
            $nick['player7']  = getPlayerInfo($match['bt_player2'], "username");
            $nick['player8']  = getPlayerInfo($match['bt_player3'], "username");
            $nick['player9']  = getPlayerInfo($match['bt_player4'], "username");
            $nick['player10'] = getPlayerInfo($match['bt_player5'], "username");
            
            $frag['player1']  = $match['rtp1_frag'];
            $frag['player2']  = $match['rtp2_frag'];
            $frag['player3']  = $match['rtp3_frag'];
            $frag['player4']  = $match['rtp4_frag'];
            $frag['player5']  = $match['rtp5_frag'];
            $frag['player6']  = $match['btp1_frag'];
            $frag['player7']  = $match['btp2_frag'];
            $frag['player8']  = $match['btp3_frag'];
            $frag['player9']  = $match['btp4_frag'];
            $frag['player10'] = $match['btp5_frag'];
            
            
?>


                  <table class="table table-hover" style="width:100%; text-align:center">

                    <tr>
                      <td><img src="images/icons/scoreboardicon_gem_200.png"></td>
                      <td>
                        <?php
            echo $matchResult['red'];
?>
                      </td>
                      <td></td>
                      <td><img src="images/icons/scoreboardicon_score.png"></td>
                      <td></td>
                      <td>
                        <?php
            echo $matchResult['blue'];
?>
                      </td>
                      <td><img src="images/icons/scoreboardicon_gem_100.png"></td>
                    </tr>
                    <tr>
                      <td>
                        <?php
            echo $icon['player1'];
?>
                      </td>
                      <td>
                        <?php
            echo $nick['player1'];
?>
                      </td>
                      <td>
                        <?php
            echo $frag['player1'];
?>
                      </td>
                      <td></td>
                      <td>
                        <?php
            echo $frag['player6'];
?>
                      </td>
                      <td>
                        <?php
            echo $nick['player6'];
?>
                      </td>
                      <td>
                        <?php
            echo $icon['player6'];
?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php
            echo $icon['player2'];
?>
                      </td>
                      <td>
                        <?php
            echo $nick['player2'];
?>
                      </td>
                      <td>
                        <?php
            echo $frag['player2'];
?>
                      </td>
                      <td></td>
                      <td>
                        <?php
            echo $frag['player7'];
?>
                      </td>
                      <td>
                        <?php
            echo $nick['player7'];
?>
                      </td>
                      <td>
                        <?php
            echo $icon['player7'];
?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php
            echo $icon['player3'];
?>
                      </td>
                      <td>
                        <?php
            echo $nick['player3'];
?>
                      </td>
                      <td>
                        <?php
            echo $frag['player3'];
?>
                      </td>
                      <td></td>
                      <td>
                        <?php
            echo $frag['player8'];
?>
                      </td>
                      <td>
                        <?php
            echo $nick['player8'];
?>
                      </td>
                      <td>
                        <?php
            echo $icon['player8'];
?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php
            echo $icon['player4'];
?>
                      </td>
                      <td>
                        <?php
            echo $nick['player4'];
?>
                      </td>
                      <td>
                        <?php
            echo $frag['player4'];
?>
                      </td>
                      <td></td>
                      <td>
                        <?php
            echo $frag['player9'];
?>
                      </td>
                      <td>
                        <?php
            echo $nick['player9'];
?>
                      </td>
                      <td>
                        <?php
            echo $icon['player9'];
?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php
            echo $icon['player5'];
?>
                      </td>
                      <td>
                        <?php
            echo $nick['player5'];
?>
                      </td>
                      <td>
                        <?php
            echo $frag['player5'];
?>
                      </td>
                      <td></td>
                      <td>
                        <?php
            echo $frag['player10'];
?>
                      </td>
                      <td>
                        <?php
            echo $nick['player10'];
?>
                      </td>
                      <td>
                        <?php
            echo $icon['player10'];
?>
                      </td>
                    </tr>

                  </table>
                  <?php
        }
        
    } else {
        $page = 'index.php';
        echo '<script>location.replace("' . $page . '");</script>';
    }
} else {
    $page = 'index.php';
    echo '<script>location.replace("' . $page . '");</script>';
}
?>

              </div>
              <div class="footer">
                <a href="admin.php" target="_blank">Mito 2016</a> - <a href="https://www.facebook.com/groups/1127048927366430/" target="_blank">Facebook</a> / <a href="http://weblolgame.esy.es/">WebLoLGame.esy.es</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>


  </html>
