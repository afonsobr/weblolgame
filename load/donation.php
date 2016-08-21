<?php
session_start();
include_once("../scripts/php/getPlayerInfo.php");
include_once("../scripts/php/dbClass.php");
$db       = new Db();
$status         = getPlayerInfo($_SESSION['player'], "status");
$playerMainLane = getPlayerInfo($_SESSION['player'], "mainLane");
?>
  <div class="page-header">
    <h1 style="text-shadow: 0 1px 0 #ccc, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9, 0 5px 0 #aaa, 0 6px 1px rgba(0,0,0,.1), 0 0 5px rgba(0,0,0,.1), 0 1px 3px rgba(0,0,0,.3), 0 3px 5px rgba(0,0,0,.2), 0 5px 10px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.2), 0 20px 20px rgba(0,0,0,.15);">Doações <small></small></h1>
  </div>
  <dl>
    <dt>Por que doar?</dt>
    <dd>
      Se você pensa em doar para nós, saiba que isso seria de grande ajuda. Precisamos manter um host (e de boa qualidade) para melhor divertimento dos jogadores. Além disso, as doações servem de incentivo para a equipe que constrói o jogo. Ainda, nós retribuimos com os Rito Points (<img class='iprpImg' src='images/layout/RpPoints.png'> RP).
    </dd>
  </dl>
<dl>
    <dt>Como doar?</dt>
    <dd>
      <ol>
      <li>Através do PagSeguro
        <!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="currency" value="BRL" />
<input type="hidden" name="receiverEmail" value="bruno.egidio.afonso@gmail.com" />
<input type="hidden" name="iot" value="button" />
<input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/doacoes/209x48-doar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO --></li>
        <li>Através de <b>depósito bancário em Banco do Brasil</b>. Para isso, entre em contato conosco através do meu email (<i>admin@weblolgame.com.br</i>).<br></li>
      </ol>
      <br>Para cada 5 Reais de doação, retribuiremos com <img class='iprpImg' src='images/layout/IpPoints.png'> 10,000 IP e <img class='iprpImg' src='images/layout/RpPoints.png'> 100 RP, e <img src="images/icons/money.png"> 500 R$. Assim, após a realização do donate, basta enviar-nos o comprovante por email (<i>admin@weblolgame.com.br</i>).
    </dd>
  </dl>