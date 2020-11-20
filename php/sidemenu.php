<div class="column is-3">
    <menu class="is-hidden-touch" id="sidemenu">
        <div class="hero is-info">
        <div class="hero-body">
            <article class="media">
            <figure class="media-left">
                <p class="image is-32x32">
                <img src="https://via.placeholder.com/32" alt="">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                <span>sc_name</span>
                <span>@name</span>
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
                <p class="subtitle">10</p>
            </div>
            </div>
            <div class="level-item has-text-centered">
            <div>
                <p class="heading">Followers</p>
                <p class="subtitle">10</p>
            </div>
            </div>
        </div>
        </div>
        <p class="menu-label">Menu</p>
        <ul class="menu-list">
        <li><a href="user.php">My Page</a></li>
        <li><a href="">Notifications</a></li>
        <li><a href="">Settings</a></li>
        <li @click="clickLogout"><a>Logout</a></li>
        <div :class='[logoutModal === true ? "modal" : "modal is-active"]'>
            <div class="modal-background" @click="clickLogout"></div>
            <div class="modal-card">
                <div class="modal-card-head">
                    <p>ログアウト</p>
                </div>
                <div class="modal-card-body">
                    <span>
                        ログアウトしますか？
                    </span>
                </div>
                <div class="modal-card-foot">
                    <button class="button" @click="clickLogout">Cancel</button>
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