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
  $sql = 'select id, name, screen_name from users where name = $1';
  $R = pg_query_params($con, $sql, array($_GET['name']));
  $user = pg_fetch_array($R);
?>

<?php
  $sql = 'select id, body, created_at from articles where user_id = $1';
  $R = pg_query_params($con, $sql, array($user['id']));  
  $n = pg_num_rows($R);
  echo $n;
  for ($i=0; $i<$n; $i++) {
    $articles = pg_fetch_array($R, $i); 
    echo '<p>';
    var_dump($articles);
    echo '</p>';
  }
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
            <?php if (!empty($user)) : ?>
              <div class="hero is-info is-bold">
                <div class="hero-body">
                  <div class="container">
                    <p class="title"><?php xss($user['screen_name']) ?></p>
                    <p class="subtitle">@<?php xss($user['name']) ?></p>
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
            <?php else: ?>
            <div class="notification is-danger">
              <p>そのようなユーザは存在しません。</p>
            </div>
            <?php endif; ?>
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