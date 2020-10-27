<?php
  $title = 'Login'
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
                <span class='has-text-grey-dark'>未登録の方は<a href="/signup.php" class='has-text-link'>こちら</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include './php/footer.php' ?>
  </body>
</html>