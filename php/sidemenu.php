<?php
$my_follow_count = getFollowCount($con, $_SESSION['id']);
$my_follower_count = getFollowerCount($con, $_SESSION['id']);
?>
<div class="column is-3">
    <menu class="is-hidden-touch" id="sidemenu" style="margin: 0">
        <div class="hero is-info">
        <div class="hero-body">
            <article class="media">
            <figure class="media-left">
                <p class="image is-32x32">
                <img src="./img/icon.png" alt="">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                <span class="has-text-weight-bold"><?php xss($_SESSION['screen_name']) ?></span>
                <span>@<?php xss($_SESSION['name']) ?></span>
                </div>
            </div>
            </article>
        </div>
        </div>
        <div class="level">
        <div class="level-left">
            <div class="level-item has-text-centered">
            <div>
                <p class="heading">Follow</p>
                <p class="subtitle"><?php echo $my_follow_count ?></p>
            </div>
            </div>
            <div class="level-item has-text-centered">
            <div>
                <p class="heading">Follower</p>
                <p class="subtitle"><?php echo $my_follower_count ?></p>
            </div>
            </div>
        </div>
        </div>
        <p class="menu-label">Menu</p>
        <ul class="menu-list">
        <li><a href="user.php?name=<?php echo $_SESSION['name'] ?>" class="<?php $_GET['name'] == $_SESSION['name'] ? print 'is-active' : print '' ?>">My Page</a></li>
        <li><a href="notifications.php">Notifications</a></li>
        <li><a href="">Settings</a></li>
        <?php if ($is_login == true) : ?>
        <li @click="clickLogout"><a>Logout</a></li>
        <?php endif; ?>
        <div :class='[logoutModal === true ? "modal" : "modal is-active"]'>
            <div class="modal-background" @click="clickLogout"></div>
            <div class="modal-card">
                <div class="modal-card-head">
                    <span class="icon is-medium has-text-ghost">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                    <p>ログアウト</p>
                </div>
                <div class="modal-card-body">
                    <span>
                        ログアウトしますか？
                    </span>
                </div>
                <div class="modal-card-foot">
                    <button class="button is-ghost" @click="clickLogout">Cancel</button>
                    <a class="button is-danger" href="logout.php">Logout</a>
                </div>
            </div>
            <button class="modal-close is-large" aria-label="close" @click="clickLogout"></button>
        </div>
        </ul>
    </menu>
</div>

<script>
new Vue({
    el: '#sidemenu',
    data: {
        logoutModal: true
    },
    methods:{
        clickLogout: function () {
            this.logoutModal = !this.logoutModal
        }
    }
})
</script>