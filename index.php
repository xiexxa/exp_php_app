<?php
  $title = 'Top Page';
  $is_login = false;
  include './php/functions.php';
  $con = connect();
  echo $_SESSION['name'];
  session_start();
  if ( !empty($_SESSION) ) {
    $is_login = true;
  }
?>
  </select>
<html>
  <?php include './php/head.php' ?>
  <body>
    <?php include './php/navbar.php' ?>
    <?php 
      if ($is_login == true) {

      } else {
        include './php/index/guest.php';
      }
    ?>
    <?php include './php/footer.php' ?>
  </body>
</html>
<?php
pg_free_result($R);
pg_close($con);
?>