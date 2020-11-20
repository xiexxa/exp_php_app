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
    $other = getNameToUserData($con, $param['name']);
    
    // 自分自身をフォローできなくする
    if ($me['name'] == $other['name']) {
        $result = array(
            'status' => $status
        );
        echo json_encode($result);
        exit;
    }
    
    // 既にフォロー関係にあるかチェック
    $sql = 'select id from follows where follow_user_id = $1 and followed_user_id = $2';
    $R = pg_query_params($con, $sql, array($me['id'], $other['id']));
    $n = pg_num_rows($R);

    // フォローしていなかったら、フォローする
    if ($n == 0) {
        $sql = 'insert into follows(follow_user_id, followed_user_id, created_at, updated_at) values ($1, $2, $3, $4)';
        $R = pg_query_params(
            $con, $sql, 
            array(
                $me['id'], 
                $other['id'], 
                date("Y-m-d H:i:s"), 
                date("Y-m-d H:i:s")
            )
        );
        if ($R != false) {
            $status = 0;
        }
    }

    // フォロー済だったらリムーブする
    if ($n >= 1) {
        $sql = 'delete from follows where follow_user_id = $1 and followed_user_id = $2';
        $R = pg_query_params(
            $con, $sql,
            array(
                $me['id'], 
                $other['id']
            )
        );
        if ($R != false) {
            $status = 0;
        }
    }

    $result = array(
        'status' => $status,
        'other' => $R
    );
    echo json_encode($result);
    exit;
?>