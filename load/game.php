<?php
session_start();
include_once("../scripts/php/getPlayerInfo.php");
$status         = getPlayerInfo($_SESSION['player'], "status");
$playerMainLane = getPlayerInfo($_SESSION['player'], "mainLane");
$playerAvailableIcons = getPlayerInfo($_SESSION['player'], "availableIcons");
$playerLastRankedMatch = getPlayerInfo($_SESSION['player'], "lastRankedMatch");


$playerAvailableIcons = str_split($playerAvailableIcons, 14);
sort($playerAvailableIcons);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//                                                  STORE CONFIG
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$sellIcons = array("ProfileIcon011", "ProfileIcon012", "ProfileIcon013", "ProfileIcon014", "ProfileIcon015", "ProfileIcon016", "ProfileIcon017", "ProfileIcon018", "ProfileIcon019", "ProfileIcon020", "ProfileIcon021", "ProfileIcon022", "ProfileIcon023", "ProfileIcon024", "ProfileIcon025", "ProfileIcon026", "ProfileIcon027", "ProfileIcon028", "ProfileIcon029");

$count = 0;
while ($count < 19)
{
  if (in_array($sellIcons[$count], $playerAvailableIcons))
  {
    $displayText[$count] = "ADQUIRIDO";
  }
  else
  {
    $displayText[$count] = "COMPRAR";
  }
  $count++;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//                                                      END
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
  <div class="tabbable" id="tabs-979314">
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#panel-462955" data-toggle="tab">WEBLOL</a>
      </li>
      <li>
        <a href="#panel-232133" data-toggle="tab" onclick='loadPart("housePage", "house");'>OFF</a>
      </li>
      <li>
        <a href="#panel-998195" data-toggle="tab">SOBRE</a>
      </li>
      <li>
        <a href="#panel-821372" data-toggle="tab" onclick='loadPart("rankPage", "rank");'>RANKS</a>
      </li>
      <li>
        <a href="#panel-12312321" data-toggle="tab" onclick='loadPart("donationPage", "donation");'>DONATE</a>
      </li>
      <li>
        <a href="#panel-92123" data-toggle="tab" onclick='loadPart("homePage", "home");'>NEWS</a>
      </li>
      <li>
        <a href="#panel-823812" data-toggle="tab" onclick='loadPart("playersPage", "players");'>JOGADORES</a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="panel-462955">
        <div class="inTab">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills" id="navBar">
                  <li class="active" id="lobbyNav">
                    <a href="javascript:void(0)" onclick="navMenu(0)">Lobby</a>
                  </li>
                  <li id="profileNav">
                    <a href="javascript:void(0)" onclick="navMenu(1)">Perfil</a>
                  </li>
                  <li id="partidaNav">
                    <a href="javascript:void(0)" onclick="navMenu(2)">Partida</a>
                  </li>
                  <li id="storeNav">
                    <a href="javascript:void(0)" onclick="navMenu(3)">Loja</a>
                  </li>
                  <li id="inventoryNav">
                    <a href="javascript:void(0)" onclick="navMenu(4)">Inventário</a>
                  </li>
                  <li id="prizesNav">
                    <a href="javascript:void(0)" onclick="navMenu(5)">Prêmios</a>
                  </li>
                  <li class="dropdown pull-right">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Outros<strong class="caret"></strong></a>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="#" onclick="startGame('normal')"><span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span> Jogar Normal</a>
                      </li>
                      <li>
                        <a href="#" onclick="navMenu(5)"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> Prêmios</a>
                      </li>
                      <li class="divider">
                      </li>
                      <li>
                        <a href="#" onclick="javascript:logout()"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Sair</a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <div class="inTab" id="lobby">
                  <div class="page-header">
                    <h1 class="titulo">
                    Lobby <small>*le música de elevador*</small>
                      <?php /////////////////////////////////////////////////////////////////////////////////////lobby///////// 
?>
                  </h1>
                  </div>
                  <div class="alert alert-info alert-dismissable">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
					×
				</button>
                    <h4>
					Ajude-nos, <b>DOE</b>!
				</h4> <strong>Olá Invocadores!</strong> Vocês, que estão jogando, sabem que esse jogo está em construção, não é? Estamos na fase de testes, e por isso contamos com sua ajuda. E para que tudo fique melhor ainda, gostaríamos que vocês participassem do nosso <a href="https://www.facebook.com/groups/1127048927366430/" target="_blank">grupo no Facebook: WebLoLGame.com.br/facebook</a>!<br> Meta de doações: 50R$
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        <span class="sr-only"></span>
                      </div>
                    </div>
                    Alcançado: 0%
                  </div>

                  <div class="panel panel-default" id="selectDiv">
                    <div class="panel-body" style="text-align:center">

                      <table style="width:100%">
                        <tr>
                          <input type="text" id="playerid" value="<?php
echo $_SESSION['player'];
?>" style="display:none">
                          <td><b>Campeão:</b> Selecione seu Main Champion</td>
                          <td>
                            <select onclick="mainSave()" onchange="mainSave()" id="mainChampSelect" <?php if ($status !=0 ) { echo 'disabled'; } ?>>
                        <?php
include_once("../scripts/php/championListSelect.php");
?>
                      </select>
                          </td>
                        </tr>
                        <tr>
                          <td><b>Lane:</b> Selecione sua Main Lane</td>
                          <td>


                            <select onclick="mainSave()" id="mainLaneSelect" <?php if ($status !=0 ) { echo 'disabled'; } ?>>
                          <?php
$laneChoice = array(
				"Top",
				"Mid",
				"Jungle",
				"ADC",
				"Sup"
);
$i          = 0;
while ($i < 5)
		{
				if ($playerMainLane == $laneChoice[$i])
						{
								echo "<option value='" . $laneChoice[$i] . "' selected>" . $laneChoice[$i] . "</option>";
						}
				else
						{
								echo "<option value='" . $laneChoice[$i] . "'>" . $laneChoice[$i] . "</option>";
						}
				$i++;
		}
?>
                      </select>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <?php
$difTime = getPlayerInfo($_SESSION['player'], "time_status") - time();
if ($difTime <= 0)
		{
				//$difTime = 0;
		}
?><br>
                    <div class="panel panel-default" id="timeDiv" <?php if ($status!=2 && $status!=3 ) { echo 'style="display:none"'; } ?>>
                      <div class="panel-body" style="text-align:center">

                        <h3>
                          Sua partida acaba em </h3>
                        <h2><span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                  <?php
echo '<span id="time1">' . date("i:s", $difTime) . '</span>';
?>
                     </h2>
                      </div>
                    </div>
                    <div class="panel panel-default" id="queueDiv" <?php if ($status!=1 ) { echo 'style="display:none"'; } ?>>
                      <div class="panel-body" style="text-align:center">

                        <h3>Na Fila </h3>
                        <h2><span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                  <?php
echo '<span id="time2">' . date("i:s", ((-1) * $difTime)) . '</span>';
?>
                     </h2>
                        <button type="button" class="btn btn-default btn-lg" onclick="searchRankedTeam()" style="width:100%">
  <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Procurar Time
</button><br>
                        <button type="button" class="btn btn-default btn-lg" onclick="startGame('closeQ')" style="width:100%">
  <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Sair da Fila
</button><br>
                        <button type="button" class="btn btn-default btn-lg" onclick="whoInQ()" style="width:100%">
  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Quem está na Fila?
</button>
                      </div>
                    </div>
                </div>
                <div class="inTab" id="profile" style="display:none">
                  <!----------------------------perfil----------------------------->
                  <div class="page-header">
                    <h1 class="titulo">Meu Perfil <br><small>
                      <?php /////////////////////////////////////////////////////////////////////////////////////perfil///////// 
?>
                      <?php
$backgroundIcon = getPlayerInfo($_SESSION['player'], "icon");
$faceStyle      = "style='background: url(images/icons/" . $backgroundIcon . ".jpg); background-size: contain;'";
$username       = getPlayerInfo($_SESSION['player'], "username");
$level          = getPlayerInfo($_SESSION['player'], "level");
$playerLevel    = getPlayerInfo($_SESSION['player'], "level");
if ($playerLevel < 30)
		{
				$playerExp      = getPlayerInfo($_SESSION['player'], "exp");
				$reqExp         = ($playerLevel + 1) * 10;
				$expPercent     = ($playerExp * 100) / $reqExp;
				$expTextDisplay = $playerExp . "/" . $reqExp;
		}
else
		{
				$playerExp      = getPlayerInfo($_SESSION['player'], "exp");
				$reqExp         = 0;
				$expPercent     = 100;
				$expTextDisplay = $playerExp;
		}

?>
                      
                      </small></h1>

                  </div>
                  <?php
echo "<div  class='profileBanner'>".$username . " Lv " . $level ."</div><br>
                  <table class='table table-hover'>
                  <tr>
                  <td>Experiência: </td>
                  <td>" . $expTextDisplay . "</td>
                  </tr>
                  <tr>
                  <td>Partidas Normais: </td>
                  <td>" . number_format(getPlayerInfo($_SESSION['player'], "normalGames")) . " (".getPlayerInfo($_SESSION['player'], "normal_win")." W/ ".getPlayerInfo($_SESSION['player'], "normal_loss")." L)</td>
                  </tr>
                  <tr>
                  <td>Partidas Ranqueadas: </td>
                  <td>" . number_format(getPlayerInfo($_SESSION['player'], "rankedGames")) . " (".getPlayerInfo($_SESSION['player'], "ranked_win")." W/ ".getPlayerInfo($_SESSION['player'], "ranked_loss")." L)</td>
                  </tr>
                  </table>
                  
                  ";
echo "
                  <table class='table table-hover'>
                  <tr>
                  <th colspan=2>Atributos: </th>
                  </tr>
                  <tr>
                  <td>Mecânica: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'attr_mech')) . "</span></td>
                  </tr>
                  <tr>
                  <td>Farm: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'attr_farm')) . "</span></td>
                  </tr>
                  <tr>
                  <td>Noção de Jogo: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'attr_nocao')) . "</span></td>
                  </tr>
                  <tr>
                  <td>Carisma: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'attr_carisma')) . "</span></td>
                  </tr>
                  <tr>
                  <td>Posicionamento: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'attr_pos')) . "</span></td>
                  </tr>
                  <tr>
                  <td>Team Fight: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'attr_tf')) . "</span></td>
                  </tr>
                  <tr>
                  <td>Roaming: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'attr_roaming')) . "</span></td>
                  </tr>
                  <tr>
                  <td>Comunicação: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'attr_com')) . "</span></td>
                  </tr>
                  <tr>
                  <td>Sorte: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'attr_luck')) . "</span></td>
                  </tr>
                  </table>
                  
                  
                  <table class='table table-hover'>
                  <tr>
                  <th>Lanes</th><th>Maestria</th>
                  </tr>
                  <tr>
                  <td>Top: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'mastery_top')) . "</span></td>
                  </tr>
                  <tr>
                  <td>Jungle: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'mastery_jg')) . "</span></td>
                  </tr>
                  <tr>
                  <td>Mid: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'mastery_mid')) . "</span></td>
                  </tr>
                  <tr>
                  <td>Support: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'mastery_sup')) . "</span></td>
                  </tr>
                  <tr>
                  <td>AD Carry: </td>
                  <td><span class=\"badge\">" . number_format(getPlayerInfo($_SESSION['player'], 'mastery_adc')) . "</span></td>
                  </tr>
                  </table>
                  ";
?>
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <p><b>Informações Pessoais</b> (essas informações só você pode ver)</p>

                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">Email</span>
                          <input type="email" class="form-control" placeholder="" aria-describedby="basic-addon1" value="<?php echo getPlayerInfo($_SESSION['player'], 'email'); ?>" id="novoEmail" maxlength="32">
                          <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="attInfo(1)">Salvar</button>
      </span>
                        </div>
                        <br>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">Nova Senha</span>
                          <input type="password" class="form-control" placeholder="Digite sua Senha" aria-describedby="basic-addon1" id="novaSenha" maxlength="12">
                          <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="attInfo(2)">Salvar</button>
      </span>
                        </div>
                      </div>
                    </div>

                </div>
                <div class="inTab" id="partida" style="display:none">
                  <div class="page-header">
                    <h1 class="titulo">Jogar <br><small>
                      <?php /////////////////////////////////////////////////////////////////////////////////////partida///////// 
?>
                      PvP em Summoner's Rift (5v5)</small></h1>
                  </div>
                  <p><b>Partidas Normais:</b></p>
                  <p><b>Partidas Ranqueadas:</b></p>
                  <table style="width:100%; text-align:center" class="table table-hover">
                    <tr>
                      <td colspan="2"><b>INCIAR PARTIDA</b><br> Escolha o Modo da Partida que deseja jogar.</td>

                    </tr>
                    <tr>
                      <td style="width:50%; text-align:center">
                        <?php
$playerLevel = getPlayerInfo($_SESSION['player'], "level");
if ($playerLevel == 30) //PODE JOGAR RANKED
		{
				echo '<button type="button" class="btn btn-danger" onclick="startGame(\'ranked\')">RANQUEADA</button>';
		}
else
		{
				echo '<button type="button" class="btn btn-danger" disabled title="Somente jogadores nível 30 podem jogar partidas Ranqueadas">RANQUEADA</button>';
		}
echo "";
?>
                      </td>
                      <td style="width:50%; text-align:center"><button type="button" class="btn btn-warning" onclick="startGame('normal')">NORMAL</button></td>
                    </tr>
                  </table>
                  <?php if ($playerLastRankedMatch != 0)
{
  echo "<center><a href='javascript:void(0)' onclick='matchResult(".$playerLastRankedMatch.")'>Ver resultados da última partida Ranqueada</a></center>";
}?>

                </div>
                <div class="inTab" id="store" style="display:none">
                  <div class="page-header">
                    <h1 class="titulo">
                    Loja <small></small>
                      <?php /////////////////////////////////////////////////////////////////////////////////////loja///////// 
?>
                  </h1>
                  </div>
                  <h2>
                 Campeões 
                    <button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggleButton('championTable')">
  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
</button>
                </h2>
                  <table style="width:100%; text-align:center;" class="table championTable" id="championTable">
                    <?php
include "../scripts/php/championListStore.php";
?>
                  </table>
                  <h2>
                 Acessórios
                    <button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggleButton('acessoryTable')">
  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
</button>
                </h2>
                  <table style="width:100%; text-align:center;" class="championTable table" id="acessoryTable">
                    <tr>
                      <td style="width:33%" title="Recupera 100 de Energia">
                        <img class='champImg' src='images/icons/energyPack.png'><br>Pacote de Energia<br><img class='iprpImg' src='images/layout/IpPoints.png'> 1500 IP<br>[<a href='javascript:void(0)' onclick='storeBuy("energyPack")' style='font-size:10px'>COMPRAR</a>]
                      </td>
                      <td style="width:33%" title="Compra todos os Campeões">
                        <img class='champImg' src='images/icons/allchamps.png'><br>Todos os Campeões<br><img class='iprpImg' src='images/layout/RpPoints.png'> 5 RP<br>[<a href='javascript:void(0)' onclick='storeBuy("allchamps")' style='font-size:10px'>COMPRAR</a>]
                      </td>
                      <td style="width:33%" title="Reseta seu nível para o Lv. 1 e recebe 1,500 IP">
                        <img class='champImg' src='images/icons/reset.png'><br>Reset<br>- 30 Níveis<br>[<a href='javascript:void(0)' onclick='storeBuy("reset")' style='font-size:10px'>COMPRAR</a>]
                      </td>
                    </tr>
                    <tr>
                      <td style="width:33%" title="Aumenta a EXP ganha em 20x">
                        <img class='champImg' src='images/icons/expBooster.png'><br>EXP Booster (5 partidas)<br><img class='iprpImg' src='images/layout/IpPoints.png'> 1000 IP<br>[<a href='javascript:void(0)' onclick='storeBuy("expBooster")' style='font-size:10px'>COMPRAR</a>]
                      </td>
                      <td style="width:33%" title="Aumenta o PdL ganho em 2x">
                        <img class='champImg' src='images/icons/service-divisionBoosting.png'><br>Elo Booster (5 partidas)<br><img class='iprpImg' src='images/layout/RpPoints.png'> 10 RP<br>[<a href='javascript:void(0)' onclick='storeBuy("eloBooster")' style='font-size:10px'>COMPRAR</a>]
                      </td>
                      <td style="width:33%" title="Aumenta o IP ganho em 5x">
                        <img class='champImg' src='images/icons/ipBooster.png'><br>IP Booster (5 partidas)<br><img class='iprpImg' src='images/layout/RpPoints.png'> 5 RP<br>[<a href='javascript:void(0)' onclick='storeBuy("ipBooster")' style='font-size:10px'>COMPRAR</a>]
                      </td>
                    </tr>
                    <tr>
                      <td style="width:33%" title="Compra todos os Campeões">
                      </td>
                      <td style="width:33%" title="Chega ao Nível 30 instantaneamente">
                        <img class='champImg' src='images/icons/expBooster.png'><br>+ 30 Níveis<br><img class='iprpImg' src='images/layout/RpPoints.png'> 1 RP<br>[<a href='javascript:void(0)' onclick='storeBuy("level30")' style='font-size:10px'>COMPRAR</a>]
                      </td>
                      <td style="width:33%" title="Compra todos os Campeões">
                      </td>
                    </tr>
                  </table>
                  <h2>
                 Ícones de Invocador
                    <button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggleButton('iconsTable')">
  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
</button>
                </h2>
                  <table style="width:100%; text-align:center;" class="championTable table" id="iconsTable">
                    <tr>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon011.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon011")' style='font-size:10px'>
                          <?php echo $displayText[0] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon012.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon012")' style='font-size:10px'>
                          <?php echo $displayText[1] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon013.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon013")' style='font-size:10px'>
                          <?php echo $displayText[2] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon014.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon014")' style='font-size:10px'>
                          <?php echo $displayText[3] ?>
                        </a>]
                      </td>
                    </tr>
                    <tr>

                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon015.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon015")' style='font-size:10px'>
                          <?php echo $displayText[4] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon016.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon016")' style='font-size:10px'>
                          <?php echo $displayText[5] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon017.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon017")' style='font-size:10px'>
                          <?php echo $displayText[6] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon018.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon018")' style='font-size:10px'>
                          <?php echo $displayText[7] ?>
                        </a>]
                      </td>
                    </tr>
                    <tr>

                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon019.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon019")' style='font-size:10px'>
                          <?php echo $displayText[8] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon020.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon020")' style='font-size:10px'>
                          <?php echo $displayText[9] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon021.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon021")' style='font-size:10px'>
                          <?php echo $displayText[10] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon022.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon022")' style='font-size:10px'>
                          <?php echo $displayText[11] ?>
                        </a>]
                      </td>
                    </tr>
                    <tr>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon023.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon023")' style='font-size:10px'>
                          <?php echo $displayText[12] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon024.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon024")' style='font-size:10px'>
                          <?php echo $displayText[13] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon025.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon025")' style='font-size:10px'>
                          <?php echo $displayText[14] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon026.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon026")' style='font-size:10px'>
                          <?php echo $displayText[15] ?>
                        </a>]
                      </td>
                    </tr>
                    <tr>

                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon027.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon027")' style='font-size:10px'>
                          <?php echo $displayText[16] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon028.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon028")' style='font-size:10px'>
                          <?php echo $displayText[17] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                        <img class='champImg' src='images/icons/ProfileIcon029.jpg'><br><img class='iprpImg' src='images/layout/IpPoints.png'> 500 IP<br>[
                        <a href='javascript:void(0)' onclick='storeBuy("icon_ProfileIcon029")' style='font-size:10px'>
                          <?php echo $displayText[18] ?>
                        </a>]
                      </td>
                      <td style="width:25%">
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="inTab" id="inventory" style="display:none">
                  <div class="page-header">
                    <h1 class="titulo">
                    Inventário <small></small>
                      <?php /////////////////////////////////////////////////////////////////////////////////////inventario///////// 
?>
                  </h1>
                  </div>
                  <h2>
                  Campeões
                </h2>
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table style="width:100%; text-align:center;" class="championTable">
                        <?php
include "../scripts/php/championListInventory.php";
?>
                      </table>
                    </div>
                  </div>
                  <h2>
                  Ícones<br><small>Clique no ícone para usar de perfil</small>
                </h2>
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table style="width:100%; text-align:center;" class="championTable">
                        <?php
include "../scripts/php/inv_iconsList.php";
?>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="inTab" id="prizes" style="display:none">
                  <div class="page-header">
                    <h1 class="titulo">
                    Sala de Prêmios
                      <?php /////////////////////////////////////////////////////////////////////////////////////PRÊMIOS///////// 
?>
                  </h1>
                  </div>
                  <h2>
                  Prêmio Diário<br><small>Ganhe um prêmio por dia!</small>
                </h2>
                  <div class="panel panel-default">
                    <div class="panel-body" style="text-align:center">
                      <button type="button" class="btn btn-success" onclick="dailyPrize()" id="dailyPrizeButton">Pegar Prêmio Diário</button>
                    </div>
                  </div>
                  <h2>
                  Promo Code<br><small>Encontre o código!</small>
                </h2>
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span></span>
                        <input type="text" class="form-control" placeholder="Promo Code" aria-describedby="basic-addon1" id="promoCode"><span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="promoCode()">Verificar!</button>
      </span>
                      </div><br>
                      <div class="alert alert-info" role="alert" id="promoCodeResult">O código de Promo poderá aparecer em alguma parte do site, ou na página do facebook, ou em qualquer lugar! Portanto, fique atento!</div>

                    </div>

                  </div>
                  <h2>
                 Roleta Russa<br><small>Mentira, não é russa não!</small>
                </h2>
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="alert alert-info" role="alert" id="promoCodeResult">Esse jogo (um jogo dentro de um jogo???) é baseado em apostas. Aqui apostamos <img class='iprpImg' src='images/layout/IpPoints.png'> 50 IP no time que vai ganhar o CBLoL (eu sei que já passou o CBLoL, mas é só um game de apostas isso!). Temos 8 times: Big Gods, paiN Gaming, Keyd Stars, INTZ, RED Canids, KaBuM, Operation Kino e a CNB.<br> Você aposta em um time e tem 30% de ganhar. Se ganhar, recebe 3x o valor apostado (isto é, se ganhar, recebe <img class='iprpImg' src='images/layout/IpPoints.png'> 50 IP + <img class='iprpImg' src='images/layout/IpPoints.png'> 150 IP). Se perder, perde os <img class='iprpImg' src='images/layout/IpPoints.png'> 50 IP. Entendeu?</div>
                    </div>
                    <table class="table">
                      <tr>
                        <td onclick="aposta(1)"><img src="images/times/123px-Biggods.png"></td>
                        <td onclick="aposta(2)"><img src="images/times/123px-Cnb.png"></td>
                        <td onclick="aposta(3)"><img src="images/times/123px-INTZ_logo.png"></td>
                        <td onclick="aposta(4)"><img src="images/times/123px-Kabum_logo_123.png"></td>
                      </tr>
                      <tr>
                        <td onclick="aposta(5)"><img src="images/times/123px-Keyd_Stars.png"></td>
                        <td onclick="aposta(6)"><img src="images/times/123px-Operationkino.png"></td>
                        <td onclick="aposta(7)"><img src="images/times/123px-PainGaming150.png"></td>
                        <td onclick="aposta(8)"><img src="images/times/123px-Red_Canids_logo.png"></td>
                      </tr>
                    </table>
                    <center><button class="btn btn-default" type="submit" id="betResult">Clique no Time que você quer apostar!</button></center>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="panel-998195">
        <div class="inTab">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12" id="aboutPage">
                <center>Carregando. Aguarde...</center>
                <script>
                  loadPart("aboutPage", "about");

                </script>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="panel-821372">
        <div class="inTab">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12" id="rankPage">
                <center>Carregando. Aguarde...</center>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="panel-12312321">
        <div class="inTab">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12" id="donationPage">
                <center>Carregando. Aguarde...</center>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="panel-92123">
        <div class="inTab">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12" id="homePage">
                <center>Carregando. Aguarde...</center>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="panel-232133">
        <div class="inTab">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12" id="housePage">
                <center>Carregando. Aguarde...</center>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="panel-823812">
        <div class="inTab">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12" id="playersPage">
                <center>Carregando. Aguarde...</center>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
