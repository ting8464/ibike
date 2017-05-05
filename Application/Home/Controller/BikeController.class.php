<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;

class BikeController extends Controller{
    private $bikeModel;
    
    /**
     * 构造方法
     */
    public function __construct(){
        parent::__construct();
        $this->bikeModel = new Model(tb_bike);
    }
    
    /**
     * 单车分页信息
     * @param number $pageNo
     * @param number $pageSize
     * @param unknown $bNo
     * @param unknown $bIsUsed
     * @param unknown $bState
     * @param unknown $bsetPosition
     */
    public function loadBikeByPage($pageNo = 1,$pageSize = 10,$bNo=null,$bIsUsed=null,$bState=null,$bsetPosition=null){
        $con = array();
        if($bNo != null && $bNo != ""){
            $con["bNo"] = array("like","%$bNo%");
        };
        if($bIsUsed != null && $bIsUsed != ""){
            $con["bIsUsed"] = array("EQ",$bIsUsed);
        };
        if($bState != null && $bState != ""){
            $con["bState"] = array("EQ",$bState);
        };
        if($bsetPosition != null && $bsetPosition != ""){
            $con["bSetPosition"] = array("EQ",$bsetPosition);
        };
//         print_r($con);
        $total = $this->bikeModel->where($con)->count();
        
        $pPosition = $this->bikeModel->table(tb_platform)->select();
        //->fetchSql(true)
        $rows = $this->bikeModel->table("tb_bike b1, tb_platform p1")->
        field("b1.bid,b1.bno,b1.bisused,b1.bstate,b1.bposition,b1.ballroute,p1.pposition")->where("b1.bsetposition = p1.pid")
        ->where($con)
        ->page($pageNo,$pageSize)->select();
        $page = array("total"=>$total, "rows"=>$rows, "pageNo"=>$pageNo, "pageSize"=>$pageSize);

        $this->assign("bNo",$bNo);
        
        $this->assign("bIsUsed",$bIsUsed);
        
        $this->assign("bState",$bState);
        
        $this->assign("bsetPosition",$bsetPosition);
        
        $this->assign("page",$page);

        $this->assign("BASEPATH",BASEPATH);
        
        $this->assign("pPosition",$pPosition);
//         print_r($page);
        $this->display("bikeInformationList");
    }
    
    /**
     * 修改单车状态
     * @param int $manage
     * @param array $selectedBike
     */
    public function changeBikeState($manage = null, $selectedBike = null){
        $data["bState"] = $manage;
        $result = $this->bikeModel->data($data)->where("bId in ($selectedBike)")->save();
        $this->loadBikeByPage();
    }
    
    /**
     * 租车信息
     * @param number $pageNo
     * @param number $pageSize
     * @param unknown $bNo
     * @param unknown $uAccount
     * @param unknown $rbStartPosition
     * @param unknown $rbStartTime
     */
    public function rentBike($pageNo = 1,$pageSize = 10,$bNo=null,$uAccount=null,$rbStartPosition=null,$rbStartTime=null){
        $con = array();
        if($bNo != null && $bNo != ""){
            $con["b1.bNo"] = array("like","%$bNo%");
        };
        if($rbStartPosition != null && $rbStartPosition != ""){
            $con["r1.rbStartPosition"] = array("EQ",$rbStartPosition);
        };
        if($uAccount != null && $uAccount != ""){
            $con["u1.uAccount"] = array("like","%$uAccount%");
        };
        if($rbStartTime != null && $rbStartTime != ""){
            $con["r1.rbStartTime"] = array("GT",$rbStartTime);
        };
//         print_r($con);
        $total = $this->bikeModel->table('tb_rentbike r1, tb_user u1, tb_bike b1, tb_platform p1')->
        where("r1.uId = u1.uId and r1.bid = b1.bid and r1.rbStartPosition = p1.pid")->where($con)->count();
        
        $rows = $this->bikeModel->table('tb_rentbike r1, tb_user u1, tb_bike b1, tb_platform p1')->
        field("r1.rbid,u1.uaccount,b1.bno,r1.rbstarttime,p1.pposition")->page($pageNo,$pageSize)->
        where("r1.uId = u1.uId and r1.bid = b1.bid and r1.rbStartPosition = p1.pid")->where($con)->select();

        $pPosition = $this->bikeModel->table(tb_platform)->select();
        
        $page = array("total"=>$total, "rows"=>$rows, "pageNo"=>$pageNo, "pageSize"=>$pageSize);
        
        $this->assign("page",$page);
        
        $this->assign("BASEPATH",BASEPATH);
        
        $this->assign("rbStartPosition",$rbStartPosition);

        $this->assign("uAccount",$uAccount);
        
        $this->assign("rbStartTime",$rbStartTime);
        
        $this->assign("pPosition",$pPosition);
        
        //         print_r($page);
        $this->display("rentBikeInformation");
    }
    
    
    
    
    
    
    
    
    
    
}

?>