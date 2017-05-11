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
        $this->display("addActivity");
    }
    
    /**
     * 展示活动页面
     */
    public function showActivity(){
        $this->assign("BASEPATH",BASEPATH);
        $this->display("showActivity");
    }
    
    /**
     * 展示添加平台活动
     */
    public function showAddPlatformActicity($pageNo = 1,$pageSize = 5){
        //总数量
        $total=$this->platformMode->count();
        //当前页的数据
        $rows=$this->platformMode->page($pageNo,$pageSize)->order("tid desc")->select();
        $platformActivity=array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
        
        $this->assign("platformActivity",$platformActivity);
        $this->assign("BASEPATH",BASEPATH);
        $this->display("showAddPlatformActicity");
    }
    
    /**
     * 收索平台加盟活动
     */
    public function searchPlatformActivity($pageNo = 1,$pageSize = 5,$searchJoinway = null,$searchBenefit = null){
        $query="1=1 ";
        if($searchJoinway != null && $searchJoinway != ""){
            $query .="and tname like '%$searchJoinway%'";
        }
        if($searchBenefit != null && $searchBenefit != ""){
            $query .="and tcontent like '%$searchBenefit%'";
        }
        
        //总数量
        $total=$this->platformMode->where($query)->count();
        //当前页的数据
        $rows=$this->platformMode->page($pageNo,$pageSize)->where($query)->order("tid desc")->select();
        $platformActivity=array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
        
        $this->assign("platformActivity",$platformActivity);
        $this->assign("BASEPATH",BASEPATH);
        $this->display("showAddPlatformActicity");
    }
    
    
}

?>