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
    /**
     * 同步提交增加或者修改平台
     */
    function addOrUpdate(){
        $data=$this->platformMode->create();
        if($data["pId"] < 0){//增加客户信息
            $this->platformMode->field("pPosition,pIsUsed")->add($data);
    
        }else{//修改客户信息
            $this->platformMode->field("pPosition,pIsUsed")->where("pId='%d'",$data["pId"])->save();
        }
        $this->loadPlatform();
    }
    
    /**
     * 分页加载平台信息
     */
    public function loadPlatform($pageNo=1,$pageSize=2,$pId=0){
        if($pId==0){//$pId没传值
            //总数量
            $total=$this->platformMode->count();
            //当前页的数据
            $rows=$this->platformMode->page($pageNo,$pageSize)->order("pId desc")->select();
            $page=array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
            $this->assign("BASEPATH",BASEPATH);//保存数据方便页面使用
            $this->assign("Platforms",$page);//保存数据方便页面使用
            $this->display("platformShow"); 
        }else {//$pId传值通过id查询一条数据
            $data=$this->platformMode->find($pId);
            $this->ajaxReturn($data);
        }
    }
    
    /**
     * 收索平台
     */
    public function searchPlatform($pageNo=1,$pageSize=2,$pPosition){
       
        $query="1=1 ";
        if($pPosition!=null && $pPosition !=""){
            $query .="and pPosition LIKE '%$pPosition%'";
        }
        //总数量
        $total=$this->platformMode->where($query)->count();
        //当前页的数据
        $rows=$this->platformMode->where($query)->page($pageNo,$pageSize)->order("pId desc")->select();
        $page=array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
        
        $this->assign("BASEPATH",BASEPATH);
        $this->assign("Platforms",$page);//保存数据方便页面使用
        $this->display("platformShow"); 
    }
}

?>