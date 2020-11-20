<?php
  $title = 'Top Page';
  $is_login = false;
  include './php/functions.php';
  $con = connect();
  echo $_SESSION['name'];
  session_start();
  $is_login = login_checker($is_login);
?>

<?php
  $sql = 'select name, screen_name from users where name = $1';
  $R = pg_query_params($con, $sql, array($_GET['name']));
  $user = pg_fetch_array($R);
  var_dump($user);
  xss($user['name'])
?>
  </select>
<html>
  <?php include './php/head.php' ?>
  <body>
    <?php include './php/navbar.php' ?>
    
    <div class='has-background-light'>
      <div class='container has-background-white'>
        <div class="columns">
          <?php include './php/sidemenu.php'; ?>
          <div class="column is-7">
            <?php // ----- User.php body ----- ?>
            <div class="hero is-info is-bold">
              <div class="hero-body">
                <div class="container">
                  <p class="title">User name</p>
                  <p class="subtitle">@ID</p>
                </div>
              </div>
            </div>
            <div class="level">
            <div class="level-left"></div>
              <div class="level-right">
                <a class="level-item" href="">
                  <p class="heading">Follow</p>
                  <p class="subtitle">10</p>
                </a>
                <a class="level-item" href="">
                  <p class="heading">Follower</p>
                  <p class="subtitle">10</p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include './php/footer.php' ?>
    <div id="app">
      <p>{{msg}}</p>
    </div>
  </body>
</html>
<?php
pg_free_result($R);
pg_close($con);
?>