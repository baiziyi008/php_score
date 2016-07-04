<?php
    

    require_once './response.php';
    require_once './db.php';

    $arr = array(
        'id' => 1,
        'name' => 'singwa',
        'type' => array()
    );
    
    Response::show(200, "app_id不存在");
//     $conn = Db::getInstance()->connect();
    
//     $sql = "select * from emp";
//     $ret = mysql_query($sql, $conn);
//     var_dump($ret);