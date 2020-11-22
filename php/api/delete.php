<?php
    // 初期設定
    include '../functions.php';
    header("Content-type: application/json; charset=UTF-8");
    $con = connect();
    session_start();
    $status = -1;

    // 必要なデータを取得
    $param = json_decode(file_get_contents('php://input'), true);
    $me = array(
        'id' => $_SESSION['id'],
        'name' => $_SESSION['name']
    );
    // リクエストされたIDの記事の取得(存在確認)
    $sql = 'select user_id from articles where id = $1 ';
    $R = pg_query_params($con, $sql, array($param['articleId']));
    if ($R == false) {
        $status = -1;
        $result = array(
            'status' => $status
        );
        echo json_encode($result);
        exit;
    }
    $article = pg_fetch_array($R);

    // 対象の記事が自身の物か判定し、自分のものなら削除
    if ($article['user_id'] === $_SESSION['id']) {
        $sql = 'delete from articles where id = $1';
        $R = pg_query_params($con, $sql, array($param['articleId']));
        if ($R != false) {
            $status = 0;
        }
    }

    $result = array(
        'status' => $status,
    );
    echo json_encode($result);
    exit;
?>