<?php
  $title = $_GET['w'];
  $is_login = false;
  include './php/functions.php';
  $con = connect();
  session_start();
  $is_login = login_checker($is_login);
?>

<?php
    $sql = 'select id, body, user_id, created_at from articles where body like $1 order by id desc';
    if ($_GET['order'] === 'old') {
        $sql = 'select id, body, user_id, created_at from articles where body like $1';
    }
    $R = pg_query_params($con, $sql, array('%'.$_GET['w'].'%'));
    $search_result_count = pg_num_rows($R);
    for ($i=0; $i<$search_result_count; $i++) {
        $articles[] = pg_fetch_array($R, $i);
    }
?>
  </select>
<html>
  <?php include './php/head.php' ?>
  <body>
    <?php include './php/navbar.php' ?>
    <?php 
      if ($is_login == true) {
        include './php/search/result.php';
      } else {
        redirect('index.php');
      }
    ?>
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
  el: "#app",
  data: {
    msg: "Welcome"
  },
  methods: {
  },
  mounted () {

  }
});
</script>