<?php
  $title = 'Top Page';
  include './php/functions.php';
  connect();
?>
  </select>
<html>
  <?php include './php/head.php' ?>
  <body>
    <?php include './php/navbar.php' ?>
    <div class='hero is-info is-bold'>
      <div class='container'>
        <div class='hero-body'>
          <h1 class='title'>Title</h1>
          <div class='level'>
            <div class='level-item'>
              <a href="login.php" class='button is-large is-info is-inverted is-outlined'>Login</a>
            </div>
            <div class='level-item'>
              <a href="signup.php" class='button is-large is-info is-inverted'>Sign up</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include './php/footer.php' ?>
  </body>
</html>
<?php
pg_free_result($R);
pg_close($con);
?>