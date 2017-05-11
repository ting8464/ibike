<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class UserController extends Controller{
    private $userModel;
    public function __construct(){
        parent::__construct();
        $this->userModel = new Model("tb_user");
    }
    /**
     * 查询用户 并分页 搜索
     * @param number $pageNo
     * @param number $pageSize
     */
    public function setClient($pageNo=1,$pageSize=10,$searcheName=NULL,$searcheCredit=NULL,$searcheIntegral=NULL,$searcheIsFrozen=NULL,$searchePledge=NULL,$searcheState=NULL){
        $query = array();
        if ($searcheName != null && $searcheName != ""){
            $query["uAccount"] = array("LIKE","%$searcheName%");
        }
        if ($searcheCredit != null && $searcheCredit != ""){
            $query["uCredit"] = array("LIKE","%$searcheCredit%");
        }
        if ($searcheIntegral != null && $searcheIntegral != ""){
            $query["uIntegral"] = array("LIKE","%$searcheIntegral%");
        }
        if ($searcheIsFrozen != null && $searcheIsFrozen != ""){
            $query["uIsFrozen"] = array("LIKE","%$searcheIsFrozen%");
        }
        if ($searchePledge != null && $searchePledge != ""){
            $query["uPledge"] = array("LIKE","%$searchePledge%");
        }
        if ($searcheState != null && $searcheState != ""){
            $query["uState"] = array("LIKE","%$searcheState%");
        }
        $total = $this->userModel->where($query)->getField("count(*)");
        $rows = $this->userModel->where($query)->page($pageNo,$pageSize)->order("uid desc ")->select();
        $page = array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
        $this->assign("page",$page);
        $this->assign("BAH",BASEPATH);
        $this->display("userColumn");
    }
    public function amount($amount){
        $total = $this->userModel->find($amount);
        print_r($total);
    }
    /**
     * 查询客户信用
     * @param number $pageNo
     * @param number $pageSize
     */
    public function setCredit($pageNo=1,$pageSize=10,$searcheIntegral=NULL){
        $query = array();
        if ($searcheIntegral != null && $searcheIntegral != ""){
            $query["uIntegral"] = array("LIKE","%$searcheIntegral%");
        }
        $total = $this->userModel->where($query)->getField("count(*)");
        $rows = $this->userModel->where($query)->page($pageNo,$pageSize)->order("uid desc ")->select();
        $page = array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
        $this->assign("page",$page);
        $this->assign("BAH",BASEPATH);
        $this->display("userCredit");
    }
}
?>