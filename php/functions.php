<?php
function session_init () {
  //session_start();
  $_SESSION['id'] = $user['id'];
  $_SESSION['name'] = $user['name'];
  $_SESSION['screen_name'] = $user['screen_name'];
  $_SESSION['email'] = $user['email'];
}

function connect() {
  $con = pg_connect("dbname='www' user='apache' password='password'");
  return $con;
}

function redirect($page) {
  header('Location: '.$page);
  exit();
}

function login_checker($is_login) {
  if ( !empty($_SESSION) ) {
    $is_login = true;
  }
  return $is_login;
}

function xss($s) {
  echo htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function dateformat($time) {
  $datetime = new DateTime($time);
  return $datetime->format('Y年m月d日 H:i:s');
}

function getNameToUserData($con, $name) {
  $sql = 'select id, name, screen_name from users where name = $1';
  $R = pg_query_params($con, $sql, array($name));
  $user = pg_fetch_array($R);
  return $user;
}
?>