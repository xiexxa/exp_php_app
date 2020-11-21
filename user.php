<?php
  $title = 'Top Page';
  $is_login = false;
  include './php/functions.php';
  $con = connect();
  session_start();
  $is_login = login_checker($is_login);
?>

<?php
  $user = getNameToUserData($con, $_GET['name']);

  $is_follow = false;
  if ($_SESSION['id'] == $user['id']) {
    $is_follow = 'me';
  }
  $sql = 'select id from follows where follow_user_id = $1 and followed_user_id = $2';
  $R = pg_query_params(
    $con, $sql,
    array(
      $_SESSION['id'],
      $user['id']
    )
  );
  $n = pg_num_rows($R);
  if ($n >= 1) {
    $is_follow = true;
  }
?>

<?php
  if (empty($_GET['page'])) {
    // 投稿一覧を取得する
    $sql = 'select id, body, user_id, created_at from articles where user_id = $1';
    $R = pg_query_params($con, $sql, array($user['id']));  
    $n = pg_num_rows($R);
    echo $n;
    for ($i=$n-1; $i>=0; $i--) {
      $articles[] = pg_fetch_array($R, $i);
    }
  }
  if ($_GET['page'] == 'follow') {
    // フォローしているユーザ一覧を取得する
    $sql = 'select name, screen_name from follows inner join users on follows.followed_user_id = users.id where follow_user_id = $1';
    $R = pg_query_params($con, $sql, array($user['id']));
    $n = pg_num_rows($R);
    for ($i=0; $i<$n; $i++) {
      $follows[] = pg_fetch_array($R, $i);
    }
    var_dump($follows);
  }
  if ($_GET['page'] == 'follower') {
    // フォローされているユーザ一覧を取得する
    $sql = 'select name, screen_name from follows inner join users on follows.follow_user_id = users.id where followed_user_id = $1';
    $R = pg_query_params($con, $sql, array($user['id']));
    $n = pg_num_rows($R);
    for ($i=0; $i<$n; $i++) {
      $followers[] = pg_fetch_array($R, $i);
    }
  }
  
?>

<?php
// フォロー数を取得する
$follow_count = getFollowCount($con, $user['id']);
?>

<?php
// フォロワー数を取得する
$follower_count = getFollowerCount($con, $user['id']);
?>

<?php
// 投稿数を取得する
$sql = 'select count(*) from articles where user_id = $1';
$R = pg_query_params($con, $sql, array($user['id']));
$article_count = pg_fetch_array($R);
$article_count = $article_count[0];
?>
<html>
  <?php include './php/head.php' ?>
  <body>
    <?php include './php/navbar.php' ?>
    
    <div class='has-background-light'>
      <div class='container has-background-white'>
        <div class="columns">
          <?php include './php/sidemenu.php'; ?>
          <div class="column is-7" id="user">
            <?php // ----- User.php body ----- ?>
            <?php if (!empty($user)) : ?>
              <div class="hero is-info is-bold">
                <div class="hero-body">
                  <div class="container">
                    <p class="title"><?php xss($user['screen_name']) ?></p>
                    <p class="subtitle">@<?php xss($user['name']) ?></p>
                    <?php if ($is_follow === true) : ?>
                      <button class="button is-info" ref="focusFollowButton" value="<?php echo xss($user['name']) ?>" @click="sendFollowRequest">フォロー中</button>
                    <?php elseif ($is_follow == 'me') : ?>
                    <?php else : ?>
                      <button class="button" ref="focusFollowButton" value="<?php echo xss($user['name']) ?>" @click="sendFollowRequest">フォローする</button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="level">
                <div class="level-left"></div>
                <div class="level-right">
                  <a class="level-item has-text-centered" href="user.php?name=<?php echo xss($user['name']) ?>">
                    <div>
                      <p class="heading <?php empty($_GET['page']) ? print 'has-text-weight-bold' : print '' ?>">Post</p>
                      <p class="subtitle <?php empty($_GET['page']) ? print 'has-text-weight-bold' : print '' ?>"><?php echo xss($article_count) ?></p>
                    </div>
                  </a>
                  <a class="level-item has-text-centered" href="user.php?name=<?php echo xss($user['name']) ?>&page=<?php echo 'follow' ?>">
                    <div>
                      <p class="heading <?php $_GET['page'] == 'follow' ? print 'has-text-weight-bold' : print '' ?>">Follow</p>
                      <p class="subtitle <?php $_GET['page'] == 'follow' ? print 'has-text-weight-bold' : print '' ?>"><?php echo xss($follow_count) ?></p>
                    </div>
                  </a>
                  <a class="level-item has-text-centered" href="user.php?name=<?php echo xss($user['name']) ?>&page=<?php echo 'follower' ?>">
                    <div>
                      <p class="heading <?php $_GET['page'] == 'follower' ? print 'has-text-weight-bold' : print '' ?>">Follower</p>
                      <p class="subtitle <?php $_GET['page'] == 'follower' ? print 'has-text-weight-bold' : print '' ?>"><?php echo xss($follower_count) ?></p>
                    </div>
                  </a>
                </div>
              </div>
              <?php if (empty($_GET['page'])) : ?>
                <!-- article -->
                <?php foreach ($articles as $article) : ?>
                  <?php include './php/article.php' ?>
                <?php  endforeach; ?>
              <?php elseif ($_GET['page'] == 'follow') : ?>
                <p>フォロー一蘭</p>
                <?php  foreach ($follows as $user) :?>
                  <?php include './php/userdata.php' ?>
                <?php endforeach; ?>
              <?php elseif ($_GET['page'] == 'follower') : ?>
                <p>フォロワー一蘭</p>
                <?php  foreach ($followers as $user) :?>
                  <?php include './php/userdata.php' ?>
                <?php endforeach; ?>
              <?php endif; ?>
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

<script>
new Vue({
    el: '#user',
    data: {
        logoutModal: true,
    },
    methods:{
      sendFollowRequest: function () {
        let name = this.$refs.focusFollowButton.value
        console.log('name: :: '+name);
        axios.post('./php/api/follow.php', {
          name: name
        })
          .then(res => {
            console.log('Ajax受信')
            console.log(res.data)
          })
      }
    }
})
</script>