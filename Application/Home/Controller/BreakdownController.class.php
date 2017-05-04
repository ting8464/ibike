<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;
class BreakdownController extends Controller
{
    private $break;
    public function __construct(){
        $this->break=new Model("tb_breakdown");
    }
    
    function selectbreakdown($pagenu=1,$pagesize=5,$bname="",$bstyle="") {
        $query=array();
        
        //         if ($searche_name!=null && $searche_name!=""){
        //             $query["e_name"]=array("LIKE","%$searche_name%");
        //         }
        //         if ($searche_text!=null && $searche_text!=""){
        //             $query["e_text"]=array("LIKE","%$searche_text%");
        //         }
        $query="1=1";
        if ($bname!=null && $bname!=""){
            $query .= " and e_name like '%$bname%'";
        }
        if ($bstyle!=null && $bstyle!=""){
            $query .= " and e_text like '%$bstyle%'";
        }
        $total = $this->Usemodel->where($query)->count();
        $rows=$this->Usemodel->where($query)->page($pagenu,$pagesize)->select();
        $page = array("total"=>$total,"rows"=>$rows,"pageNo"=>$pagenu,"pageSize"=>$pagesize);
        $this->assign("page",$page);
        $this->display("breakdown");
    }
}

?>