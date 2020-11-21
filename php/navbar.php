<nav class='navbar' id="navbar">
    <div class='navbar-brand'>
    <div class=' navbar-item is-hidden-desktop'>
        <p>menu</p>
    </div>
    <a href="." class='navbar-item'><h3 class='is-size-4'>Title</h3></a>
    </div>
    <div class='navbar-end is-hidden-touch'>
    <div class='navbar-item'>
        <div class='buttons'>
        <a class='button is-light' @click="clickNewPost">新規投稿</a>
        <div :class='[newPostModal === true ? "modal" : "modal is-active"]'>
            <div class="modal-background" @click="clickNewPost"></div>
            <form action="php/newpost.php" method="post" class="modal-card">
                <div class="modal-card-head">
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
    </div>
</nav>

<script>
new Vue({
    el: '#navbar',
    data: {
        newPostModal: true,
        newText: '',
        cantSend: false
    },
    methods: {
        clickNewPost: function () {
            this.newPostModal = !this.newPostModal
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