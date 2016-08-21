<?php
session_start();
include_once "dbClass.php";
include_once "getPlayerInfo.php";
$db    = new Db();
$user  = htmlspecialchars($_POST['user'], ENT_QUOTES);
$email = htmlspecialchars($_POST['email'], ENT_QUOTES);

$rows = $db->select("select * from accounts where username='" . $user . "' and email='" . $email . "'");
if ($rows)
  {
    foreach ($rows as $conta)
      {
        $newPass = rand(999, 9999999);
        $message = "Sua nova senha é: " . $newPass;
        mail($email, 'Teste', $message);
        $newPass = md5($newPass);
        $att = $db->query("update accounts set password='" . $newPass . "' where id='" . $conta['id'] . "'");
      echo json_encode("1");
      }
  }
else
  {
    echo json_encode("0");
  }
?>
