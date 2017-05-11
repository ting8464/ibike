<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;

class DiscountController extends Controller{

    private $discountModel;

    /**
     * 构造方法
     */
    public function __construct(){
        parent::__construct();
        $this->discountModel = new Model('tb_discount');
    }

    /**
     * 优惠券一览
     */
    public function discountListByPage($pageNo=1,$pageSize=10,$searchRelation=0,$dLimit=NULL,$dGive=NULL){
        $con = array();
        if($dLimit != null && $dLimit != ""){
            if($searchRelation == 0){
                $con["dLimit"] = array("EQ",$dLimit); 
            }elseif ($searchRelation == 1){
                $con["dLimit"] = array("GT",$dLimit);
            }else{
                $con["dLimit"] = array("LT",$dLimit);
            }
        };
        if($dGive != null && $dGive != ""){
            if($searchRelation == 0){
                $con["dGive"] = array("EQ",$dGive); 
            }elseif ($searchRelation == 1){
                $con["dGive"] = array("GT",$dGive);
            }else{
                $con["dGive"] = array("LT",$dGive);
            }
        };
        
        $total = $this->discountModel->where($con)->count();
        
        $rows = $this->discountModel->page($pageNo, $pageSize)->where($con)->select();
        
        $page = array(
            "total" => $total,
            "rows" => $rows,
            "pageNo" => $pageNo,
            "pageSize" => $pageSize
        );

        $this->assign("dLimit", $dLimit);

        $this->assign("dGive", $dGive);

        $this->assign("searchRelation", $searchRelation);
        
        $this->assign("page", $page);
        
        $this->assign("BASEPATH", BASEPATH);
//         print_r($page);
        $this->display("discountList");
    }
    
    /**
     * 获取选中的优惠券的信息
     * @param unknown $dId
     */
    public function loadPickPickDiscount($dId){
        $data = $this->discountModel->where("dId = $dId")->select();
        echo json_encode($data);
    }
    /**
     * 修改优惠券信息
     * @param unknown $dId
     * @param unknown $dLimit
     * @param unknown $dGive
     * @param unknown $dCount
     */
    public function updateDiscount($dId,$dLimit,$dGive,$dCount){
        $updateData['dLimit']=$dLimit;
        $updateData['dGive']=$dGive;
        $updateData['dCount']=$dCount;
        
        $updateResult = $this->discountModel->where("dId = $dId")->save($updateData);
        $this->discountListByPage();
    }
    /**
     * 增加优惠券
     * @param unknown $dLimit
     * @param unknown $dGive
     * @param unknown $dCount
     */
    public function addDiscount($dLimit,$dGive,$dCount){
        $updateData['dLimit']=$dLimit;
        $updateData['dGive']=$dGive;
        $updateData['dCount']=$dCount;
        $addResult = $this->discountModel->field('dLimit,dGive,dCount')->add($updateData);
        echo $addResult;
    }
    
    /**
     * 删除选定优惠券
     * @param unknown $dids
     */
    public function deleteDiscount($dids){
        $deleteResult = $this->discountModel->where("dId in ($dids)")->delete();
        echo $deleteResult;
    }
    
    
    
    
    
    
}

?>