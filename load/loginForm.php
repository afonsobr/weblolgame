<div class="alert alert-danger" id="msgbox" role="alert">Faça login ou registre-se para jogar.</div>
<form role="form">
  <div class="form-group">
    <input type="text" class="form-control" id="loginUsername" placeholder="Usuário" />
  </div>
  <div class="form-group">

    <input type="password" class="form-control" id="loginPassword" placeholder="Senha" />
  </div>

  <button type="button" class="buttonLoL" onclick="javascript:login()" id="LoginButton" style="width:100%">Conectar</button>

</form>

<br>
<div class="alert alert-success alert-dismissable" id="loginAlert">

  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4>Não é registrado?</h4>
  <strong>Invocador</strong>, caso não tenha conta, crie uma gratuitamente!
</div>
