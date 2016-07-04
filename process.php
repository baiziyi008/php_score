<?php
require_once './common.php';

class Process extends Common
{

    public function work()
    {
        $this->check();
        $appid = $this->param['app_id'];
        $action = $this->param['action'];
        $requestScore = $this->param['score'];
        
        $scoreArray = $this->getScore($appid);
        $score = $scoreArray['score'];
        echo "appid=".$appid."  score=".$score."\n";
        
        if (!is_numeric($requestScore)){
            Response::show(405, "增加积分参数错误");
            exit;
        }
        if ($action == 'add') {
            $this->addScore($appid, $requestScore);
        } elseif ($action == 'use') {
            if ($requestScore > $score){
                Response::show(406, "消耗积分参数错误，积分不足");
                exit;
            }
                
            $this->useScore($appid, $requestScore);
        }else {
        }
        
        Response::show(200, "操作积分成功", $this->getScore($appid));
    }
}

$process = new Process();
$process->work();