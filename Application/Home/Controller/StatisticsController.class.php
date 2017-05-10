<?php
namespace Home\Controller;
/*
 * 统计处理层
 */
use Think\Controller;
use Think\Model;
class StatisticsController extends Controller{
    private  $BikeMode;
    /**
     * 构造方法
     */
    public function __construct(){
        parent::__construct();
        $this->BikeMode = new Model("tb_bike");
    }
    
    /**
     * 加载统计数据并且分页展示
     */
    public function loadStatisticalData($pageNo = 1,$pageSize = 10){
        //总数据
        $total=$this->BikeMode->table("tb_bike as b")->join("left JOIN tb_platform as p on b.bsetposition=p.pid")->group("b.bsetposition")->distinct(true)->count();
        //当前页的数据
        $rows=$this->BikeMode->table("tb_bike as b")->join("tb_platform as p on b.bsetposition=p.pid")->
        field("b.bid,(select count(*) from tb_bike b where b.bsetposition=p.pid) as allBike,(select count(*) from tb_bike b where bisused=1 and b.bsetposition=p.pid) as isuse,(select count(*) from tb_bike b where bisused=0 and b.bsetposition=p.pid) as NoUse,(select count(*) from tb_bike b where bstate=0 and b.bsetposition=p.pid) as goodBike,(select count(*) from tb_bike b where bstate=1 and b.bsetposition=p.pid) as badBike,(select count(*) from tb_bike b where bstate=2 and b.bsetposition=p.pid) as scrapBike,p.pposition")
        ->group("p.pposition")->page($pageNo,$pageSize)->order("b.bid desc")->select();
        //把数据放进一个数组，方便传输数据
        $page=array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
        $this->assign("BASEPATH",BASEPATH);//保存数据方便页面使用
        $this->assign("data",$page);
        $this->display("Statistics");
        //print_r($page); 
    }
    /**
     * 按平台收索统计数据
     */
    public function searchPlatform($pageNo = 1,$pageSize = 10,$pPosition){
        $query="1=1 ";
        if($pPosition!=null && $pPosition !=""){
            $query .="and pPosition LIKE '%$pPosition%'";
        }
        //总数据
        $total=$this->BikeMode->table("tb_bike as b")->join("tb_platform as p on b.bsetposition=p.pid")->where($query)->count();
        //当前页的数据
        $rows=$this->BikeMode->table("tb_bike as b")->join("tb_platform as p on b.bsetposition=p.pid")->
        field("b.bid,(select count(*) from tb_bike b where b.bsetposition=p.pid) as allBike,(select count(*) from tb_bike b where bisused=1 and b.bsetposition=p.pid) as isuse,(select count(*) from tb_bike b where bisused=0 and b.bsetposition=p.pid) as NoUse,(select count(*) from tb_bike b where bstate=0 and b.bsetposition=p.pid) as goodBike,(select count(*) from tb_bike b where bstate=1 and b.bsetposition=p.pid) as badBike,(select count(*) from tb_bike b where bstate=2 and b.bsetposition=p.pid) as scrapBike,p.pposition")
        ->where($query)->group("p.pposition")->page($pageNo,$pageSize)->order("b.bid desc")->select();
        //把数据放进一个数组，方便传输数据
        $page=array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
        $this->assign("BASEPATH",BASEPATH);//保存数据方便页面使用
        $this->assign("data",$page);
        $this->display("Statistics");
    }
    
 
    
    
}
?>