<?php
require_once './response.php';
require_once './db.php';
class Common{
    public $param;
    public $app;
    public function check() {
        $data = file_get_contents('php://input');

        if ($data == '') {
            return Response::show(402, '数据格式不合法');
        }
        $jsonStr = json_decode($data, true);
        if (!is_array($jsonStr)) {
            return Response::show(403, '数据格式不合法');
        }

        $this->param['app_id'] = $app_id = isset($jsonStr['app_id']) ? $jsonStr['app_id'] : '';
        $this->param['did'] = $did= isset($jsonStr['did']) ? $jsonStr['did'] : '';
        $this->param['encrypt_did'] = $encrypt_did= isset($jsonStr['encrypt_did']) ? $jsonStr['encrypt_did'] : '';
        
        $this->param['action'] = $action = isset($jsonStr['action']) ? $jsonStr['action'] : '';
        $this->param['score'] = $score = isset($jsonStr['score']) ? $jsonStr['score'] : '';
        if (!is_numeric($app_id)) {
            return Response::show(401, '数据不合法');
        }
        
        
    }

    public function getApp($id)
    {
        $sql = "select * from `app` where `id`=" . $id . " and status=1 limit 1";
        $conn = Db::getInstance()->connect();
        
        $result = mysql_query($sql, $conn);
        return (mysql_fetch_assoc($result));
        exit;
    }
    
    public function setApp($did) {
        $sql = "insert into `app` (did, status) values(".$did.",1)";
        $conn = Db::getInstance()->connect();
        
        $result = mysql_query($sql, $conn);
        return (mysql_insert_id($conn));
        exit;
    }
    
    public function initScore($id){
        $sql = "insert into `score` (app_id,score)values(".$id.",500)";
        $conn = Db::getInstance()->connect();
        
        $result = mysql_query($sql, $conn);
        return(mysql_fetch_assoc($result));
        exit;
    }
    public function getScore($id) {
        $sql = "select app_id,score from score where app_id=".$id;
        $conn = Db::getInstance()->connect();
        
        $result = mysql_query($sql, $conn);
        return(mysql_fetch_assoc($result));
        exit;
    }
    
    public function addScore($id, $score) {
        $sql = "update score set score=score+".$score." where app_id=".$id;

        $conn = Db::getInstance()->connect();
        
        $result = mysql_query($sql, $conn);
        return(mysql_fetch_assoc($result));
        exit;
    }
    
    public function useScore($id, $score) {
        $sql = "update score set score=score-".$score." where app_id=".$id;
//         var_dump($sql);
//         exit;
        $conn = Db::getInstance()->connect();
        
        $result = mysql_query($sql, $conn);
        return(mysql_fetch_assoc($result));
        exit;
    }
}