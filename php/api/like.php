<?php
    // 初期設定
    include '../functions.php';
    header("Content-type: application/json; charset=UTF-8");
    $con = connect();
    session_start();
    $status = -1;

    // 必要なデータを取得
    $param = json_decode(file_get_contents('php://input'), true);
    $id = $param['id'];

    // すでにいいねしているか確認
    $sql = 'select id from likes where like_user_id = $1 and liked_article_id = $2';
    $R = pg_query_params($con, $sql, array($_SESSION['id'], $id));
    $n = pg_num_rows($R);
    if ($n > 0) {
        // いいね済み
        $sql = 'delete from likes where like_user_id = $1 and liked_article_id = $2';
        $R = pg_query_params($con, $sql, array($_SESSION['id'], $id));
        if ($R != false) {
            $status = 2;
        }
    } else {
        // まだいいねしていない
        $sql = 'insert into likes(like_user_id, liked_article_id, created_at, updated_at) values ($1, $2, $3, $4)';
        $R = pg_query_params(
            $con, $sql, 
            array(
                $_SESSION['id'], 
                $id, 
                date("Y-m-d H:i:s"), 
                date("Y-m-d H:i:s")
            )
        );
        if ($R != false) {
            // insertに成功したらステータスを0にする
            $status = 0;
        }
    }

    $result = array(
        'id' => $id,
        'status' => $status
    );
    echo json_encode($result);
?>