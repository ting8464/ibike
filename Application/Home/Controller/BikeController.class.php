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
    
    public function loadBikeByPage($pageNo = 1,$pageSize = 10){
        $total = $this->bikeModel->count();
        
        //->fetchSql(true)
        $rows = $this->bikeModel->page($pageNo,$pageSize)->select();
        $page = array("total"=>$total, "rows"=>$rows, "pageNo"=>$pageNo, "pageSize"=>$pageSize);
        
        $this->assign("page",$page);

        $this->assign("BASEPATH",BASEPATH);
//         print_r($page);
        $this->display("bikeInformationList");
    }
}

?>