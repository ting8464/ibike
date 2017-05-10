<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;
class FinanceController extends Controller{
    
    private $chargeModel;
    
    /**
     * 构造方法
     */
    public function __construct(){
        parent::__construct();
        $this->chargeModel = new Model('tb_rechargerecord');
    }
    
    /**
     * 充值一览
     * @param number $pageNo
     * @param number $pageSize
     * @param unknown $uAccount
     * @param unknown $rmoney
     * @param unknown $rTime
     */
    public function rechargeList($pageNo = 1,$pageSize = 10,$uAccount = null,$rmoney = null,$rTime = null){
        $con = array();
        if($uAccount != null && $uAccount != ""){
            $con["u1.uAccount"] = array("like","%$uAccount%");
        };
        if($rmoney != null && $rmoney != ""){
            $con["r1.rmoney"] = array("GT","$rmoney");
        };
        if($rTime != null && $rTime != ""){
            $con["r1.rTime"] = array("GT","$rTime");
        };
        
        $sum = $this->chargeModel->table('tb_rechargerecord r1, tb_user u1')->where('r1.uid=u1.uid')->
        where($con)->sum("r1.rmoney");
        
        $total = $this->chargeModel->table('tb_rechargerecord r1, tb_user u1')->where('r1.uid=u1.uid')->
        where($con)->count();
        
        $rows = $this->chargeModel->field('r1.rid,u1.uaccount,r1.rmoney,r1.rtime')->
        table('tb_rechargerecord r1, tb_user u1')->where('r1.uid=u1.uid')->where($con)->page($pageNo,$pageSize)
        ->select();
        
        $page = array("total"=>$total, "rows"=>$rows, "pageNo"=>$pageNo, "pageSize"=>$pageSize);
        
        $this->assign("page",$page);

        $this->assign("uAccount",$uAccount);

        $this->assign("rmoney",$rmoney);

        $this->assign("rTime",$rTime);

        $this->assign("sum",$sum);
        
        $this->assign("BASEPATH",BASEPATH);
//         print_r($page);
        $this->display("rechargeList");
    }
    
    /**
     * 押金一览
     */
    public function pledgeList($pageNo=1,$pageSize=10,$uAccount=null,$upledge=null,$uisbackpledge=null,$ptime=null){
        $con = array();
        if($uAccount != null && $uAccount != ""){
            $con["u1.uAccount"] = array("like","%$uAccount%");
        };
        if($upledge != null && $upledge != ""){
            $con["u1.upledge"] = array("EQ",$upledge);
        };
        if($uisbackpledge != null && $uisbackpledge != ""){
            $con["u1.uisbackpledge"] = array("EQ",$uisbackpledge);
        };
        if($ptime != null && $ptime != ""){
            $con["p1.ptime"] = array("GT",$ptime);
        };
        
        $total = $this->chargeModel->table('tb_user')->count();
        
        $rows = $this->chargeModel->field('u1.uid,u1.uaccount,u1.uPledge,u1.uIsBackPledge,(select p1.ptime from
            tb_pledgeBackRecord p1 where u1.uid = p1.uid) as ptime')->table('tb_user u1')->page($pageNo,$pageSize)
            ->where($con)->select();
        
        $page = array("total"=>$total, "rows"=>$rows, "pageNo"=>$pageNo, "pageSize"=>$pageSize);
        
        $this->assign("page",$page);

        $this->assign("uAccount",$uAccount);

        $this->assign("upledge",$upledge);

        $this->assign("uisbackpledge",$uisbackpledge);

        $this->assign("ptime",$ptime);

        $this->assign("BASEPATH",BASEPATH);
//         print_r($page);
        $this->display("pledgeList");
        
    }
    /**
     * 检查选中用户是否符合修改条件
     * @param unknown $selectedUser
     */
    public function checkPledge($selectedUser = null){
        $hasBack = $this->chargeModel->table("tb_user")->field('uid')->
        where("uisbackpledge = 1 and uid in ($selectedUser)")->select();
        echo json_encode($hasBack);
    }
    /**
     * 修改退回押金
     * @param unknown $selectedUser
     * @param unknown $ptime2
     */
    public function backPledge($selectedUser=null,$ptime2=null){
        
        $selectedUserArray = explode(',',$selectedUser);
        
        //在模型中启动事务
        $this->chargeModel->startTrans();
        
        $a=0;
        $b=0;
        
        $updateData['uisbackpledge'] = 0;
        
        $insertData['ptime'] = $ptime2;
        
        foreach ($selectedUserArray as $temp){
            
            $insertData['uid'] = $temp;
            $insertResult = $this->chargeModel->table("tb_pledgebackrecord")->field('uid,ptime')->add($insertData);
            if($insertResult > 0){
                $a++;
            }

//             $updateResult = $this->chargeModel->table('tb_user')->where("uid = $temp")->save($updateData);
            $sql = "update tb_user set uisbackpledge=1 where uid=$temp";
            $updateResult = $this->chargeModel->execute($sql);
            if($updateResult > 0){
                $b++;
            }
        }
        
        if ($a == $b){
            // 提交事务
            $this->chargeModel->commit();
        }else{
            // 事务回滚
            $this->chargeModel->rollback();
        }
        $this->pledgeList();
    }
    
    
    
    
    
    
}

?>