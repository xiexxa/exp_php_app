<div id="search">
  <div class='has-background-light'>
    <div class='container has-background-white'>
      <div class="columns">
        <?php include './php/sidemenu.php'; ?>
        <div class="column is-7">
          <div class="hero is-info is-bold">
              <div class="hero-body">
                  <div class="container">
                      <span class="subtitle"><span class="has-text-weight-bold"><?php xss($_GET['w']) ?></span>の検索結果</span>
                      <div><span class="has-text-weight-bold"><?php echo $search_result_count ?></span>件</div>
                  </div>
              </div>
          </div>
          <div class="tabs is-small is-boxed">
              <ul>
                  <li class="<?php empty($_GET['order']) ? print 'is-active' : '' ?>"><a href="search.php?w=<?php echo $_GET['w'] ?>">最新</a></li>
                  <li class="<?php $_GET['order'] === 'old' ? print 'is-active' : '' ?>"><a href="search.php?w=<?php echo $_GET['w'] ?>&order=old">古い順</a></li>
              </ul>
          </div>
          <?php foreach ($articles as $article) : ?>
              <?php include './php/article.php' ?>
          <?php  endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
new Vue({
  el: "#search",
  data: {
  },
  methods: {
    like: function (id) {
        console.log(id)
        axios.post('./php/api/like.php', {
          id: id
        })
          .then(res => {
            console.log(res.data)
            let id = res.data.id
            let status = res.data.status
            console.log(this.$refs[id])
            location.reload()
          })
      }
  },
  mounted () {

  }
});
</script>