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
  $sql = 'select id, body, user_id, created_at from articles where user_id = $1';
  $R = pg_query_params($con, $sql, array($user['id']));  
  $n = pg_num_rows($R);
  echo $n;
  for ($i=$n-1; $i>=0; $i--) {
    $articles[] = pg_fetch_array($R, $i);
  }
?>

<?php
// フォロー数を取得する
$sql = 'select count(*) from follows where follow_user_id = $1';
$R = pg_query_params($con, $sql, array($user['id']));
$follow_count = pg_fetch_array($R);
$follow_count = $follow_count[0];
echo 'フォロー数';
echo $follow_count;
?>

<?php
// フォロワー数を取得する
$sql = 'select count(*) from follows where followed_user_id = $1';
$R = pg_query_params($con, $sql, array($user['id']));
$follower_count = pg_fetch_array($R);
$follower_count = $follower_count[0];
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
                  <a class="level-item" href="user.php?name=<?php echo xss($user['name']) ?>">
                    <p class="heading <?php empty($_GET['page']) ? print 'has-text-weight-bold' : print '' ?>">Post</p>
                    <p class="subtitle <?php empty($_GET['page']) ? print 'has-text-weight-bold' : print '' ?>"><?php echo xss($follow_count) ?></p>
                  </a>
                  <a class="level-item" href="user.php?name=<?php echo xss($user['name']) ?>&page=<?php echo 'follow' ?>">
                    <p class="heading <?php $_GET['page'] == 'follow' ? print 'has-text-weight-bold' : print '' ?>">Follow</p>
                    <p class="subtitle <?php $_GET['page'] == 'follow' ? print 'has-text-weight-bold' : print '' ?>"><?php echo xss($follow_count) ?></p>
                  </a>
                  <a class="level-item" href="user.php?name=<?php echo xss($user['name']) ?>&page=<?php echo 'follower' ?>">
                    <p class="heading <?php $_GET['page'] == 'follower' ? print 'has-text-weight-bold' : print '' ?>">Follower</p>
                    <p class="subtitle <?php $_GET['page'] == 'follower' ? print 'has-text-weight-bold' : print '' ?>"><?php echo xss($follower_count) ?></p>
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
              <?php elseif ($_GET['page'] == 'follower') : ?>
                <p>フォロワー一蘭</p>
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