<?php
  $title = 'Login';
  $is_login = false;
  include './php/functions.php';

  $con = connect();
  $sql = 'select * from users where email = $1';
  $R = pg_query_params($con, $sql, array($_POST['email']));
  $user = pg_fetch_array($R);

  if ( password_verify($_POST['password'], $user['password']) ) {
    // 認証成功
    session_start();
    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['screen_name'] = $user['screen_name'];
    $_SESSION['email'] = $user['email'];
    redirect('index.php');
  } else {
    // 認証失敗
  }
?>
<html>
  <?php include './php/head.php' ?>
  <body>
    <?php include './php/navbar.php' ?>
    <div class='hero is-info is-bold'>
      <div class='container'>
        <div class='hero-body'>
          <h1 class='title'>Login</h1>
          <div class='notification has-background-white'>
            <form action="login.php" method='post'>
              <div class='content'>
                  <div class='field'>
                      <label class='label has-text-info-dark'>email</h2>
                      <input type="email" name='email' class='input' placeholder='name@example.com'>
                  </div>
                  <div class='field'>
                      <label class='label has-text-info-dark'>Password</h2>
                      <input type="password" name='password' class='input'>
                  </div>
                  <div class='field'>
                      <div class='level'>
                          <div class='level-left'></div>
                          <div class='level-right'>
                              <input type="submit" class='button is-info' value='Login'>
                          </div>
                      </div>
                  </div>
                  <span class='has-text-grey-dark'>未登録の方は<a href="signup.php" class='has-text-link'>こちら</a></span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include './php/footer.php' ?>
  </body>
</html>