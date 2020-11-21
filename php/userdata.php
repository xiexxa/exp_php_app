<article class="media">
    <figure class="media-left">
        <p class="image is-32x32">
        <img src="https://via.placeholder.com/32" alt="">
        </p>
    </figure>
    <div class="media-content">
        <div class="content">
        <a class="has-text-black" href="user.php?name=<?php xss($user['name']) ?>"><span class="has-text-weight-bold"><?php xss($user['name']) ?></span><span>@<?php xss($user['screen_name']) ?></span></a>
        </div>
    </div>
</article>