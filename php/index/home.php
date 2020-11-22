<?php
// フォロー中のユーザ一覧を取得
$sql = 'select users.id, name from follows inner join users on follows.followed_user_id = users.id where follow_user_id = $1';
$R = pg_query_params($con, $sql, array($_SESSION['id']));
$n = pg_num_rows($R);
for ($i=$n-1; $i>=0; $i--) {
  $users[] = pg_fetch_array($R, $i);
}
?>

<?php
// $usersが投稿した記事を取得
$following_user_ids = '(';
foreach ($users as $user) {
  $following_user_ids = $following_user_ids . $user['id'];
  if ($user != end($users)) {
    $following_user_ids = $following_user_ids . ', ';
  }
}
$following_user_ids = $following_user_ids.')';
$sql = "select articles.id, body, user_id, articles.created_at, name, screen_name from articles inner join users on articles.user_id = users.id where user_id in $following_user_ids order by articles.id desc";
$R = pg_query($con, $sql);
$n = pg_num_rows($R);
for ($i=0; $i<$n; $i++) {
  $articles[] = pg_fetch_array($R, $i);
}
?>

<div class='has-background-light'>
  <div class='container has-background-white'>
    <div class="columns">
      <?php include './php/sidemenu.php'; ?>
      <div class="column is-7">
        <p>Main</p>
        <?php foreach ($articles as $article) : ?>
          <?php include './php/article.php' ?>
        <?php  endforeach; ?>
      </div>
    </div>
  </div>
</div>