<?php

require_once './common.php';
class Init extends Common{
    public function index() {
        $this->check();
        $app = $this->getApp($this->param['app_id']);
        if (!$app) {
            $this->setApp($this->param['did']);
            $this->initScore($this->param['app_id']);
        }
        $score = $this->getScore($this->param['app_id']);
        Response::show(200, "获取数据成功", $score);
    }
}

$init = new Init();
$init->index();
//var_dump($_SERVER);