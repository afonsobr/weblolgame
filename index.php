<?php

$patchVersion = 'patch 1.3_16_08_16_18_44';
$maintenance = false;

?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>.:WebLoL:.</title>

        <link rel="shortcut icon" href="images/favicon.ico" />
        <link href="lib/chat.css" rel="stylesheet">
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
        <script type="application/javascript" src="scripts/chat/chat.js"></script>



    </head>


    <?php
session_start();
if (!isset($_SESSION['player']))
		{
				echo '<body id="large-header">';
		}
else
		{
				include_once("scripts/php/getPlayerInfo.php");
				echo '<body onload="buildPage(); " id="large-header">';
		}
?>



        <canvas id="demo-canvas"></canvas>
        <!-- particles.js container -->
        <div class="container-fluid" id="bigContainer">

            <a href='index.php'><img src="images/layout/logo.png" class="logo"></a>
            <div class="st0"></div>
            <div class="st1">
                <div class="inside_st1">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12" id="divPage">
                                        <div class="tabbable" id="tabs-558909">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#panel-1" data-toggle="tab">INÍCIO</a>
                                                </li>
                                                <li>
                                                    <a href="#panel-2" data-toggle="tab">REGISTRAR</a>
                                                </li>
                                                <li>
                                                    <a href="#panel-4" data-toggle="tab">RECUPERAR CONTA</a>
                                                </li>
                                                <li>
                                                    <a href="#panel-3" data-toggle="tab">SOBRE</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="panel-1">
                                                    <div class="inTab">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md-12" id="homePage">
                                                                    <script>
                                                                        loadPart("homePage", "home");

                                                                    </script>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="panel-2">
                                                    <div class="inTab">

                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="page-header">
                                                                        <h1>Registro <small></small></h1>
                                                                    </div>
                                                                    <form role="form" method="get" action="">
                                                                        <div class="form-group" title="Esse será seu Nick para exibição e para fazer LogIn no site!">

                                                                            <label for="exampleInputEmail1">Usuário</label>
                                                                            <input maxlength="12" type="text" class="form-control" id="regUsername" required />
                                                                            <small><b>Esse será seu Nick para exibição e para fazer LogIn no site! Não use símbolos, apenas caracteres alfanuméricos (letras e números). Máximo de 12 caracteres.</b></small>
                                                                        </div>
                                                                        <div class="form-group">

                                                                            <label for="exampleInputPassword1">Senha</label>
                                                                            <input maxlength="12" type="password" class="form-control" id="regPassword" required/>
                                                                            <small><b>Máximo de 12 caracteres.</b></small>
                                                                        </div>
                                                                        <div class="form-group">

                                                                            <label for="exampleInputPassword1">Repetir Senha</label>
                                                                            <input maxlength="12" type="password" class="form-control" id="regPassword2" required/>
                                                                        </div>
                                                                        <div class="form-group">

                                                                            <label for="exampleInputPassword1">Email</label>
                                                                            <input maxlength="32" type="email" class="form-control" id="regEmail" required/>
                                                                            <small><b>Máximo de 32 caracteres.</b></small>
                                                                        </div>
                                                                        <div class="checkbox">

                                                                            <label><input type="checkbox" id="cbTerms" required/> Concordo com os <a href="#">Termos e Condições</a> ao me registrar.</label>
                                                                        </div>
                                                                        <button type="button" class="btn btn-default" onclick="javascript:register()" id="RegisterButton">Registrar!</button><br><br>
                                                                        <div id="msgbox2"></div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="panel-3">
                                                    <div class="inTab">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md-12" id="aboutPage">
                                                                    <script>
                                                                        loadPart("aboutPage", "about");

                                                                    </script>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="panel-4">
                                                    <div class="inTab">

                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="page-header">
                                                                        <h1>Recuperar Conta <small><br>Esqueceu sua senha? Complete as informações abaixo para recuperar sua conta!</small></h1>
                                                                    </div>
                                                                    <form role="form" method="get" action="">
                                                                        <div class="form-group" title="">

                                                                            <label for="exampleInputEmail1">Usuário</label>
                                                                            <input maxlength="12" type="text" class="form-control" id="recUsername" required />
                                                                            <small><b></b></small>
                                                                        </div>
                                                                        <div class="form-group">

                                                                            <label for="exampleInputPassword1">Email</label>
                                                                            <input maxlength="32" type="email" class="form-control" id="recEmail" required/>
                                                                        </div>

                                                                        <button type="button" class="btn btn-default" onclick="recPass()" id="RegisterButton">Recuperar!</button><br><br>
                                                                        <div id="msgbox2"></div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="infos" id="sidebar">
                                    <script>
                                        loadPart("sidebar", "sidebar");

                                    </script>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div style="position:relative; height:1px;">
            <div class="st2"></div>
        </div>
        <div style="position:relative; height:1px;"><img src="images/layout/zed.png" class="footerImg"></div>
        <div class="footer">
            <a href="admin.php" target="_blank">Mito 2016</a> | <a href="http://weblolgame.com.br/facebook" target="_blank">Facebook</a> | <a href="http://weblolgame.com.br/">WebLoLGame.com.br</a> | <a href="http://migre.me/uvTrU" target="_blank">Promo Code</a><br>
            <span class="patchVersion"><?php echo $patchVersion ?></span>
            <br>
        </div>



        <div class="loadingRanked">
            <table class="loadingRankedTable">
                <tr>
                    <td class="championFace" id="championp1"><img class='bordap1'>
                        <div class="playerFace" id="iconp1"></div>
                        <div class="playerNick" id="player1Nick">Jogador</div>
                    </td>
                    <td class="championFace" id="championp2"><img class='bordap2'>
                        <div class="playerFace" id="iconp2"></div>
                        <div class="playerNick" id="player2Nick">Jogador</div>
                    </td>
                    <td class="championFace" id="championp3"><img class='bordap3'>
                        <div class="playerFace" id="iconp3"></div>
                        <div class="playerNick" id="player3Nick">Jogador</div>
                    </td>
                    <td class="championFace" id="championp4"><img class='bordap4'>
                        <div class="playerFace" id="iconp4"></div>
                        <div class="playerNick" id="player4Nick">Jogador</div>
                    </td>
                    <td class="championFace" id="championp5"><img class='bordap5'>
                        <div class="playerFace" id="iconp5"></div>
                        <div class="playerNick" id="player5Nick">Jogador</div>
                    </td>

                </tr>
                <tr>
                    <th class="resultText" style="text-align:left; color:orange; font-size:20px" colspan="5"><br>Sua partida acaba em: <span id="time3">--:--</span><br><br></th>
                </tr>
                <tr>
                    <td class="championFace" id="championp6"><img class='bordap6'>
                        <div class="playerFace" id="iconp6"></div>
                        <div class="playerNick" id="player6Nick">Jogador</div>
                    </td>
                    <td class="championFace" id="championp7"><img class='bordap7'>
                        <div class="playerFace" id="iconp7"></div>
                        <div class="playerNick" id="player7Nick">Jogador</div>
                    </td>
                    <td class="championFace" id="championp8"><img class='bordap8'>
                        <div class="playerFace" id="iconp8"></div>
                        <div class="playerNick" id="player8Nick">Jogador</div>
                    </td>
                    <td class="championFace" id="championp9"><img class='bordap9'>
                        <div class="playerFace" id="iconp9"></div>
                        <div class="playerNick" id="player9Nick">Jogador</div>
                    </td>
                    <td class="championFace" id="championp10"><img class='bordap10'>
                        <div class="playerFace" id="iconp10"></div>
                        <div class="playerNick" id="player10Nick">Jogador</div>
                    </td>
                </tr>
            </table>
        </div>


        <div class="chat" id="chatDiv">
            <div id="chatDivLoad">
                <center>Carregando Chat...<br>Aguarde...</center>
                <script>
                    loadPart("chatDivLoad", "chat");

                </script>
            </div>
            <input type="text" id="sendie" maxlength='100' placeholder="Digite uma mensagem..." autocomplete="off">
        </div>

        <div class="controlBar" id="controlBar">
            <script>
                loadPart("controlBar", "controlbar");

            </script>
        </div>

        <div style="position: relative">
            <div class="namiDiv"></div>
            <div class="braumDiv"></div>
        </div>

        <a id="riot-back-to-top-button" href="#top" class="riot-button-btt" style="opacity: 1; cursor: pointer;"></a>

        <?php
if (isset($_SESSION['player']))
		{
?>
            <script>
                buildPage();

            </script>
            <?php
		}
  if ($maintenance== true)
  {
    $page = 'maintenance.php';
        echo '<script>location.replace("'.$page.'");</script>';
    echo '<div class="maintenance"><br>
  <img src="https://lol.garena.com/sites/default/files/sites/default/files/images/Notes/700x265-591.jpg">
  <h1>Estamos em manutenção!</h1><br>
  Acompanhe as notícias no nosso <a href="https://www.facebook.com/groups/1127048927366430/" class="alert-link" target="_blank">grupo do Facebook</a>!
  
  </div>';
  }
  echo "</body>";
?>

                <script src="js/TweenLite.min.js"></script>
                <script src="js/EasePack.min.js"></script>
                <script src="js/rAF.js"></script>
                <script src="js/demo-1.js"></script>
                <script>
                    var wage = document.getElementById("sendie");
                    wage.addEventListener("keydown", function(e) {
                        if (e.keyCode === 13) { //checks whether the pressed key is "Enter"
                            sendMessage();
                        }
                    });

                </script>


    </html>
