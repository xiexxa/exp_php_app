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
  $sql = 'select id, body, user_id, created_at from articles where user_id = $1';
  $R = pg_query_params($con, $sql, array($user['id']));  
  $n = pg_num_rows($R);
  echo $n;
  for ($i=$n-1; $i>=0; $i--) {
    $articles[] = pg_fetch_array($R, $i);
  }
  var_dump($articles);
?>

<?php
// フォロー数を取得する
$sql = 'select count(*) from follows where follow_user_id = $1';
$R = pg_query_params($con, $sql, array($user['id']));
$follow_count = pg_fetch_array($R);
echo 'フォロー数';
echo $follow_count[0];
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
                    <button class="button" ref="focusFollowButton" value="<?php echo xss($user['name']) ?>" @click="sendFollowRequest">follow</button>
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
              <!-- article -->
              <?php foreach ($articles as $article) : ?>
                <?php include './php/article.php' ?>
              <?php  endforeach; ?>
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