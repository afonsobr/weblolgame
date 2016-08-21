<?php 
session_start();
include_once("../scripts/php/getPlayerInfo.php");
?>
<style>
  .controlDiv {
    width: 100%;
    height: 40px;
    text-transform: uppercase;
  }
  
  .controlDiv ul {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 10px;
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    height: 40px;
  }
  
  .controlDiv li {
    height: 40px;
    float: left;
    padding: 10px;
  }
  
  .controlDiv li a {
    height: 100%;
    width: 100%;
    display: block;
    text-decoration: none;
    color: #cfba6b;
    text-align: center;
    text-decoration: none;
  }
  
  .controlDiv li a:hover {}
  
  .registerSpan {
    position: absolute;
    top: 50%;
    right: 5px;
    transform: translate(0, -50%);
    text-align: center;
    text-transform: uppercase;
    background-color: #194A4C;
    background: linear-gradient(#215f62, #0a2021);
    color: #baa27c;
    border: 1px solid #a29361;
    border-color: #187277 #3a6668 #0e3f41 #3a6668;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, .8);
    font-style: italic;
    padding: 5px;
  }

</style>

<div class="controlDiv">

  <ul style="font-family:fantasy;">
    <li><a href="http://weblolgame.com.br/facebook" target="_blank">Facebook</a></li>
    <li><a href="index.php">Reload</a></li>

    <?php 
  if (isset($_SESSION['player']))
{
    if (isset($_SESSION['chat']))
    {
      if ($_SESSION['chat'] == 0)
      {
        ?>
    <script>$('#chatDiv').hide();
    $("#myonoffswitch").prop("checked", false)</script>
    <?php
      }
      else
      {
        echo '<script>$("#chatDiv").show();</script>';
      }
    }
    else
    {
      $_SESSION['chat'] = true;
    }
    ?>
    <li>Manter Chat</li>
    <li>
      <div class="onoffswitch">
        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked onclick="chatToggle()">
        <label class="onoffswitch-label" for="myonoffswitch"></label>
      </div>
    </li>
  </ul>
    <?php
    
}
  else
  {
    echo "
    </ul>
    <span class='registerSpan'>Faça Login ou Registre-se gratuitamente!</span>";
  }
  ?>


  
</div>

<style>
  .onoffswitch {
    position: relative;
    width: 55px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
  }
  
  .onoffswitch-checkbox {
    display: none;
  }
  
  .onoffswitch-label {
    display: block;
    overflow: hidden;
    cursor: pointer;
    height: 20px;
    padding: 0;
    line-height: 20px;
    border: 0px solid #FFFFFF;
    border-radius: 30px;
    background-color: #9E9E9E;
  }
  
  .onoffswitch-label:before {
    content: "";
    display: block;
    width: 30px;
    margin: -5px;
    background: #FFFFFF;
    position: absolute;
    top: 0;
    bottom: 0;
    right: 31px;
    border-radius: 30px;
    box-shadow: 0 6px 12px 0px #757575;
  }
  
  .onoffswitch-checkbox:checked+ .onoffswitch-label {
    background-color: #42A5F5;
  }
  
  .onoffswitch-checkbox:checked+ .onoffswitch-label,
  .onoffswitch-checkbox:checked+ .onoffswitch-label:before {
    border-color: #42A5F5;
  }
  
  .onoffswitch-checkbox:checked+ .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
  }
  
  .onoffswitch-checkbox:checked+ .onoffswitch-label:before {
    right: 0px;
    background-color: #2196F3;
    box-shadow: 3px 6px 18px 0px rgba(0, 0, 0, 0.2);
  }

</style>
