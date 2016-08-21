<?php
include "dbClass.php";
$db        = new Db();
$name      = htmlspecialchars($_POST['username'], ENT_QUOTES);
$email     = htmlspecialchars($_POST['email'], ENT_QUOTES);
$password  = md5($_POST['password']);
$password2 = md5($_POST['password2']);

$rows = $db->select("select * from accounts where username='" . $name . "'");
if ($rows)
  {
    echo json_encode("0");
  }
else
  {
    $rows = $db->select("select * from accounts where email='" . $email . "'");
    if ($rows)
      {
        echo json_encode("0");
      }
    else
      {
        $result = $db->query("insert into accounts (username, password, email) values ('" . $name . "', '" . $password2 . "', '" . $email . "') ");
      echo json_encode("1");
      }
  }

?>
