<?php
function session_init () {
  session_start();
  $_SESSION['id'] = $user['id'];
  $_SESSION['name'] = $user['name'];
  $_SESSION['screen_name'] = $user['screen_name'];
  $_SESSION['email'] = $user['email'];
}

function connect() {
  $con = pg_connect("dbname='www' user='apache' password='password'");
}

function redirect($page) {
  header('Location: '.$page);
  exit();
}
?>