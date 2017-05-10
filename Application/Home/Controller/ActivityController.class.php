<?php

namespace Home\Controller;
session_start();
/*
 *活动处理类 
 */
use Think\Controller;
use Think\Model;
class ActivityController extends Controller{
    private $platformMode;
    public function __construct(){
        Parent::__construct();
        $this->platformMode=new Model("tb_terraceactivi");
    }
    
    
    /**
     * 新增平台加盟活动
     */
    public function addPlatformActivity(){
        $data=$this->platformMode->create();
        $r=$this->platformMode->field("tname,tstarttime,tendtime,tcontent")->add($data);
        $this->assign("BASEPATH",BASEPATH);
        if($r != null || $r != ""){$_SESSION["hint"]="添加成功";}
        $this->display("addActivity");
    }
}

?>