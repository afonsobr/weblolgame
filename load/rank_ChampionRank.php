<?php
session_start();
include_once("../scripts/php/getPlayerInfo.php");
include_once("../scripts/php/dbClass.php");
$db       = new Db();
echo $_POST['champion'];
$championToLoad = htmlspecialchars($_POST['champion'], ENT_QUOTES);
?>
<tr>
  <td><b>Jogador</b></td>
  <td><b>Campeão</b></td>
  <td><b>Pontos de Maestria</b></td>
</tr>
<?php
  $rows = $db->select("select * from player_champions where champion='".$championToLoad."' order by maestria desc");
  foreach ($rows as $info)
  {
    $mainChampMastery = getPlayerChampionInfo($info['playerid'], $info['champion'], "maestria");
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
    $icon = getPlayerInfo($info['playerid'], "icon");
    $nick = getPlayerOnline($info['playerid']).getPlayerInfo($info['playerid'], "username");
    echo "<tr style='text-align:center'>
    <td><img class='champImg' src='images/icons/" . $icon . ".jpg'><br>".$nick."</td>
    <td>
    <div class='masteryDiv' style='" . $masteryBackground . " margin:auto; '>
    <img class='champImg' src='images/champions/" . $info['champion'] . ".png'></div>
    ".$info['champion']."
    </td>
    <td>".$info['maestria']."</td>
    </tr>";
  }
  ?>