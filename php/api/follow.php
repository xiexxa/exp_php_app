<?php
    $param = json_decode(file_get_contents('php://input'), true);
    if ($name == null) {
        $name = 'kinou';
    }
    $result = array(
        'name' => $param['name'],
        'hell' => 'hgj'
    );
    header("Content-type: application/json; charset=UTF-8");
    echo json_encode($result);
    exit;
?>