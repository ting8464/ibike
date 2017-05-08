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
        
        $this->display("rentBikeInformation");
    }
    
    /**
     * 单车租赁历史记录
     * @param number $pageNo
     * @param number $pageSize
     * @param unknown $bNo
     * @param unknown $uAccount
     * @param unknown $rbEndTime
     * @param unknown $rbEndPosition
     * @param unknown $rbStartPosition
     * @param unknown $rbStartTime
     */
    public function rentBikeHistory($pageNo = 1,$pageSize = 10,$bNo=null,$uAccount=null,$rbEndTime=null,$rbEndPosition=null,$rbStartPosition=null,$rbStartTime=null){
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
        if($rbEndPosition != null && $rbEndPosition != ""){
            $con["r1.rbEndPosition"] = array("EQ",$rbEndPosition);
        };
        if($rbEndTime != null && $rbEndTime != ""){
            $con["r1.rbEndTime"] = array("GT",$rbEndTime);
        };
        
        $total = $this->bikeModel->table('tb_rentrecord r1,tb_user u1,tb_bike b1,tb_platform p1,tb_platform p2')->
        where("r1.uId = u1.uId and r1.bid = b1.bid and r1.rbStartPosition = p1.pid and r1.rbEndPosition = p2.pid")
        ->where($con)->count();
        
        $rows = $this->bikeModel->table('tb_rentrecord r1,tb_user u1,tb_bike b1,tb_platform p1,tb_platform p2')->
        field("r1.rrid,u1.uaccount,b1.bno,r1.rbstarttime,r1.rbendtime,p1.pposition,p2.pposition as endposition")->page($pageNo,$pageSize)->
        where("r1.uId = u1.uId and r1.bid = b1.bid and r1.rbStartPosition = p1.pid and r1.rbEndPosition = p2.pid")
        ->where($con)->select();
        
        $pPosition = $this->bikeModel->table(tb_platform)->select();
        
        $page = array("total"=>$total, "rows"=>$rows, "pageNo"=>$pageNo, "pageSize"=>$pageSize);
        
        $this->assign("page",$page);
        
        $this->assign("BASEPATH",BASEPATH);
        
        $this->assign("rbStartPosition",$rbStartPosition);
        
        $this->assign("uAccount",$uAccount);
        
        $this->assign("rbStartTime",$rbStartTime);

        $this->assign("rbEndTime",$rbEndTime);
        
        $this->assign("rbEndPosition",$rbEndPosition);
        
        $this->assign("pPosition",$pPosition);
        
        $this->display("rentBikeHistory");
    }
    
    /**
     * 结束用车
     * @param unknown $selectedBike
     * @param unknown $rbEndTime
     * @param unknown $rbEndPosition
     */
    public function endRent($selectedBike=null,$rbEndTime=null,$rbEndPosition=null){
        $data = $this->bikeModel->table('tb_rentbike')->where("rbId in ($selectedBike)")->select();
        $con = array();
        for ($i=0;$i<count($data);$i++){
            $con[$i]['uid'] = $data[$i]['uid'];
            $con[$i]['bid'] = $data[$i]['bid'];
            $con[$i]['rbstarttime'] = $data[$i]['rbstarttime'];
            $con[$i]['rbendtime'] = $rbEndTime;
            $con[$i]['rbstartposition'] = $data[$i]['rbstartposition'];
            $con[$i]['rbendposition'] = $rbEndPosition;
        }
        
        //在模型中启动事务
        $this->bikeModel->startTrans();
        
        //删除租车记录
        $deleteResult = $this->bikeModel->table('tb_rentbike')->where("rbId in ($selectedBike)")->delete();
        
        //修改单车状态
        $updatedata['bIsUsed'] = '0';
        foreach ($con as $updatebike){
            $bid = $updatebike['bid'];
            $updateResult = $this->bikeModel->table('tb_bike')->where("bId = $bid")->save($updatedata);
        }
        //添加租车历史记录
        foreach ($con as $insertData){
            $insertResult = $this->bikeModel->table('tb_rentrecord')->
            field('uid,bid,rbstarttime,rbendtime,rbstartposition,rbendposition')->add($insertData);
        }
        
        if ($deleteResult != null && $deleteResult != "" && $insertResult != null && $insertResult != "" && $updateResult != null && $updateResult != ""){
            // 提交事务
            $this->bikeModel->commit();
        }else{
            // 事务回滚
            $this->bikeModel->rollback();
        }
        
        $this->rentBike();
    }
    
    
    
    
}

?>