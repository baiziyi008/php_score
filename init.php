<?php
error_reporting(0);
require_once './common.php';
class Init extends Common{
    public function index() {
        $this->check();
        $newID = $this->param['app_id'];
        $app = $this->getApp($newID);
        if (!$app) {
            $newID = $this->setApp($this->param['did']);
            $this->initScore($newID);
        }
        $score = $this->getScore($newID);
        Response::show(200, "获取数据成功", $score);
    }
}

$init = new Init();
$init->index();
//var_dump($_SERVER);