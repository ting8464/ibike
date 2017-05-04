<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;
class ClientController extends Controller{
    private $clientModel;
    public function __construct(){
        $this->clientModel = new Model("tb_user");
    }
    /**
     * 查询用户
     */
    public function setClient($pageNo=1,$pageSize=10){
        $total = $this->clientModel->getField("count(*)");
        $rows = $this->clientModel->page($pageNo,$pageSize)->select();
        $page = array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
        $this->assign("page",$page);
        $this->assign("NB",NBSP);
        $this->display("setClient");
    }
}

?>