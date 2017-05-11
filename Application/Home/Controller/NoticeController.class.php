<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;
class NoticeController extends Controller{
    private $noticeModel;
    private $addModel;
    public function __construct(){
        parent::__construct();
        $this->noticeModel = new Model("tb_terraceactivi");
        $this->addModel = new Model("tb_notice");
    }
    /**
     * 查询活动内容展示
     * @param number $pageNo
     * @param number $pageSize
     */
    public function setnoticeGeneral($pageNo=1,$pageSize=5){
        $total = $this->noticeModel->getField("count(*)");
        $rows = $this->noticeModel->page($pageNo,$pageSize)->select();
        $page = array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
        $this->assign("page",$page);
        $this->assign("BAH",BASEPATH);
        $this->display("noticeGeneral");
    }
    /**
     * 查询新增内容展示
     * @param number $pageNo
     * @param number $pageSize
     */
    public function stingnotice($pageNo=1,$pageSize=5){
        $tot = $this->addModel->getField("count(*)");
        $row = $this->addModel->page($pageNo,$pageSize)->select();
        $page = array("total"=>$tot,"rows"=>$row,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
        $this->assign("page",$page);
        $this->assign("BAH",BASEPATH);
        $this->display("noticeGeneral2");
   }
   /**
    * 组合活动内容和新增内容页面展示
    */
   public function aaa(){
       $this->assign("BAH",BASEPATH);
       $this->display("NewFile");
   }
   /**
    * 添加新增内容
    * @param unknown $notice
    */
   public function addnoticeGeneral(){
       $data=$this->addModel->create();
       $this->addModel->field("notice")->add($data);
       $this->assign("BAH",BASEPATH);
       $this->display("addNotice");
       
   }
   /**
    * 查询新增内容展示进行修改删除操作
    * @param number $pageNo
    * @param number $pageSize
    */
   public function updatanotice($pageNo=1,$pageSize=10){
       $tot = $this->addModel->getField("count(*)");
       $row = $this->addModel->page($pageNo,$pageSize)->select();
       $page = array("total"=>$tot,"rows"=>$row,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
       $this->assign("page",$page);
       $this->assign("BAH",BASEPATH);
       $this->display("updataNotice");
   }
   public function loadnotice($nid,$notice){
       echo $nid."--".$notice;
//        if ($nid > 0){
//          $this->addModel->field("notice")->where("nid=%d",$nid["nid"])->save();
//        }
//        $this->updatanotice();
   }
   /**
    * 删除内容
    */
   public function clientdel(){
       $nid = $_POST["cx"];
//        print_r($nid) ;
       for ($i = 0;$i<count($nid);$i++){
           $this->addModel->delete("$nid[$i]");
       }
       $this->updatanotice();
   }
    
}

?>