<?php
    $result = array('mes' => 'messssss');
    header("Content-type: application/json; charset=UTF-8");
    echo json_encode($result);
    exit;
?>