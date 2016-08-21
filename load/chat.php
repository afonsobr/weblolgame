<?php
session_start();
include_once("../scripts/php/getPlayerInfo.php");
include_once "../scripts/php/dbClass.php";
$db = new Db();
if (isset($_POST['option']))
{
  if ($_POST['option'] == 1)
  {
    $_SESSION['chat'] = 0;  
  }
  else
  {
    $_SESSION['chat'] = 1;  
  }
}
if (isset($_SESSION['player']))
  {
    $showUsername = "<span style='color:orange'>" . getPlayerInfo($_SESSION['player'], "username") . "</span>";
?>
  <div id="page-wrap">
    <div style="">
      <span><b>CHAT</b></span> <span aria-hidden="true" onclick="toggleButton('chatDiv')" class="close" style="position:absolute; right:10px; color:white">&times;</span>
      <div id="chat-wrap">
        <div id="chat-area">
          <?php
    $chat = $db->select("select * from chat order by id desc limit 15");
    $chat = array_reverse($chat);
    foreach ($chat as $print)
      {
        if ($print['username'] == getPlayerInfo($_SESSION['player'], "username"))
          {
            echo '<div class="chatTextFromMe left">' . $print['message'] . '</div>';
          }
        else
          {
            echo '<div class="chatTextFromYou left"><i>' . $print['username'] . "</i> diz: " . $print['message'] . '</div>';
          }
      }
?>
        </div>
      </div>
      
      <div style="width:100%" id="name-area"><span><b>Logado como: <?php
    echo $showUsername;
?></b></span></div>
    </div>
  </div>
  <?php
  }
?>



      <script>
        $("#chat-area").animate({
          scrollTop: $('#chat-area')[0].scrollHeight
        }, 0);
        var chatUpdater;
        clearTimeout(chatUpdater);
        chatUpdater = setTimeout(function() {
          update();
        }, 8000);

      </script>
