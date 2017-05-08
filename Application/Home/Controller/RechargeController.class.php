<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;
class RechargeController extends Controller{
    
    private $chargeModel;
    
    /**
     * 构造方法
     */
    public function __construct(){
        parent::__construct();
        $this->chargeModel = new Model('tb_rechargerecord');
    }
    
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
        
//         $sum = $this->chargeModel->table('tb_rechargerecord r1, tb_user u1')->where('r1.uid=u1.uid')->
//         where($con)->sum("r1.rmoney");
//         echo $sum;
        
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

//         $this->assign("sum",$sum);
        
        $this->assign("BASEPATH",BASEPATH);
//         print_r($page);
//         $this->display("rechargeList");
    }
    
    
    
}

?>