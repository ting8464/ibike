<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;
class PlatformController extends Controller{
    private $platformMode;
    public function __construct(){
        parent::__construct();
        $this->platformMode=new Model("tb_platform");
    }
    
    /**
     * 添加平台
     * @param unknown $pPosition 
     * @param unknown $pIsUsed
     */
    public  function  addPlatform($pPosition,$pIsUsed){
        $array=array(
            "pPosition"=>$pPosition,
            "pIsUsed"=>$pIsUsed
        );
        $result=$this->platformMode->add($array);
        $this->assign("result",$result);
       // $this->display("");//跳转页面
    }
}

?>