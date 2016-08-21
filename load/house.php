<?php
session_start();
include_once("../scripts/php/getPlayerInfo.php");
include_once("../scripts/php/dbClass.php");
$db       = new Db();
$status         = getPlayerInfo($_SESSION['player'], "status");
$playerMainLane = getPlayerInfo($_SESSION['player'], "mainLane");
$playerMoney  = getPlayerInfo($_SESSION['player'], "money");
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
               0 20px 20px rgba(0,0,0,.15);">Casa <small></small></h1>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Caixinha</h3>
    </div>
    <div class="panel-body">
      Você tem: <img src="images/icons/money.png"> <?php echo number_format($playerMoney) ?> R$
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Trabalhar</h3>
    </div>
    <div class="panel-body">
      <div class="alert alert-info" role="alert"><b>Pra quê trabalhar?</b> Conseguir uma graninha <img src="images/icons/money.png"> pra poder comprar Coach/EloBoost.</div>
      <table class="table table-striped" style="text-align:center">
        <tr>
          <td></td>
          <td>Custo (<span class="glyphicon glyphicon-flash" aria-hidden="true"></span>)</td>
          <td>Ganho (<img src="images/icons/money.png">)</td>
        </tr>
        <tr>
          <td><button class="btn btn-default" type="submit" id="trabson" onclick="work(1)">TRABSON!</button>
          </td>
          <td>25 <span class="glyphicon glyphicon-flash" aria-hidden="true"></span>
          </td>
          <td><img src="images/icons/money.png"> 2 R$</td>
        </tr>
        <tr>
          <td><button class="btn btn-default" type="submit" id="trabson" onclick="work(2)">TRABSON!</button>
          </td>
          <td>50 <span class="glyphicon glyphicon-flash" aria-hidden="true"></span>
          </td>
          <td><img src="images/icons/money.png"> 6 R$</td>
        </tr>
        <tr>
          <td><button class="btn btn-default" type="submit" id="trabson" onclick="work(3)">TRABSON!</button>
          </td>
          <td>100 <span class="glyphicon glyphicon-flash" aria-hidden="true"></span>
          </td>
          <td><img src="images/icons/money.png"> 20 R$</td>
        </tr>
      </table>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Contratar</h3>
    </div>
    <div class="panel-body">
      
      <table class="table table-striped" style="text-align:center">
        <tr>
          <td>
          <img class='champImg' src='images/icons/elojob.png'><br>
          EloJob (+50~100 PdL)</td>
          <td><img src="images/icons/money.png"> 100 R$</td>
          <td><button class="btn btn-default" type="submit" onclick="moneyBuy(1)">Comprar</button></td>
        </tr>
        <tr>
          <td><img class='champImg' src='images/icons/coaching.jpg'><br>
          Coaching</td>
          <td><img src="images/icons/money.png"> 50 R$</td>
          <td><button class="btn btn-default" type="submit" onclick="moneyBuy(2)">NÃO FUNCIONA</button></td>
        </tr>
      </table>
      
    </div>
  </div>


  <style>
    #trabson {
      background-image: url(images/icons/yoda.png);
      background-position: center;
      color: black;
      text-shadow: 1px 0px 0px rgba(255, 255, 255, 1), 0px 1px 0px rgba(255, 255, 255, 1), -1px 0px 0px rgba(255, 255, 255, 1), 0px -1px 0px rgba(255, 255, 255, 1);
    }

  </style>
