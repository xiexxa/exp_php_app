<?php
  $title = 'Top Page';
  $is_login = false;
  include './php/functions.php';
  $con = connect();
  echo $_SESSION['name'];
  session_start();
  $is_login = login_checker($is_login);
?>
  </select>
<html>
  <?php include './php/head.php' ?>
  <body>
    <?php include './php/navbar.php' ?>
    <?php 
      if ($is_login == true) {
        include './php/index/home.php';
      } else {
        include './php/index/guest.php';
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
    sayHello() {
      this.msg = 'hello'
    }
  },
  mounted () {

  }
});
</script>