<nav class='navbar' id="navbar">
    <div class='navbar-brand'>
    <div class=' navbar-item is-hidden-desktop'>
        <p>menu</p>
    </div>
    <a href="." class='navbar-item'><h3 class='is-size-4'>Title</h3></a>
    </div>
    <div class='navbar-end is-hidden-touch'>
        <?php if (!empty($_SESSION)) : ?>
        <div class="navbar-item">
            <form class="field has-addons" method="get" action="./search.php" style="margin: 0">
                <div class="control">
                    <input type="text" :class='[searchboxOverFlag === true ? "input is-hovered" : "input is-light"]' placeholder="検索ワードを入力" name="w" value="<?php echo $_GET['w'] ?>" v-on:mouseover="searchboxOver" v-on:mouseleave="searchboxOver">
                </div>
                <div class="control">
                    <input type="submit" class="button is-link is-light" value="検索">
                </div>
            </form>
        </div>
        <div class='navbar-item'>
            <div class='buttons'>
            <a class='button is-light' @click="clickNewPost">
                <span class="icon is-medium has-text-ghost">
                    <i class="fas fa-pen-nib"></i>
                </span>
                <span>新規投稿</span>
            </a>
            <div :class='[newPostModal === true ? "modal" : "modal is-active"]'>
                <div class="modal-background" @click="clickNewPost"></div>
                <form action="php/newpost.php" method="post" class="modal-card">
                    <div class="modal-card-head">
                        <span class="icon is-medium has-text-ghost">
                            <i class="fas fa-pen-nib"></i>
                        </span>
                        <p>新規投稿</p>
                    </div>
                    <div class="modal-card-body">
                        <textarea v-model.trim="newText" class="textarea" name="body" id=""></textarea>
                        <p>{{newText.length}}/140</p>
                    </div>
                    <div class="modal-card-foot">
                        <input type="submit" class='button is-info' value="投稿する" v-bind:disabled="!cantSend"></input>
                    </div>
                </form>
                <button class="modal-close is-large" aria-label="close" @click="clickNewPost"></button>
                </div>
            </div>
        </div>
        <?php endif ?>
    </div>
</nav>

<script>
new Vue({
    el: '#navbar',
    data: {
        newPostModal: true,
        newText: '',
        cantSend: false,
        searchboxOverFlag: false
    },
    methods: {
        clickNewPost: function () {
            this.newPostModal = !this.newPostModal
        },
        searchboxOver: function () {
            this.searchboxOverFlag = !this.searchboxOverFlag
        }
    },
    watch: {
        newText: function () {
            console.log(this.newText.length)
            if (this.newText.length > 140 || this.newText.length <= 0) {
                this.cantSend = false
            }
            if (this.newText.length > 0 && this.newText.length <= 140) {
                this.cantSend = true
            }
        }
    }
})
</script>