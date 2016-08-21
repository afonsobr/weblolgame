<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db             = new Db();
$playerid       = $_SESSION['player'];
$promoCodeStats = getPlayerInfo($_SESSION['player'], "promo_code");
$promoCode      = htmlspecialchars($_POST['promoCode'], ENT_QUOTES);

if ($promoCode == "L34GU30FL3G3ND5" and $promoCodeStats < 1) //ID 1
    {
    $ip     = getPlayerInfo($_SESSION['player'], "ip");
    $ip     = $ip + 10000;
    $result = $db->query("update accounts set ip='" . $ip . "', promo_code=1 where id='" . $_SESSION['player'] . "'");
    echo json_encode("Você ganhou <img class='iprpImg' src='images/layout/IpPoints.png'> 10000 IP!");
} else if ($promoCode == "IDM" and $promoCodeStats < 2) //ID 2
    {
    $ip     = getPlayerInfo($_SESSION['player'], "ip");
    $ip     = $ip + 1000;
    $result = $db->query("update accounts set ip='" . $ip . "', promo_code=2 where id='" . $_SESSION['player'] . "'");
    echo json_encode("Você ganhou <img class='iprpImg' src='images/layout/IpPoints.png'> 1,000 IP!");
} else if ($promoCode == "lets_donate" and $promoCodeStats < 3) //ID 3
    {
    $rp     = getPlayerInfo($_SESSION['player'], "rp");
    $rp     = $rp + 1;
    $result = $db->query("update accounts set rp='" . $rp . "', promo_code=3 where id='" . $_SESSION['player'] . "'");
    echo json_encode("Você ganhou <img class='iprpImg' src='images/layout/RpPoints.png'> 1 RP!");
} else if ($promoCode == "I_W4NT_d0N4TiONz" and $promoCodeStats < 4) //ID 4
    {
    $ip     = getPlayerInfo($_SESSION['player'], "ip");
    $ip     = $ip + 150;
    $result = $db->query("update accounts set ip='" . $ip . "', promo_code=4 where id='" . $_SESSION['player'] . "'");
    echo json_encode("Você ganhou <img class='iprpImg' src='images/layout/IpPoints.png'> 150 IP!");
} else if ($promoCode == "PokEmoNGO" and $promoCodeStats < 5) //ID 5
    {
    $ip     = getPlayerInfo($_SESSION['player'], "ip");
    $ip     = $ip + 150;
    $result = $db->query("update accounts set ip='" . $ip . "', promo_code=5 where id='" . $_SESSION['player'] . "'");
    echo json_encode("Você ganhou <img class='iprpImg' src='images/layout/IpPoints.png'> 150 IP!");
} else {
    echo json_encode("Oops! Parece que esse código está incorreto ou não funciona mais!");
}

?>
