<?php
require_once './response.php';
require_once './db.php';
class Common{
    public $param;
    public $app;
    public function check() {
        $this->param['app_id'] = $app_id = isset($_POST['app_id']) ? $_POST['app_id'] : '';
        $this->param['did'] = $did= isset($_POST['did']) ? $_POST['did'] : '';
        $this->param['encrypt_did'] = $encrypt_did= isset($_POST['encrypt_did']) ? $_POST['encrypt_did'] : '';
        
        $this->param['action'] = $action = isset($_POST['action']) ? $_POST['action'] : '';
        $this->param['score'] = $score = isset($_POST['score']) ? $_POST['score'] : '';
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
        return (mysql_fetch_assoc($result));
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
        $sql = "select score from score where app_id=".$id;
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