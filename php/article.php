<?php
$id = $article['user_id'];
$sql = 'select name, screen_name from users where id = $1';
$R = pg_query_params($con, $sql, array($id));  
$usernames = pg_fetch_array($R); 

// いいね済みかどうか
$sql = 'select id from likes where like_user_id = $1 and liked_article_id = $2';
$R = pg_query_params($con, $sql, array($_SESSION['id'], $article['id']));
$n = pg_num_rows($R);

// いいねの数
$sql = 'select count(*) from likes where liked_article_id = $1';
$R = pg_query_params($con, $sql, array($article['id']));
$like_count = pg_fetch_array($R); 
?>

<article class="media" ref="<?php echo $article['id'] ?>">
    <figure class="media-left">
        <p class="image is-32x32">
        <a href="user.php?name=<?php xss($usernames['name']) ?>"><img src="./img/icon.png" alt=""></a>
        </p>
    </figure>
    <div class="media-content">
        <div class="content">
        <a class="has-text-black" href="user.php?name=<?php xss($usernames['name']) ?>"><span class="has-text-weight-bold"><?php xss($usernames['screen_name']) ?></span><span>@<?php xss($usernames['name']) ?></span></a>
        <p><?php xss($article['body']) ?></p>
        </div>
        <nav class="level is-mobile">
        <div class="level-left">
            <a class="level-item" @click="like(<?php echo $article['id'] ?>)">
                <?php if ($n > 0) : ?>
                <span class="icon is-medium has-text-dark">
                    <i class="fas fa-heart" style="color: coral"></i>
                </span>
                <?php else : ?>
                <span class="icon is-medium has-text-dark">
                <i class="far fa-heart"></i>
                </span>
                <?php endif ?>
                <span><?php echo $like_count['count'] ?></span>
            </a>
        </div>
        <div class="level-right">
            <span class="is-size-7"><?php echo dateformat($article['created_at']) ?></span>
            <?php if ($article['user_id'] === $_SESSION['id']) : ?>
            <a class="icon is-medium has-text-dark" @click="deleteModalOpen(<?php echo $article['id'] ?>)">
                <i class="fas fa-trash"></i>
            </a>
            <?php endif; ?>
        </div>
        </nav>
    </div>
</article>