<?php
    $is_login = false;
    include './functions.php';
    $con = connect();
    session_start();
    $is_login = login_checker($is_login);

    $sql = "insert into articles(body, user_id, created_at, updated_at) values ($1, $2, $3, $4)";
    $R = pg_query_params(
        $con, $sql, 
        array(
        $_POST['body'], 
        $_SESSION['id'], 
        date("Y-m-d H:i:s"), 
        date("Y-m-d H:i:s")
        )
    );
    redirect('../index.php');
?>