<?php
  $title = 'Sign up'
?>
<html>
  <?php include './php/head.php' ?>
  <body>
    <?php include './php/navbar.php' ?>
    <div class='hero is-info is-bold'>
      <div class='container'>
        <div class='hero-body'>
          <h1 class='title'>Sign up</h1>
          <div class='notification has-background-white'>
            <div class='content'>
                <div class='field'>
                    <label class='label has-text-info-dark'>email</h2>
                    <input type="email" name='email' class='input' placeholder='name@example.com'>
                </div>
                <div class='field'>
                    <label class='label has-text-info-dark'>Password</h2>
                    <input type="password" name='password' class='input'>
                    <label for="password" class='is-7 has-text-grey-dark has-text-weight-normal	'>半角英数を含む8文字以上</label>
                </div>
                <div class='field'>
                    <label class='label has-text-info-dark'>Re-type Password</h2>
                    <input type="password" name='password-confirm' class='input'>
                </div>
                <div class='field'>
                    <div class='level'>
                        <div class='level-left'></div>
                        <div class='level-right'>
                            <input type="submit" class='button is-info' value='Sign up'>
                        </div>
                    </div>
                </div>
                <span class='has-text-grey-dark'>登録済みの方は<a href="login.php" class='has-text-link'>こちら</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include './php/footer.php' ?>
  </body>
</html>